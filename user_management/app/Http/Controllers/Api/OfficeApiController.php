<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OfficeApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->integer('per_page', 15);

        $offices = Office::query()
            ->withCount('users')
            ->orderBy('name')
            ->paginate(max(1, min($perPage, 100)));

        return response()->json($offices);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'office_code' => ['required', 'string', 'max:255', 'unique:offices,office_code'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $office = Office::query()->create($validated);

        return response()->json($office, 201);
    }

    public function show(Office $office): JsonResponse
    {
        $office->load('users');

        return response()->json($office);
    }

    public function update(Request $request, Office $office): JsonResponse
    {
        $validated = $request->validate([
            'office_code' => ['required', 'string', 'max:255', Rule::unique('offices', 'office_code')->ignore($office->id)],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $office->update($validated);

        return response()->json($office);
    }

    public function destroy(Office $office): JsonResponse
    {
        if ($office->users()->exists()) {
            return response()->json([
                'message' => 'Cannot delete an office with assigned users.',
            ], 422);
        }

        $office->delete();

        return response()->json(['message' => 'Office deleted successfully.']);
    }
}

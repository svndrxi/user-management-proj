<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->integer('per_page', 15);

        $permissions = Permission::query()
            ->withCount(['roles', 'users'])
            ->orderBy('name')
            ->paginate(max(1, min($perPage, 100)));

        return response()->json($permissions);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:permissions,slug'],
            'description' => ['nullable', 'string'],
        ]);

        $permission = Permission::query()->create($validated);

        return response()->json($permission, 201);
    }

    public function show(Permission $permission): JsonResponse
    {
        $permission->load(['roles', 'users']);

        return response()->json($permission);
    }

    public function update(Request $request, Permission $permission): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('permissions', 'slug')->ignore($permission->id)],
            'description' => ['nullable', 'string'],
        ]);

        $permission->update($validated);

        return response()->json($permission);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfficeRequest;
use App\Http\Requests\UpdateOfficeRequest;
use App\Models\Office;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OfficeController extends Controller
{
    public function index(): View
    {
        $offices = Office::query()
            ->withCount('users')
            ->orderBy('name')
            ->paginate(15);

        return view('offices.index', compact('offices'));
    }

    public function create(): View
    {
        return view('offices.create');
    }

    public function store(StoreOfficeRequest $request): RedirectResponse
    {
        $office = Office::query()->create($request->validated());

        return redirect()
            ->route('offices.show', $office)
            ->with('success', 'Office created successfully.');
    }

    public function show(Office $office): View
    {
        $office->load([
            'users' => fn ($query) => $query->with(['role', 'permissions'])->orderBy('last_name'),
        ]);

        return view('offices.show', compact('office'));
    }

    public function edit(Office $office): View
    {
        return view('offices.edit', compact('office'));
    }

    public function update(UpdateOfficeRequest $request, Office $office): RedirectResponse
    {
        $office->update($request->validated());

        return redirect()
            ->route('offices.show', $office)
            ->with('success', 'Office updated successfully.');
    }

    public function destroy(Office $office): RedirectResponse
    {
        if ($office->users()->exists()) {
            return redirect()
                ->route('offices.index')
                ->with('error', 'Cannot delete an office with assigned users.');
        }

        $office->delete();

        return redirect()
            ->route('offices.index')
            ->with('success', 'Office deleted successfully.');
    }
}
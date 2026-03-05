<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PermissionController extends Controller
{
    public function index(): View
    {
        $permissions = Permission::query()
            ->withCount(['roles', 'users'])
            ->orderBy('name')
            ->paginate(15);

        return view('permissions.index', compact('permissions'));
    }

    public function create(): View
    {
        return view('permissions.create');
    }

    public function store(StorePermissionRequest $request): RedirectResponse
    {
        $permission = Permission::query()->create($request->validated());

        return redirect()
            ->route('permissions.show', $permission)
            ->with('success', 'Permission created successfully.');
    }

    public function show(Permission $permission): View
    {
        $permission->load([
            'roles',
            'users' => fn ($query) => $query->with(['office', 'role'])->orderBy('last_name'),
        ]);

        return view('permissions.show', compact('permission'));
    }

    public function edit(Permission $permission): View
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission): RedirectResponse
    {
        $permission->update($request->validated());

        return redirect()
            ->route('permissions.show', $permission)
            ->with('success', 'Permission updated successfully.');
    }
}

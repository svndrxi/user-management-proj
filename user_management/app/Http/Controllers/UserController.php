<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\ActivityLog;
use App\Models\Office;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()
            ->with(['office', 'role', 'permissions'])
            ->latest()
            ->paginate(15);

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        $offices     = Office::query()->orderBy('name')->get();
        $roles       = Role::query()->orderBy('name')->get();
        $permissions = Permission::query()->orderBy('name')->get();

        return view('users.create', compact('offices', 'roles', 'permissions'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $payload = [
            'employee_id'        => $validated['employee_id'],
            'first_name'         => $validated['first_name'],
            'middle_name'        => $validated['middle_name'] ?? null,
            'last_name'          => $validated['last_name'],
            'username'           => $validated['username'],
            'email'              => $validated['email'],
            'office_id'          => (int) $validated['office_id'],
            'role_id'            => (int) $validated['role_id'],
            'email_verified_at'  => now(),
            
        ];

        $payload['password'] = Hash::make($validated['password']);

        $user = User::query()->create($payload);

        $user->permissions()->sync($validated['permission_ids'] ?? []);

        ActivityLog::record('created_user', 'User Management', "Created user {$user->email}");

        return redirect()
            ->route('users.show', $user)
            ->with('success', 'User created successfully.');
    }

    public function show(User $user): View
    {
        $user->load([
            'office',
            'role',
            'permissions',
            'activityLogs' => fn ($query) => $query->latest(),
        ]);

        return view('users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        $offices               = Office::query()->orderBy('name')->get();
        $roles                 = Role::query()->orderBy('name')->get();
        $permissions           = Permission::query()->orderBy('name')->get();
        $selectedPermissionIds = $user->permissions()->pluck('permissions.id')->all();

        return view('users.edit', compact('user', 'offices', 'roles', 'permissions', 'selectedPermissionIds'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        $payload = [
            'employee_id' => $validated['employee_id'],
            'first_name'  => $validated['first_name'],
            'middle_name' => $validated['middle_name'] ?? null,
            'last_name'   => $validated['last_name'],
            'username'    => $validated['username'],
            'email'       => $validated['email'],
            'office_id'   => (int) $validated['office_id'],
            'role_id'     => (int) $validated['role_id'],
        ];

        if (! empty($validated['password'])) {
            $payload['password'] = Hash::make($validated['password']);
        }

        $user->update($payload);
        $user->permissions()->sync($validated['permission_ids'] ?? []);

        ActivityLog::record('updated_user', 'User Management', "Updated user {$user->email}");

        return redirect()
            ->route('users.show', $user)
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        // Prevent a user from deleting their own account
        if ($user->id === auth()->id()) {
            return redirect()
                ->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $email = $user->email;

        // Cascade on the DB handles pivot cleanup — no manual detach needed
        $user->delete();

        ActivityLog::record('deleted_user', 'User Management', "Deleted user {$email}");

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
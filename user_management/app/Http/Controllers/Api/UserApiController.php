<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Office;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserApiController extends Controller
{
    private function normalizeRoleName(?string $name): string
    {
        return strtolower(trim($name ?? ''));
    }

    private function roleName(?User $user): string
    {
        return $this->normalizeRoleName($user?->role?->name);
    }

    private function isSystemAdmin(User $user): bool
    {
        return $this->roleName($user) === 'system admin';
    }

    private function isAdmin(User $user): bool
    {
        return $this->roleName($user) === 'admin';
    }

    private function isUserRole(User $user): bool
    {
        return $this->roleName($user) === 'user';
    }

    private function isManagerRole(User $user): bool
    {
        return $this->roleName($user) === 'manager';
    }

    private function canManageRole(User $actor, string $targetRoleName): bool
    {
        if ($this->isSystemAdmin($actor)) {
            return true;
        }

        if ($this->isAdmin($actor)) {
            return in_array($targetRoleName, ['user', 'manager'], true);
        }

        return false;
    }

    private function isHROfficeId(int $officeId): bool
    {
        return Office::query()
            ->where('id', $officeId)
            ->where('office_code', 'HR')
            ->exists();
    }

    private function canManageOther(User $actor, User $target): bool
    {
        if ($actor->id === $target->id) {
            return false;
        }

        return $this->canManageRole($actor, $this->roleName($target));
    }

    public function index(Request $request): JsonResponse
    {
        /** @var User|null $actor */
        $actor = $request->user();

        if (! $actor) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        if (! ($this->isAdmin($actor) || $this->isSystemAdmin($actor))) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        $perPage = (int) $request->integer('per_page', 15);

        $query = User::query()
            ->with(['office', 'role', 'permissions'])
            ->latest();

        if ($this->isAdmin($actor) && ! $this->isSystemAdmin($actor)) {
            $query->whereHas('role', function ($q) {
                $q->whereIn('name', ['User', 'Manager']);
            });
        }

        if ($request->boolean('only_archived')) {
            $query->where('is_archived', true);
        } elseif ($request->boolean('include_archived')) {
            // include both active + archived (but still exclude soft-deleted)
        } else {
            $query->where('is_archived', false);
        }

        $users = $query->paginate(max(1, min($perPage, 100)));

        return response()->json($users);
    }

    public function store(Request $request): JsonResponse
    {
        /** @var User|null $actor */
        $actor = $request->user();

        if (! $actor) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $validated = $request->validate([
            'employee_id' => ['required', 'string', 'max:255', 'unique:users,employee_id'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'office_id' => ['required', 'exists:offices,id'],
            'role_id' => ['required', 'exists:roles,id'],
            'is_active' => ['nullable', 'boolean'],
            'permission_ids' => ['nullable', 'array'],
            'permission_ids.*' => ['integer', 'exists:permissions,id'],
        ]);

        $role = Role::query()->find((int) $validated['role_id']);
        $roleName = $this->normalizeRoleName($role?->name);

        if (! $this->canManageRole($actor, $roleName)) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        if ($roleName === 'manager' && ! $this->isHROfficeId((int) $validated['office_id'])) {
            return response()->json([
                'message' => 'Only HR office users can be assigned to the Manager role.',
            ], 422);
        }

        $user = User::query()->create([
            'employee_id' => $validated['employee_id'],
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'] ?? null,
            'last_name' => $validated['last_name'],
            'designation' => $validated['designation'] ?? null,
            'username' => $validated['username'],
            'email' => $validated['email'],
            'email_verified_at' => now(),
            'password' => Hash::make($validated['password']),
            'office_id' => (int) $validated['office_id'],
            'role_id' => (int) $validated['role_id'],
            'is_active' => (bool) ($validated['is_active'] ?? true),
        ]);

        $user->permissions()->sync($validated['permission_ids'] ?? []);
        $user->load(['office', 'role', 'permissions']);
        ActivityLog::record('created_user', 'User Management', "Created user {$user->email}");

        return response()->json($user, 201);
    }

    public function show(User $user): JsonResponse
    {
        /** @var User|null $actor */
        $actor = request()->user();

        if (! $actor) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        if (! ($this->isAdmin($actor) || $this->isSystemAdmin($actor))) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        if ($actor->id !== $user->id && ! $this->canManageOther($actor, $user)) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        $user->load(['office', 'role', 'permissions', 'activityLogs']);

        return response()->json($user);
    }

    public function update(Request $request, User $user): JsonResponse
    {
        /** @var User|null $actor */
        $actor = $request->user();

        if (! $actor) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        if (! ($this->isAdmin($actor) || $this->isSystemAdmin($actor))) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        if ($actor->id !== $user->id && ! $this->canManageOther($actor, $user)) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        $validated = $request->validate([
            'employee_id' => ['required', 'string', 'max:255', Rule::unique('users', 'employee_id')->ignore($user->id)],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user->id)],
            'designation' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'office_id' => ['required', 'exists:offices,id'],
            'role_id' => ['required', 'exists:roles,id'],
            'is_active' => ['nullable', 'boolean'],
            'permission_ids' => ['nullable', 'array'],
            'permission_ids.*' => ['integer', 'exists:permissions,id'],
        ]);

        $targetRole = Role::query()->find((int) $validated['role_id']);
        $targetRoleName = $this->normalizeRoleName($targetRole?->name);
        $currentRoleName = $this->roleName($user);
        $isSelfUpdateWithSameRole = $actor->id === $user->id && $targetRoleName === $currentRoleName;

        if (! $isSelfUpdateWithSameRole && ! $this->canManageRole($actor, $targetRoleName)) {
            return response()->json(['message' => 'You do not have permission to assign this role.'], 403);
        }

        if ($this->isAdmin($actor) && $actor->id !== $user->id && ! ($this->isUserRole($user) || $this->isManagerRole($user))) {
            return response()->json(['message' => 'Admins may only manage users with the User or Manager role.'], 403);
        }

        if ($targetRoleName === 'manager' && ! $this->isHROfficeId((int) $validated['office_id'])) {
            return response()->json([
                'message' => 'Only HR office users can be assigned to the Manager role.',
            ], 422);
        }

        $payload = [
            'employee_id' => $validated['employee_id'],
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'] ?? null,
            'last_name' => $validated['last_name'],
            'designation' => $validated['designation'] ?? null,
            'username' => $validated['username'],
            'email' => $validated['email'],
            'office_id' => (int) $validated['office_id'],
            'role_id' => (int) $validated['role_id'],
            'is_active' => (bool) ($validated['is_active'] ?? true),
        ];

        if (! empty($validated['password'])) {
            $payload['password'] = Hash::make($validated['password']);
        }

        $user->update($payload);
        $user->permissions()->sync($validated['permission_ids'] ?? []);
        $user->load(['office', 'role', 'permissions']);
        ActivityLog::record('updated_user', 'User Management', "Updated user {$user->email}");

        return response()->json($user);
    }

    public function destroy(User $user): JsonResponse
    {
        /** @var User|null $actor */
        $actor = auth()->user();

        if (! $actor) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        if (! ($this->isAdmin($actor) || $this->isSystemAdmin($actor))) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        if ($actor->id === $user->id) {
            return response()->json(['message' => 'You cannot archive your own account.'], 403);
        }

        if (! $this->canManageOther($actor, $user)) {
            return response()->json(['message' => 'You do not have permission to archive this user.'], 403);
        }

        $email = $user->email;
        $user->update(['is_archived' => true]);
        ActivityLog::record('archived_user', 'User Management', "Archived user {$email}");

        return response()->json(['message' => 'User archived successfully.']);
    }

    public function unarchive(User $user): JsonResponse
    {
        /** @var User|null $actor */
        $actor = auth()->user();

        if (! $actor) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        if (! ($this->isAdmin($actor) || $this->isSystemAdmin($actor))) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        if ($actor->id === $user->id) {
            return response()->json(['message' => 'You cannot unarchive your own account.'], 403);
        }

        if (! $this->canManageOther($actor, $user)) {
            return response()->json(['message' => 'You do not have permission to unarchive this user.'], 403);
        }

        if ($user->trashed()) {
            return response()->json([
                'message' => 'Cannot unarchive a deleted user.',
            ], 422);
        }

        $email = $user->email;

        $user->update(['is_archived' => false]);
        ActivityLog::record('unarchived_user', 'User Management', "Unarchived user {$email}");

        return response()->json(['message' => 'User unarchived successfully.']);
    }

    public function softDelete(User $user): JsonResponse
    {
        /** @var User|null $actor */
        $actor = auth()->user();

        if (! $actor) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        if (! ($this->isAdmin($actor) || $this->isSystemAdmin($actor))) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        if ($actor->id === $user->id) {
            return response()->json(['message' => 'You cannot delete your own account.'], 403);
        }

        if (! $this->canManageOther($actor, $user)) {
            return response()->json(['message' => 'You do not have permission to delete this user.'], 403);
        }

        $email = $user->email;

        $user->delete();

        ActivityLog::record('deleted_user', 'User Management', "Soft-deleted user {$email}");

        return response()->json([
            'message' => 'User deleted successfully.',
        ]);
    }
}

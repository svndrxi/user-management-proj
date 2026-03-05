<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasPermission('manage_users') ?? false;
    }

    public function rules(): array
    {
        $user = $this->route('user');
        $userId = is_object($user) ? $user->id : $user;

        return [
            'employee_id'      => ['required', 'string', 'max:255', Rule::unique('users', 'employee_id')->ignore($userId)],
            'first_name'       => ['required', 'string', 'max:255'],
            'middle_name'      => ['nullable', 'string', 'max:255'],
            'last_name'        => ['required', 'string', 'max:255'],
            'username'         => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($userId)],
            'email'            => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            'password'         => ['nullable', 'string', 'min:8', 'confirmed'],
            'office_id'        => ['required', 'exists:offices,id'],
            'role_id'          => ['required', 'exists:roles,id'],
            'permission_ids'   => ['nullable', 'array'],
            'permission_ids.*' => ['integer', 'exists:permissions,id'],
        ];
    }
}

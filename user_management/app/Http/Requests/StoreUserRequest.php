<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasPermission('manage_users') ?? false;
    }

    public function rules(): array
    {
        return [
            'employee_id'      => ['required', 'string', 'max:255', 'unique:users,employee_id'],
            'first_name'       => ['required', 'string', 'max:255'],
            'middle_name'      => ['nullable', 'string', 'max:255'],
            'last_name'        => ['required', 'string', 'max:255'],
            'username'         => ['required', 'string', 'max:255', 'unique:users,username'],
            'email'            => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
            'office_id'        => ['required', 'exists:offices,id'],
            'role_id'          => ['required', 'exists:roles,id'],
            'permission_ids'   => ['nullable', 'array'],
            'permission_ids.*' => ['integer', 'exists:permissions,id'],
        ];
    }
}

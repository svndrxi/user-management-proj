<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasPermission('manage_roles') ?? false;
    }

    public function rules(): array
    {
        return [
            'name'             => ['required', 'string', 'max:255', 'unique:roles,name'],
            'description'      => ['nullable', 'string', 'max:255'],
            'permission_ids'   => ['nullable', 'array'],
            'permission_ids.*' => ['integer', 'exists:permissions,id'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasPermission('manage_permissions') ?? false;
    }

    public function rules(): array
    {
        $permission = $this->route('permission');
        $permissionId = is_object($permission) ? $permission->id : $permission;

        return [
            'name'        => ['required', 'string', 'max:255'],
            'slug'        => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('permissions', 'slug')->ignore($permissionId)],
            'description' => ['nullable', 'string'],
        ];
    }
}

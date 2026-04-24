<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('manage-roles');
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

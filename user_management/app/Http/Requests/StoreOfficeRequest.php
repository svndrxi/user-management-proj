<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreOfficeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('manage-offices');
    }

    public function rules(): array
    {
        return [
            'office_code' => ['required', 'string', 'max:255', 'unique:offices,office_code'],
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateOfficeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('manage-offices');
    }

    public function rules(): array
    {
        $office = $this->route('office');
        $officeId = is_object($office) ? $office->id : $office;

        return [
            'office_code' => ['required', 'string', 'max:255', Rule::unique('offices', 'office_code')->ignore($officeId)],
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }
}

<?php

namespace App\Http\Requests\Webapp;

use Illuminate\Foundation\Http\FormRequest;

class AssetTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'asset_category_id' => ['required', 'exists:asset_categories,id'],
        ];
        if ($this->isMethod('post')) {
            $rules += [
                'name' => ['required', 'min:3', 'max:64', 'unique:asset_types'],
            ];
        } else {
            $rules += [
                'name' => ['required', 'min:3', 'max:64', 'unique:asset_types,id,' . $this->id],
            ];
        }

        return $rules;
    }
}

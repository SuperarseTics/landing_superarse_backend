<?php

namespace App\Http\Requests\Submenu;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddRequest extends FormRequest
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
        return [
            'menus_id'  => ['required', Rule::exists('menus', 'id')->where('active', 1)],
            'name'      => ['required', 'string', 'max:255']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'menus_id.required' => 'El menú es obligatoria.',
            'menus_id.exists' => 'El menú seleccionada no existe.'
        ];
    }
}
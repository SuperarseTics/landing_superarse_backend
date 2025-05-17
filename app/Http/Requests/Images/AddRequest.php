<?php

namespace App\Http\Requests\Images;

use Illuminate\Foundation\Http\FormRequest;

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
            'img' => ['file','mimes:jpg,jpeg,png,bmp,gif,svg,webp']
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
            // 'img.required'  => 'La imagen es obligatoria.',
            'img.file'      => 'La imagen debe ser un archivo válido.',
            'img.mimes'     => 'La imagen debe ser un archivo de tipo: jpg, jpeg, png, bmp, gif, svg, webp.'
        ];
    }
}

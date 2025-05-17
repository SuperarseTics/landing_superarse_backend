<?php

namespace App\Http\Requests\Page;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'id'            => ['required', 'integer'],
            'options_id'    => ['required', Rule::exists('submenu_options', 'id')->where('active', 1)],
            'ruta'          => ['required', 'string', 'max:255'],
            'properties'    => ['required']
        ];
    }
}

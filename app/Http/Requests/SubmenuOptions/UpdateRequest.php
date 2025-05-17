<?php

namespace App\Http\Requests\SubmenuOptions;

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
            'id'        => ['required', 'integer', Rule::exists('submenus', 'id')],          
            'submenus_id'   => ['required', Rule::exists('submenus', 'id')->where('active', 1)],
            'name'      => ['required', 'string', 'max:255'],
            'active'    => ['required','in:0,1']
        ];
    }
}

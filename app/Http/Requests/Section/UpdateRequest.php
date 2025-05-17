<?php

namespace App\Http\Requests\Section;

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
            'pages_id'      => ['required', Rule::exists('pages', 'id')],
            'widgets_id'    => ['required', Rule::exists('widgets', 'id')],
            'name'          => ['required', 'string', 'max:255'],
            'properties'    => ['required'],
            'data'          => ['required']
        ];
    }
}

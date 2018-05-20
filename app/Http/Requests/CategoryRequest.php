<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required|string|min:3|max:255|' . $this->getUniqueNameRule(),
            'description' => 'required|string',
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'name'        => trans('categories.fields.name'),
            'description' => trans('categories.fields.description'),
        ];
    }

    /**
     * @return Unique
     */
    private function getUniqueNameRule(): Unique
    {
        $rule = Rule::unique('categories');

        if (Request::METHOD_PUT === $this->getMethod()) {
            $rule->ignore($this->route('category'));
        }

        return $rule;
    }
}

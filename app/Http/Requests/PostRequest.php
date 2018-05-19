<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true || auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'required|string|min:3|max:255|' . $this->getUniqueNameRule(),
            'content' => 'required|string',
            'file'    => 'nullable|file|image|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'name'    => trans('posts.fields.name'),
            'content' => trans('posts.fields.content'),
            'file'    => trans('posts.fields.file'),
        ];
    }

    /**
     * @return Unique
     */
    private function getUniqueNameRule(): Unique
    {
        $rule = Rule::unique('posts');

        if (Request::METHOD_PUT === $this->getMethod()) {
            $rule->ignore($this->route('post'));
        }

        return $rule;
    }
}

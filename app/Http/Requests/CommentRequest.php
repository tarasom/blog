<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $relationKeys = array_keys(Relation::$morphMap);

        return [
            'author'           => 'required|string|min:3|max:255',
            'content'          => 'required|string',
            'commentable_type' => 'required|string|in:' . implode(',', $relationKeys),
            'commentable_id'   => 'required|string|' . $this->getExistsRule(),
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
     * @return string
     */
    private function getExistsRule(): string
    {
        $relationMapping = Relation::$morphMap;

        $entityClass = array_get($relationMapping, $this->commentable_type);
        $tableName   = (new $entityClass())->getTable();

        return sprintf('exists:%1$s,id', $tableName);
    }
}

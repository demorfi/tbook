<?php

namespace App\Http\Requests\Create;

use App\Http\Requests\Request;

/**
 * Class Product.
 *
 * @package App\Http\Requests\Create
 */
class Product extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ([
            'name'             => 'required',
            'categories_ids.*' => 'exists:categories,id'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function sanitize()
    {
        return ($this->onlySanitize(['name']));
    }
}

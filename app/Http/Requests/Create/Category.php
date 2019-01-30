<?php

namespace App\Http\Requests\Create;

use App\Http\Requests\Request;

/**
 * Class Category.
 *
 * @package App\Http\Requests\Create
 */
class Category extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ([
            'name' => 'required'
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

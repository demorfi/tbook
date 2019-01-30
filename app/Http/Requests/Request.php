<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Request.
 *
 * @package App\Http\Requests
 */
abstract class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (true);
    }

    /**
     * Get the sanitized input for the request.
     *
     * @return array
     */
    public function sanitize()
    {
        return ($this->except(['api_token']));
    }

    /**
     * Get a subset containing the provided keys with values from the input data.
     *
     * @param  mixed ...$keys
     * @return array
     */
    protected function onlySanitize(...$keys)
    {
        return ($this->only(...$keys));
    }
}

<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model as EloquentModel;

/**
 * Class Model.
 *
 * @package App\Contracts
 */
class Model extends EloquentModel
{

    /**
     * The attributes that are not allow mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @inheritdoc
     */
    public function __construct(array $attributes = [])
    {
        if ($this->timestamps) {
            if (!is_null(static::CREATED_AT)) {
                $this->dates[] = static::CREATED_AT;
            }

            if (!is_null(static::UPDATED_AT)) {
                $this->dates[] = static::UPDATED_AT;
            }
        }

        parent::__construct($attributes);
    }
}

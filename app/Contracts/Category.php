<?php

namespace App\Contracts;

/**
 * Class Category.
 *
 * @property int       $id
 * @property string    $name
 * @package App\Contracts
 */
class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}

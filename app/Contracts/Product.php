<?php

namespace App\Contracts;

/**
 * Class Product.
 *
 * @property int        $id
 * @property string     $name
 * @property Category[] $categories
 * @package App\Contracts
 */
class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Defining a Many To Many relation with Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|\Illuminate\Database\Eloquent\Builder
     */
    public function categories()
    {
        return ($this->belongsToMany(
            Category::class,
            'category_products',
            'product_id',
            'category_id'
        ));
    }
}

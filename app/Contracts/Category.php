<?php

namespace App\Contracts;

/**
 * Class Category.
 *
 * @property int       $id
 * @property string    $name
 * @property string    $products_path
 * @property Product[] $products
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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['products_path'];

    /**
     * Append "products_path" attribute.
     *
     * @return string
     */
    public function getProductsPathAttribute()
    {
        return (action('CategoryController@show', ['id' => $this->id]));
    }

    /**
     * Defining a Many To Many relation with Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|\Illuminate\Database\Eloquent\Builder
     */
    public function products()
    {
        return ($this->belongsToMany(
            Product::class,
            'category_products',
            'category_id',
            'product_id'
        ));
    }
}

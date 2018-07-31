<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =[
        'name',
        'product_id',
        'description',
    ];
    public function Product()
    {
            return $this ->belongsto(Product::class);
    }
    public function user()
    {
            return $this ->belongsto(user::class);
    }
}

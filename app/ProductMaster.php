<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductMaster extends Model {

    protected $fillable = [
        'product_code',
        'product_name',
        'kg',
        'selling_price',
    ];

}

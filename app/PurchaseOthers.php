<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PurchaseOthers extends Model {

    protected $dates = ['sale_date'];

    protected $fillable = [
        'purchase_number',
        'product_code',
        'product_name',
        'mrp',
        'selling_price',
        'group_name',
        'measuring_type',
        'quantity',
        'total',
        'sale_date'
    ];

    public function setSaleDateAttribute($sale_date){
        $this->attributes['sale_date'] = Carbon::parse($sale_date);
    }

}

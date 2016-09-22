<?php namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BillingOthers extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at', 'sale_date'];


    protected $fillable = [
        'bill_number',
        'product_code',
        'product_name',
        'kg',
        'selling_price',
        'quantity',
        'total',
        'sale_date'
    ];

    public function setSaleDateAttribute($sale_date){
        $this->attributes['sale_date'] = Carbon::parse($sale_date);
    }

}

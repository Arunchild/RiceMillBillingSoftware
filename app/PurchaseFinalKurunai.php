<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PurchaseFinalKurunai extends Model {

    protected $dates = ['sale_date'];

    protected $fillable = [
        'purchase_number',
        'grand_total',
        'discount',
        'net_amount',
        'customer_name',
        'customer_phone',
        'address',
        'sale_date'
    ];

    public function setSaleDateAttribute($sale_date){
        $this->attributes['sale_date'] = Carbon::parse($sale_date);
    }

}

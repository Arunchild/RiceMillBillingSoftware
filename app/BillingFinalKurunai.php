<?php namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BillingFinalKurunai extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at', 'sale_date'];

    protected $fillable = [
        'bill_number',
        'total_kg',
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

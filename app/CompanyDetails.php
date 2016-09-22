<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyDetails extends Model {

	protected $fillable = [
        'tin',
        'cst',
        'companyname',
        'billingname',
        'phone',
        'addressline1',
        'addressline2',
        'terms_and_conditions'
    ];

}

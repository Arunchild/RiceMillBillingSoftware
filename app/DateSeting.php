<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DateSeting extends Model {

    protected $dates = ['from_date', 'to_date'];

    protected $fillable = [
        'from_date',
        'to_date'
    ];

    public function setFromDateAttribute($from_date){
        $this->attributes['from_date'] = Carbon::parse($from_date);
    }

    public function setToDateAttribute($to_date){
        $this->attributes['to_date'] = Carbon::parse($to_date);
    }


}

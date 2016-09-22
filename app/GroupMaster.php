<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMaster extends Model {

    protected $fillable = [
        'group_name',
        'tax_percentage'
    ];

}

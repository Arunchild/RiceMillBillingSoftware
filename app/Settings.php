<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model {

    protected $fillable = [
        'printer_name',
        'copy',
        'preprint_space',
        'bill_paper'
    ];


}

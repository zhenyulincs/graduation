<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produces extends Model
{
    // table name
    protected $table = 'produces';
    public $timestamps = true;
    protected $fillable = [
        'title', 'description', 'cover','left','userid','prices',
    ];
}

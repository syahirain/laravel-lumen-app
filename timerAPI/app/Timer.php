<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    public $timestamps = FALSE;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'unique_code'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}


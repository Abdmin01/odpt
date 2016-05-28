<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Profile extends Authenticatable
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'bdate', 'numphone', 'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    //Table Name
    protected $table = "admin";
    /**
     * The attributes that are guarded from mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function setUpdatedAtAttribute($value)
    {
        // to Disable updated_at
    }

}

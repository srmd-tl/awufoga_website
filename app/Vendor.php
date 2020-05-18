<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    /*Table name*/
    protected $table = "vendor";
    /**
     * The attributes that are guarded to mass assignable.
     *
     * @var array
     */
    protected $guarded = [
    ];

    const UPDATED_AT = null;

    /*Getters*/
    public function getFullPhoneAttribute()
    {
        return "{$this->country_code} {$this->phone}";
    }
}

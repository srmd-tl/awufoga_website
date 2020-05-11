<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    /*Table name*/
    protected $table = "buyer";
    /**
     * The attributes that are guarded to mass assignable.
     *
     * @var array
     */
    protected $guarded = [
    ];

    const UPDATED_AT = null;
}

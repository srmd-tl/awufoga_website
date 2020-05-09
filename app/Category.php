<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /*Table name*/
    protected $table = "category";
    /**
     * The attributes that are guarded to mass assignable.
     *
     * @var array
     */
    protected $guarded = [
    ];
    public $timestamps=false;
}

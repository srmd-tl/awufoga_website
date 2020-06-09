<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    /*Table name*/
    protected $table = "sub_category";
    /**
     * The attributes that are guarded to mass assignable.
     *
     * @var array
     */
    protected $guarded = [
    ];
    public $timestamps = false;

    /*Relations*/
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = "blog";
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
    ];

    //Relations
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}

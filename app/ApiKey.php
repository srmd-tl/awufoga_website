<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    protected $table = "admin_api_keys";
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
    ];

    //Relations
    public function keyType()
    {
        return $this->belongsTo('App\KeyType');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupon';
    const UPDATED_AT = null;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
    ];
    //Relations
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }
    public function images()
    {
        return $this->hasMany('App\CouponImage');
    }
    public function categories()
    {
        return $this->belongsToMany('App\Category','coupon_category','coupon_id','category_id');
    }
}

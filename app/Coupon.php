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
        return $this->belongsToMany('App\Category', 'coupon_category', 'coupon_id', 'category_id');
    }
    public function subcategories()
    {
        return $this->belongsToMany('App\Category', 'coupon_category', 'coupon_id', 'category_id');
    }
    public function ratings()
    {
        return $this->belongsToMany('App\Buyer', 'coupon_rating', 'coupon_id', 'buyer_id');
    }

    /*Customn Function*/
    public function singleCouponRating($buyerId)
    {
        $data = $this->belongsToMany('App\Buyer', 'coupon_rating', 'coupon_id', 'buyer_id')->withPivot('rating')->whereBuyerId($buyerId)->first();
        return $data;
    }
}

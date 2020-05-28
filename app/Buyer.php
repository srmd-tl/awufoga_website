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

    /*Getters*/
    public function getFullPhoneAttribute()
    {
        return "{$this->country_code} {$this->phone}";
    }
    //Relations
    public function usedCoupons()
    {
        return $this->hasMany('App\UsedCoupon');
    }
    public function usedFavCoupons()
    {
        return $this->hasMany('App\UsedCoupon')->where('');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'vendor_category', 'vendor_id', 'category_id');
    }

    public function most()
    {
        $data = $this->usedCoupons()
            ->groupBy('coupon_id')
            ->selectRaw('coupon_id,count(*) as count')
            ->orderByRaw('count DESC')
            ->first();
        if ($data) {
            
            $coupon = Coupon::whereId($data->coupon_id)->first();
            dd($coupon->with('categories')->get());
            return $coupon->with('categories');
        }
        return null;
        // dd($data);

        return $this->usedCoupons()
            ->groupBy('coupon_id')
            ->count();
    }
    public function favCoupons()
    {
        return $this->belongsToMany('App\Coupon', 'coupon_like_unlike');
    }
}

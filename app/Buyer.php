<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
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
        return $this->hasMany('App\UsedCoupon', 'buyer_id');
    }
    public function usedFavCoupons()
    {
        return $this->hasMany('App\UsedCoupon')->where('');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'vendor_category', 'vendor_id', 'category_id');
    }
    public function referrals()
    {
        return $this->hasMany('App\ReferralHistory', 'buyer_id')->where('referral_buyer', 'like', 'buyer_%');
    }
    public function mostUsedCategories()
    {
        $data = $this->usedCoupons()
            ->groupBy('coupon_id')
            ->selectRaw('coupon_id,count(*) as count,SUM(paid_price) as price_total')
            ->orderByRaw('count DESC')
            ->first();
        if ($data) {
            $coupon = Coupon::with('categories')->whereId($data->coupon_id)->first();

            return $coupon;

        }
        return null;
        // dd($data);

        return $this->usedCoupons()
            ->groupBy('coupon_id')
            ->count();
    }
    public function mostUsedSubCategories($categoryId)
    {
        $categoryIds=Arr::pluck($categoryId,'id');
        $data = $this->usedCoupons()
            ->groupBy('coupon_id')
            ->selectRaw('coupon_id,count(*) as count')
            ->orderByRaw('count DESC')
            ->first();
        if ($data) {

            $coupon = Coupon::with(['subcategories'=>function($query) use($categoryIds){
                $query->whereIn('coupon_sub_category.category_id',$categoryIds);
            }])->whereId($data->coupon_id)->first();
            return $coupon;

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

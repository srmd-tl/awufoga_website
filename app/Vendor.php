<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
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
    //Relations
    public function usedCoupons()
    {
        return $this->hasMany('App\UsedCoupon');
    }
    public function activeCoupons()
    {
        return $this->hasMany('App\Coupon')->where('created_at', '>', Carbon::now());
    }
    public function expiredCoupons()
    {
        return $this->hasMany('App\Coupon')->where('created_at', '<', Carbon::now());
    }
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'vendor_category', 'vendor_id', 'category_id');
    }
    public function referrals()
    {
        return $this->hasMany('App\ReferralHistory','vendor_id')->where('referral_vendor','like','vendor_%');
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
}

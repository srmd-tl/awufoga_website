<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsedCoupon extends Model
{
    //
    protected $table = "used_coupon";

    /*Relations*/
    public function coupon()
    {
        return $this->belongsTo('App\Coupon');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }

    public function buyer()
    {
        return $this->belongsTo('App\Buyer');
    }
}

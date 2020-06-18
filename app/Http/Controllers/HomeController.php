<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\UsedCoupon;
use App\Coupon;
use App\Vendor;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = [

            "prevMonthBuyer"  => Buyer::whereMonth('created_at', Carbon::now()->subMonth()->month)->count(),
            "todaysBuyer"     => Buyer::whereDate('created_at', Carbon::now()->toDateString())->count(),

            "todaysVendor"    => Vendor::whereDate('created_at', Carbon::now()->toDateString())->count(),
            "prevMonthVendor" => Vendor::whereMonth('created_at', Carbon::now()->subMonth()->month)->count(),

            "coupons"         => Coupon::whereStatus(0)->paginate(5),
            "vendors"         => Vendor::whereStatus(-1)->paginate(5),

            "paidAmount"      => UsedCoupon::whereDate('created_at',Carbon::now()->toDateString())->sum('paid_price'),
        ];
        return view('dashboard', $data);
    }
}

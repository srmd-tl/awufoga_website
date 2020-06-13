<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Vendor;

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
            "coupons" => Coupon::whereStatus(0)->paginate(5),
            "vendors" => Vendor::whereStatus(-1)->paginate(5),
        ];
        return view('dashboard',$data);
    }
}

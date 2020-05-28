<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Vendor;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            "coupons" => (!is_null(request()->filter) || !is_null(request()->statusFilter)) ?

            Coupon::when(
                (
                    (!is_null(request()->filter) && is_null(request()->statusFilter) || (is_null(request()->filter) && !is_null(request()->statusFilter)))

                    && (request()->statusFilter == "0" || request()->statusFilter == "1" || request()->filter == "0" || request()->filter == "1" || request()->filter == "Active" || request()->filter == "Inactive")
                ), function ($query, $filter) {
                    $data = request()->filter;
                    if (request()->filter == "Active" || request()->filter == "1" || request()->statusFilter == "1") {
                        $data = 1;
                    } else {
                        $data = 0;
                    }

                    return $query->whereStatus($data);
                }, function ($query, $filter) use ($request) {
                    return $query
                        ->where(function ($query) {

                            if (!is_null(request()->statusFilter)) {
                                $data = 0;
                                if (request()->statusFilter == "1") {
                                    $data = 1;
                                }

                                return $query->whereStatus($data);
                            }

                            return;
                        })
                        ->where(function ($query) {
                            return $query->where("full_name", "like", "%" . request()->filter . "%")
                                ->orWhere('user_name', 'like', "%" . request()->filter . "%")
                                ->orWhere('email', request()->filter)
                                ->orWhere('phone', request()->filter);
                        });

                })
                ->paginate(20) :

            Coupon::paginate(20),
            "vendors" => Vendor::all(),
        ];
        return view('coupons.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon, Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $data = [
            'title'       => $request->title,
            'vendor_id'   => $request->vendor,
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            // 'coupon_type'        => ['required', 'file'],
            'discount'    => $request->discount,
            'terms'       => $request->terms,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
            'featured'    => $request->featured,
            'status'      => $request->status,
        ];
        $coupon->update($data);
        return redirect()->route('coupon.index')->withSuccess("Coupn Updated!");
    }
    /**
     * Update the Status
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, Coupon $coupon)
    {
        $coupon->update(['status' => $request->status]);
        return redirect()->route('coupon.index')->withSuccess("Coupon Status Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupon.index')->withSuccess("Coupon Deleted!");
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title'       => ['required', 'string', 'max:255'],
            'vendor'      => ['required', 'string', 'max:255'],
            'description' => ['required', 'email', 'max:255'],
            'start_date'  => ['required', 'string', 'max:255'],
            'end_date'    => ['required', 'string', 'max:255'],
            // 'coupon_type'        => ['required', 'file'],
            'discount'    => ['required', 'string'],
            'terms'       => ['required', 'string'],
            'latitude'    => ['required', 'string'],
            'longitude'   => ['required', 'string'],
            'featured'    => ['required', 'string'],
            'status'      => ['required', 'string'],
        ]);
    }
}

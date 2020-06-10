<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Vendor;
use Illuminate\Http\Request;
use Carbon\Carbon;
class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $coupons         = null;
        $couponMainQuery = Coupon::
            when($request->fromDate && $request->toDate, function ($query) use ($request) {
            $query->where(function ($query) use ($request) {

                return $query->whereDate('created_at', '>=', $request->fromDate)
                    ->whereDate('created_at', '<', $request->toDate);

            });
        }, function ($query) use ($request) {

            if ($request->fromDate) {
                $query->whereDate('created_at', '>=', $request->fromDate);
            } else if ($request->toDate) {

                $query->whereDate('created_at', '<=', $request->toDate);
            }
        })
        //Is Favourite Filter
            ->where(function ($query) use ($request) {
                if (isset($request->isFavouriteFilter)) {
                    $query->whereStatus(3);
                }
            })
        //Status  Filter
            ->where(function ($query) use ($request) {
                if (isset($request->activeFilter)&&$request->activeFilter==1) {
                  
                    $query->whereDate('end_date','>=',Carbon::now()->toDateString());
                }
                elseif(isset($request->activeFilter)&&$request->activeFilter==0) 
                {
                    $query->whereDate('end_date','<',Carbon::now()->toDateString());

                }
            })

        //Discount Filter
            ->where(function ($query) use ($request) {
                if (isset($request->discountFilter)) {
                    $query->whereDiscount($request->discountFilter);
                }

            })
        //Description Filter
            ->where(function ($query) use ($request) {

                $query->where('description', 'like', '%' . $request->descriptionFilter . '%');

            })
        //Terms Filter
            ->where(function ($query) use ($request) {

                $query->where('terms', 'like', '%' . $request->termsFilter . '%');

            })
        //Coupon Name Filter
            ->where(function ($query) use ($request) {

                $query->where('title', 'like', '%' . $request->nameFilter . '%');

            })

        //Category Filter
            ->where(function ($query) use ($request) {
                if (!is_null($request->categoryFilter) && $request->categoryFilter != "All") {

                    $query->whereHas('usedCoupons', function ($innserQuery) use ($request) {

                        $innserQuery->whereHas('coupon', function ($mostInnerQuery) use ($request) {
                            $mostInnerQuery->whereHas('categories', function ($couponCategoryQuery) use ($request) {
                                $couponCategoryQuery->whereCategoryId($request->categoryFilter);

                            });
                        });
                    });
                }

            });

        $data = [
            "coupons" => $couponMainQuery->paginate(20),
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

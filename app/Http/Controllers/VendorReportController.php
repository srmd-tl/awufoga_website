<?php

namespace App\Http\Controllers;

use App\Category;
use App\Exports\VendorExport;
use App\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class VendorReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vendors         = null;
        $vendorMainQuery = Vendor::
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
            } else {
                $query->whereDate('created_at', '>=', Carbon::now()->startOfMonth()->toDateString())
                    ->whereDate('created_at', '<=', Carbon::now()->endOfMonth()->toDateString());
            }
        })
        //Status Filter
            ->where(function ($query) use ($request) {

                $query->whereStatus($request->activeFilter ?? 1);
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

        //Order By Filter
        if ($request->orderByFilter == "mostPurchasing") {

            $vendors = $vendorMainQuery->select('vendor.*', \DB::raw('(SELECT count(*) as totalPurchase FROM used_coupon where vendor.id = used_coupon.vendor_id)  as sort'))
                ->orderBy('sort', 'desc');

        } else if ($request->orderByFilter == "leastPurchasing") {
            $vendors = $vendorMainQuery->select('vendor.*', \DB::raw('(SELECT count(*) as totalPurchase FROM used_coupon where vendor.id = used_coupon.vendor_id)  as sort'))
                ->orderBy('sort', 'asc');

        } else if ($request->orderByFilter == "highestWallet") {
            $vendors = $vendorMainQuery->select('vendor.*', \DB::raw('(SELECT SUM(payment_wallet) as totalPurchase FROM used_coupon where vendor.id = used_coupon.vendor_id)  as sort'))
                ->orderBy('sort', 'desc');

        } else if ($request->orderByFilter == "lowestWallet") {
            $vendors = $vendorMainQuery->select('vendor.*', \DB::raw('(SELECT SUM(payment_wallet) as totalPurchase FROM used_coupon where vendor.id = used_coupon.vendor_id)  as sort'))
                ->orderBy('sort', 'asc');
        } else {
            $vendors = $vendorMainQuery;
        }
        //Enwrapping Data
        $data =
            [
            "vendors"    => $vendors->paginate(30),
            "categories" => Category::all(),
        ];

        //Report Type Check
        if (request()->pdf) {
            $pdf = PDF::loadView('reports.pdfViews.vendorReport', $data);
            return $pdf->download('vendorReport_' . Carbon::now() . '.pdf');
        } elseif (request()->excel) {
            return Excel::download(new VendorExport, 'vendorReport_' . Carbon::now() . '.xlsx');
        }
        return view('reports.vendorReport', $data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

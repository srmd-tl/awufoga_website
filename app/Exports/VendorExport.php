<?php

namespace App\Exports;

use App\Vendor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VendorExport implements FromView
{
    public function view(): View
    {
        $vendors        = null;
        $buyerMainQuery = Vendor::
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

            $vendors = $buyerMainQuery->select('vendor.*', \DB::raw('(SELECT count(*) as totalPurchase FROM used_coupon where vendor.id = used_coupon.buyer_id)  as sort'))
                ->orderBy('sort', 'desc');

        } else if ($request->orderByFilter == "leastPurchasing") {
            $vendors = $buyerMainQuery->select('vendor.*', \DB::raw('(SELECT count(*) as totalPurchase FROM used_coupon where vendor.id = used_coupon.buyer_id)  as sort'))
                ->orderBy('sort', 'asc');

        } else if ($request->orderByFilter == "highestWallet") {
            $vendors = $buyerMainQuery->select('vendor.*', \DB::raw('(SELECT SUM(payment_wallet) as totalPurchase FROM used_coupon where vendor.id = used_coupon.buyer_id)  as sort'))
                ->orderBy('sort', 'desc');

        } else if ($request->orderByFilter == "lowestWallet") {
            $vendors = $buyerMainQuery->select('vendor.*', \DB::raw('(SELECT SUM(payment_wallet) as totalPurchase FROM used_coupon where vendor.id = used_coupon.buyer_id)  as sort'))
                ->orderBy('sort', 'asc');
        } else {
            $vendors = $buyerMainQuery;
        }
        //Enwrapping Data
        $data =
            [
            "vendors"    => $vendors->paginate(20),
            "categories" => Category::all(),
        ];
        return view('reports.pdfViews.vendorReport', $data);
    }
}

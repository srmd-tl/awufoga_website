<?php

namespace App\Exports;

use App\Category;
use App\Vendor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VendorExport implements FromView
{
    public function view(): View
    {
        $vendors        = null;
        $buyerMainQuery = Vendor::
            when(request()->fromDate && request()->toDate, function ($query) {
            $query->where(function ($query) {

                return $query->whereDate('created_at', '>=', request()->fromDate)
                    ->whereDate('created_at', '<', request()->toDate);

            });
        }, function ($query) {

            if (request()->fromDate) {
                $query->whereDate('created_at', '>=', request()->fromDate);
            } else if (request()->toDate) {

                $query->whereDate('created_at', '<=', request()->toDate);
            } else {
                $query->whereDate('created_at', '>=', Carbon::now()->startOfMonth()->toDateString())
                    ->whereDate('created_at', '<=', Carbon::now()->endOfMonth()->toDateString());
            }
        })
        //Status Filter
            ->where(function ($query) {

                $query->whereStatus(request()->activeFilter ?? 1);
            })
        //Category Filter
            ->where(function ($query) {
                if (!is_null(request()->categoryFilter) && request()->categoryFilter != "All") {

                    $query->whereHas('usedCoupons', function ($innserQuery) {

                        $innserQuery->whereHas('coupon', function ($mostInnerQuery) {
                            $mostInnerQuery->whereHas('categories', function ($couponCategoryQuery) {
                                $couponCategoryQuery->whereCategoryId(request()->categoryFilter);

                            });
                        });
                    });
                }

            });

        //Order By Filter
        if (request()->orderByFilter == "mostPurchasing") {

            $vendors = $buyerMainQuery->select('vendor.*', \DB::raw('(SELECT count(*) as totalPurchase FROM used_coupon where vendor.id = used_coupon.buyer_id)  as sort'))
                ->orderBy('sort', 'desc');

        } else if (request()->orderByFilter == "leastPurchasing") {
            $vendors = $buyerMainQuery->select('vendor.*', \DB::raw('(SELECT count(*) as totalPurchase FROM used_coupon where vendor.id = used_coupon.buyer_id)  as sort'))
                ->orderBy('sort', 'asc');

        } else if (request()->orderByFilter == "highestWallet") {
            $vendors = $buyerMainQuery->select('vendor.*', \DB::raw('(SELECT SUM(payment_wallet) as totalPurchase FROM used_coupon where vendor.id = used_coupon.buyer_id)  as sort'))
                ->orderBy('sort', 'desc');

        } else if (request()->orderByFilter == "lowestWallet") {
            $vendors = $buyerMainQuery->select('vendor.*', \DB::raw('(SELECT SUM(payment_wallet) as totalPurchase FROM used_coupon where vendor.id = used_coupon.buyer_id)  as sort'))
                ->orderBy('sort', 'asc');
        } else {
            $vendors = $buyerMainQuery;
        }
        //Enwrapping Data
        $data =
            [
            "vendors"    => $vendors->paginate(30),
            "categories" => Category::all(),
        ];
        return view('reports.pdfViews.vendorReport', $data);
    }
}

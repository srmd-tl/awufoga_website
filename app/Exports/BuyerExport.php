<?php

namespace App\Exports;

use App\Buyer;
use App\Category;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BuyerExport implements FromView
{
    public function view(): View
    {
        $buyers         = null;
        $buyerMainQuery = Buyer::
            when(request()->fromDate && request()->toDate, function ($query)  {
            $query->where(function ($query)  {

                return $query->whereDate('created_at', '>=', request()->fromDate)
                    ->whereDate('created_at', '<', request()->toDate);

            });
        }, function ($query)  {

            if (request()->fromDate) {
                $query->whereDate('created_at', '>=', request()->fromDate);
            } else if (request()->toDate) {

                $query->whereDate('created_at', '<=', request()->toDate);
            }
        })
        //Status Filter
            ->where(function ($query)  {

                $query->whereStatus(request()->activeFilter ?? 1);
            })
        //Category Filter
            ->where(function ($query)  {
                if (!is_null(request()->categoryFilter) && request()->categoryFilter != "All") {

                    $query->whereHas('usedCoupons', function ($innserQuery)  {

                        $innserQuery->whereHas('coupon', function ($mostInnerQuery)  {
                            $mostInnerQuery->whereHas('categories', function ($couponCategoryQuery)  {
                                $couponCategoryQuery->whereCategoryId(request()->categoryFilter);

                            });
                        });
                    });
                }

            });

        //Order By Filter
        if (request()->orderByFilter == "mostPurchasing") {

            $buyers = $buyerMainQuery->select('buyer.*', \DB::raw('(SELECT count(*) as totalPurchase FROM used_coupon where buyer.id = used_coupon.buyer_id)  as sort'))
                ->orderBy('sort', 'desc');

        } else if (request()->orderByFilter == "leastPurchasing") {
            $buyers = $buyerMainQuery->select('buyer.*', \DB::raw('(SELECT count(*) as totalPurchase FROM used_coupon where buyer.id = used_coupon.buyer_id)  as sort'))
                ->orderBy('sort', 'asc');

        } else if (request()->orderByFilter == "highestWallet") {
            $buyers = $buyerMainQuery->select('buyer.*', \DB::raw('(SELECT SUM(payment_wallet) as totalPurchase FROM used_coupon where buyer.id = used_coupon.buyer_id)  as sort'))
                ->orderBy('sort', 'desc');

        } else if (request()->orderByFilter == "lowestWallet") {
            $buyers = $buyerMainQuery->select('buyer.*', \DB::raw('(SELECT SUM(payment_wallet) as totalPurchase FROM used_coupon where buyer.id = used_coupon.buyer_id)  as sort'))
                ->orderBy('sort', 'asc');
        } else {
            $buyers = $buyerMainQuery;
        }
        //Enwrapping Data
        $data =
            [
            "buyers"     => $buyers->paginate(20),
            "categories" => Category::all(),
        ];
        return view('reports.pdfViews.buyerReport', $data);
    }
}

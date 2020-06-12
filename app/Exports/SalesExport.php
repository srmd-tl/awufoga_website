<?php

namespace App\Exports;

use App\Category;
use App\UsedCoupon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalesExport implements FromView
{

    public function view(): View
    {

        $sales          = null;
        $salesMainQuery = UsedCoupon::
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
            }
        })
        //Status Filter
        // ->where(function ($query) {

        //     $query->whereStatus(request()->activeFilter ?? 1);
        // })
        //Category Filter
            ->where(function ($query) {
                if (!is_null(request()->categoryFilter) && request()->categoryFilter != "All") {

                    $query->whereHas('coupon', function ($mostInnerQuery) {
                        $mostInnerQuery->whereHas('categories', function ($couponCategoryQuery) {
                            $couponCategoryQuery->whereCategoryId(request()->categoryFilter);

                        });
                    });

                }

            });

        //Order By Filter
        if (request()->orderByFilter == "highSaleAmount") {

            $sales = $salesMainQuery
                ->orderBy('paid_price', 'desc');

        } else if (request()->orderByFilter == "lowSaleAmount") {
            $sales = $salesMainQuery
                ->orderBy('paid_price', 'asc');

        } else if (request()->orderByFilter == "salesDateAsc") {
            $sales = $salesMainQuery
                ->orderBy('created_at', 'asc');

        } else if (request()->orderByFilter == "salesDateDsc") {
            $sales = $salesMainQuery
                ->orderBy('created_at', 'desc');
        } else {
            $sales = $salesMainQuery;
        }

        //Enwrapping Data
        $data =
            [
            "sales"      => $sales->paginate(20),
            "categories" => Category::all(),
        ];
        return view('reports.pdfViews.salesReport', $data);
    }

}

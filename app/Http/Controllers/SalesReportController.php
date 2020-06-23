<?php

namespace App\Http\Controllers;

use App\Category;
use App\Exports\SalesExport;
use App\UsedCoupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class SalesReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data = ["sales" => UsedCoupon::paginate(), "categories" => Category::all()];

        $sales          = null;
        $salesMainQuery = UsedCoupon::
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
        // ->where(function ($query) use ($request) {

        //     $query->whereStatus($request->activeFilter ?? 1);
        // })
        //Category Filter
            ->where(function ($query) use ($request) {
                if (!is_null($request->categoryFilter) && $request->categoryFilter != "All") {

                    $query->whereHas('coupon', function ($mostInnerQuery) use ($request) {
                        $mostInnerQuery->whereHas('categories', function ($couponCategoryQuery) use ($request) {
                            $couponCategoryQuery->whereCategoryId($request->categoryFilter);

                        });
                    });

                }

            });

        //Order By Filter
        if ($request->orderByFilter == "highSaleAmount") {

            $sales = $salesMainQuery
                ->orderBy('paid_price', 'desc');

        } else if ($request->orderByFilter == "lowSaleAmount") {
            $sales = $salesMainQuery
                ->orderBy('paid_price', 'asc');

        } else if ($request->orderByFilter == "salesDateAsc") {
            $sales = $salesMainQuery
                ->orderBy('created_at', 'asc');

        } else if ($request->orderByFilter == "salesDateDsc") {
            $sales = $salesMainQuery
                ->orderBy('created_at', 'desc');
        } else {
            $sales = $salesMainQuery;
        }

        //Enwrapping Data
        $data =
            [
            "sales"      => $sales->paginate(30),
            "categories" => Category::all(),
        ];

        //Report Type Check
        if (request()->pdf) {
            $pdf = PDF::loadView('reports.pdfViews.salesReport', $data);
            return $pdf->download('salesReport_' . Carbon::now() . '.pdf');
        } elseif (request()->excel) {
            return Excel::download(new SalesExport, 'salesReport_' . Carbon::now() . '.xlsx');
        }

        return view('reports.salesReport', $data);
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

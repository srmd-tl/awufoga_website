<?php

namespace App\Http\Controllers;

use App\Exports\AwufulVendorExport;
use App\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class AwufulReferralVendorReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [

            "vendors" => Vendor::
                when(!is_null(request()->fromDate) || !is_null(request()->toDate) || !is_null(request()->filterorderBy), function ($query) {

            }
                , function ($query) {
                    if (request()->fromDate) {
                        $query->whereDate('created_at', '>=', request()->fromDate);
                    } else if (request()->toDate) {

                        $query->whereDate('created_at', '<=', request()->toDate);
                    } else {
                        $query->whereDate('created_at', '>=', Carbon::now()->startOfMonth()->toDateString())
                            ->whereDate('created_at', '<=', Carbon::now()->endOfMonth()->toDateString());
                    }
                })
                ->whereHas('referrals')
                ->with(['referrals' => function ($query) {
                    $query
                        ->groupBy('referral_vendor', 'vendor_id')
                        ->selectRaw('id,sum(referral_reward) as earnedFromReferral,vendor_id,referral_vendor');
                }])
                ->paginate(30),

        ];

        if (request()->pdf) {
            $pdf = PDF::loadView('reports.pdfViews.awufulReferralVendorReport', $data);
            return $pdf->download('awufulReferralVendorReport_' . Carbon::now() . '.pdf');
        } elseif (request()->excel) {
            return Excel::download(new AwufulVendorExport, 'awufulReferralVendorReport_' . Carbon::now() . '.xlsx');
        }
        return view('reports.awufulReferralVendorReport', $data);
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

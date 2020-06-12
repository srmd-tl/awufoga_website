<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Exports\AwufulBuyerExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class AwufulReferralBuyerReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [

            "buyers" => Buyer::
                when(!is_null(request()->fromDate) || !is_null(request()->toDate) || !is_null(request()->filterorderBy), function ($query) {
                    // if(request()->filterorderBy)
                    // {
                    //     return $query->
                    // }



            }
                , function ($query) {
                    return $query->whereHas('referrals')
                        ->with(['referrals' => function ($query) {
                            $query
                                ->groupBy('referral_buyer', 'buyer_id')
                                ->selectRaw('id,sum(referral_reward) as earnedFromReferral,buyer_id,referral_buyer');
                        }]);
                })

                ->paginate(),

        ];

        if (request()->pdf) {
            $pdf = PDF::loadView('reports.pdfViews.awufulReferralBuyerReport', $data);
            return $pdf->download('awufulReferralBuyerReport_' . Carbon::now() . '.pdf');
        } elseif (request()->excel) {
            return Excel::download(new AwufulBuyerExport, 'awufulReferralBuyerReport_' . Carbon::now() . '.xlsx');
        }
        return view('reports.awufulReferralBuyerReport', $data);
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

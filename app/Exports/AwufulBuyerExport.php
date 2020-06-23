<?php

namespace App\Exports;

use App\Buyer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AwufulBuyerExport implements FromView
{
    public function view(): View
    {
        $data = [

            "buyers" => Buyer::
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
                        ->groupBy('referral_vendor', 'buyer_id')
                        ->selectRaw('id,sum(referral_reward) as earnedFromReferral,buyer_id');
                }])

                ->paginate(30),

        ];
        return view('reports.pdfViews.awufulReferralBuyerReport', $data);

    }
}

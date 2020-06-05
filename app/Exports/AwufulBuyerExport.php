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
                    return $query->whereHas('referrals')
                        ->with(['referrals' => function ($query) {
                            $query
                                ->groupBy('referral_vendor', 'buyer_id')
                                ->selectRaw('id,sum(referral_reward) as earnedFromReferral,buyer_id');
                        }]);
                })

                ->paginate(),

        ];
        return view('reports.pdfViews.awufulReferralBuyerReport', $data);

    }
}

<?php

namespace App\Exports;

use App\Vendor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AwufulVendorExport implements FromView
{
    public function view(): View
    {
        $data = [

            "vendors" => Vendor::
                when(!is_null(request()->fromDate) || !is_null(request()->toDate) || !is_null(request()->filterorderBy), function ($query) {

            }
                , function ($query) {
                    return $query->whereHas('referrals')
                        ->with(['referrals' => function ($query) {
                            $query
                                ->groupBy('referral_vendor', 'vendor_id')
                                ->selectRaw('id,sum(referral_reward) as earnedFromReferral,vendor_id');
                        }]);
                })

                ->paginate(),

        ];
        return view('reports.pdfViews.awufulReferralVendorReport', $data);

    }
}

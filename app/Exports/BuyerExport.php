<?php

namespace App\Exports;

use App\Buyer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BuyerExport implements FromView
{
    public function view(): View
    {
        $data = [
            "buyers" => (!is_null(request()->filter) || !is_null(request()->statusFilter)) ?

            Buyer::when(
                (
                    (!is_null(request()->filter) && is_null(request()->statusFilter) || (is_null(request()->filter) && !is_null(request()->statusFilter)))

                    && (request()->statusFilter == "0" || request()->statusFilter == "1" || request()->filter == "0" || request()->filter == "1" || request()->filter == "Active" || request()->filter == "Inactive")
                ), function ($query, $filter) {
                    $data = request()->filter;
                    if (request()->filter == "Active" || request()->filter == "1" || request()->statusFilter == "1") {
                        $data = 1;
                    } else {
                        $data = 0;
                    }

                    return $query->whereStatus($data);
                }, function ($query, $filter) use ($request) {
                    return $query
                        ->where(function ($query) {

                            if (!is_null(request()->statusFilter)) {
                                $data = 0;
                                if (request()->statusFilter == "1") {
                                    $data = 1;
                                }

                                return $query->whereStatus($data);
                            }

                            return;
                        })
                        ->where(function ($query) {
                            return $query->where("full_name", "like", "%" . request()->filter . "%")
                                ->orWhere('user_name', 'like', "%" . request()->filter . "%")
                                ->orWhere('email', request()->filter)
                                ->orWhere('phone', request()->filter);
                        });

                })
                ->paginate(20) :

            Buyer::where('id', '>=', 25)->whereStatus(1)->paginate(20),
        ];
        return view('reports.pdfViews.buyerReport', $data);
    }
}

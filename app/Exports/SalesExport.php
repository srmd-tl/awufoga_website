<?php

namespace App\Exports;

use App\UsedCoupon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromView, WithHeadings
{

    public function view(): View
    {
        $data = ["sales" => UsedCoupon::paginate()];
        return view('reports.pdfViews.salesReport', $data);
    }
   
}

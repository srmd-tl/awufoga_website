<?php

namespace App\Exports;

use App\Vendor;
use Maatwebsite\Excel\Concerns\FromCollection;

class AwufulVendorExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Vendor::all();
    }
}

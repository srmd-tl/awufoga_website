<?php

namespace App\Http\Controllers;

use App\Vendor;
use App\Exports\VendorExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
class VendorReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "vendors" => (!is_null(request()->filter) || !is_null(request()->statusFilter)) ?

            Vendor::when(
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

            Vendor::whereStatus(1)->paginate(20),
        ];
        if (request()->pdf) {
            $pdf = PDF::loadView('reports.pdfViews.vendorReport', $data);
            return $pdf->download('vendorReport_' . Carbon::now() . '.pdf');
        } elseif (request()->excel) {
            return Excel::download(new VendorExport, 'vendorReport_' . Carbon::now() . '.xlsx');
        }
        return view('reports.vendorReport', $data);
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

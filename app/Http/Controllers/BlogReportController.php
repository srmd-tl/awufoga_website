<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use App\Exports\BlogExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class BlogReportController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =
        $data       = [
            "blogs"      => (!is_null(request()->filter) || !is_null(request()->statusFilter)) ?

            Blog::when(
                (
                    (!is_null(request()->filter) && is_null(request()->statusFilter) || (is_null(request()->filter) && !is_null(request()->statusFilter)))

                    && (request()->statusFilter == "0" || request()->statusFilter == "1" || request()->filter == "0" || request()->filter == "1" || request()->filter == "Active" || request()->filter == "Inactive")
                ), function ($query, $filter) use ($keyType) {
                    $data = request()->filter;
                    if (request()->filter == "Active" || request()->filter == "1" || request()->statusFilter == "1") {
                        $data = 1;
                    } else {
                        $data = 0;
                    }

                    return $query->whereStatus($data);
                }, function ($query, $filter) use ($keyType) {
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
                        ->where(function ($query) use ($keyType) {
                            return $query->where("key_type_id", $keyType->id ?? null);
                        });

                })
                ->paginate(30) :

            Blog::paginate(30),
            'categories' => Category::all(),
        ];
        if (request()->pdf) {
            $pdf = PDF::loadView('reports.pdfViews.blogReport', $data);
            return $pdf->download('blogReport_' . Carbon::now() . '.pdf');
        } elseif (request()->excel) {
            return Excel::download(new BlogExport, 'blogReport_' . Carbon::now() . '.xlsx');
        }
        return view('reports.blogReport', $data);
    }
}

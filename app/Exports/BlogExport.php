<?php

namespace App\Exports;

use App\Blog;
use App\Category;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BlogExport implements FromView
{

    public function view(): View
    {
        $data = [
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
                ->paginate(20) :

            Blog::paginate(20),
            'categories' => Category::all(),
        ];
        return view('reports.pdfViews.blogReport', $data);
    }
}

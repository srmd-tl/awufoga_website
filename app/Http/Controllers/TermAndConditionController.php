<?php

namespace App\Http\Controllers;

use App\TermAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TermAndConditionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =
        $data       = [
            "termAndConditions" => (!is_null(request()->filter) || !is_null(request()->statusFilter)) ?

            TermAndCondition::when(
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
                }, function ($query, $filter) {
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
                            return $query->where("title", 'like', '%' . request()->filter . '%')
                                ->orWhere("description", 'like', '%' . request()->filter . '%');
                        });

                })
                ->paginate(20) :

            TermAndCondition::paginate(20),
        ];
        return view('termAndConditions.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        TermAndCondition::insert(
            [
                'title'       => $request->title,
                'description' => $request->description,
                'status'      => $request->status,
            ]);
        return redirect()->route('termAndCondition.index')->withSuccess("TermAndCondition Added!");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TermAndCondition  $termAdnCondtion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TermAndCondition $termAndCondition)
    {
        $data =
            [
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => $request->status,
        ];

        $termAndCondition->update($data);
        return redirect()->route('termAndCondition.index')->withSuccess("Term And Condition Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TermAndCondition  $termAdnCondtion
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermAndCondition $termAndCondition)
    {
        $termAndCondition->delete();
        return redirect()->route('termAndCondition.index')->withSuccess("TermAndCondition Deleted!");
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'status'      => ['required'],

        ]);
    }

}

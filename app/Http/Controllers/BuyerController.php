<?php

namespace App\Http\Controllers;

use App\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $favouriteCount=Coupon::where
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

            Buyer::whereStatus(1)->paginate(20),
        ];
      
        return view('buyers.index', $data);

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
        $this->validator($request->all())->validate();
        $path = $request->file('image')->store('buyer');

        Buyer::insert(
            [
                'full_name'           => $request->fullname,
                'password'            => bcrypt($request->password),
                'user_name'           => $request->username,
                'email'               => $request->email,
                'phone'               => $request->phone,
                'country_code'        => $request->country_code,
                'image'               => $path,
                'status'              => $request->status,
                'notification_on_off' => $request->notification,
            ]);
        return redirect()->route('buyer.index')->withSuccess("Buyer Added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function show(Buyer $buyer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function edit(Buyer $buyer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buyer $buyer)
    {
        $path = null;
        $data = [
            'full_name'           => $request->fullname,
            'user_name'           => $request->username,
            'email'               => $request->email,
            'phone'               => $request->phone,
            'country_code'        => $request->country_code,
            'status'              => $request->status,
            'notification_on_off' => $request->notification,
        ];
        if ($request->image) {
            $path          = $request->file('image')->store('buyer');
            $data["image"] = $path;
        }
        $buyer->update($data);
        return redirect()->route('buyer.index')->withSuccess("Buyer Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buyer $buyer)
    {
        $buyer->delete();
        return redirect()->route('buyer.index')->withSuccess("Buyer Deleted!");

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
            'username'     => ['required', 'string', 'max:255'],
            'fullname'     => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255'],
            'phone'        => ['required', 'string', 'max:255'],
            'country_code' => ['required', 'string', 'max:255'],
            'image'        => ['required', 'file'],
            'status'       => ['required', 'string'],
            'notification' => ['required', 'string'],
        ]);
    }
}

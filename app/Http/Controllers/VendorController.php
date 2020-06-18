<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        return view('vendors.index', $data);
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
        Vendor::insert(
            [
                'full_name'             => $request->fullname,
                'password'              => bcrypt($request->password),
                'user_name'             => $request->username,
                'email'                 => $request->email,
                'phone'                 => $request->phone,
                'country_code'          => $request->country_code,
                'image'                 => $path,
                'status'                => $request->status,
                'notification_on_off'   => $request->notification,

                'business_name'         => $request->businessName,
                'business_email'        => $request->businessEmail,
                'business_phone'        => $request->businessPhone,
                'business_country_code' => $request->businessCountryCode,
                'website'               => $request->website,
                'address'               => $request->address,
                'latitude'              => $request->latitude,
                'longitude'             => $request->longitude,
                'correct_address'       => $request->correctAddress,
                'rate'                  => $request->rate,
                'review_count'          => $request->reviewCount,
                'first_referral'        => $request->firstReferral,
            ]);
        return redirect()->route('vendor.index')->withSuccess("Vendor Added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        $vendor= Vendor::with(['usedCoupons'=>function($query){
            $query->selectRaw('count(*) as count,SUM(paid_price) as price_total,vendor_id');
        }])->whereId($vendor->id)->first();
        return view('ajax.vendorReference',["vendor"=>$vendor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }
       /**
     * Update the Status
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, Vendor $vendor)
    {
        $vendor->update(['status' => $request->status]);
        return redirect()->back()->withSuccess("Vendor Status Updated!");
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        $path = null;
        $data = [
            'full_name'             => $request->fullname,
            'password'              => bcrypt($request->password),
            'user_name'             => $request->username,
            'email'                 => $request->email,
            'phone'                 => $request->phone,
            'country_code'          => $request->country_code,
            'image'                 => $path,
            'status'                => $request->status,
            'notification_on_off'   => $request->notification,

            'business_name'         => $request->businessName,
            'business_email'        => $request->businessEmail,
            'business_phone'        => $request->businessPhone,
            'business_country_code' => $request->businessCountryCode,
            'website'               => $request->website,
            'address'               => $request->address,
            'latitude'              => $request->latitude,
            'longitude'             => $request->longitude,
            'correct_address'       => $request->correctAddress,
            'rate'                  => $request->rate,
            'review_count'          => $request->reviewCount,
            'first_referral'        => $request->firstReferral,
        ];
        if ($request->image) {
            $path          = $request->file('image')->store('vendor');
            $data["image"] = $path;
        }
        $vendor->update($data);
        return redirect()->route('vendor.index')->withSuccess("Vendor Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendor.index')->withSuccess("Vendor Deleted!");

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
            'username'            => ['required', 'string', 'max:255'],
            'fullname'            => ['required', 'string', 'max:255'],
            'email'               => ['required', 'email', 'max:255'],
            'phone'               => ['required', 'string', 'max:255'],
            'country_code'        => ['required', 'string', 'max:255'],

            'businessName'        => ['required', 'string', 'max:255'],
            'businessEmail'       => ['required', 'email', 'max:255'],
            'businessPhone'       => ['required', 'string', 'max:255'],
            'businessCountryCode' => ['required', 'string', 'max:255'],

            'website'             => ['required', 'string', 'max:255'],
            'address'             => ['required', 'string', 'max:255'],
            'longitude'           => ['required', 'string', 'max:255'],
            'latitude'            => ['required', 'string', 'max:255'],

            'correctAddress'     => ['required', 'string', 'max:255'],
            'rate'                => ['required', 'string', 'max:255'],
            'reviewCount'        => ['required', 'string', 'max:255'],
            'firstReferral'      => ['required', 'string', 'max:255'],

            'image'               => ['required', 'file'],
            'status'              => ['required', 'string'],
            'notification'        => ['required', 'string'],
        ]);
    }

}

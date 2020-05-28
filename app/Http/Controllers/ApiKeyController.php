<?php

namespace App\Http\Controllers;

use App\ApiKey;
use App\KeyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keyType=KeyType::whereTitle(request()->filter)->first();
        $data = [
            "apiKeys"  => (!is_null(request()->filter) || !is_null(request()->statusFilter)) ?

            ApiKey::when(
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
                        ->where(function ($query)  use ($keyType) {
                            return $query->where("key_type_id",  $keyType->id??null);
                        });

                })
                ->paginate(20) :

            ApiKey::whereStatus(1)->paginate(20),
            'keyTypes' => KeyType::all(),
        ];
        return view('apiKeys.index', $data);
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
       

        ApiKey::insert(
            [
                'key'         => $request->key,
                'value'       => $request->value,
                'description' => $request->description,
                'status'      => $request->status,
                'key_type_id' => $request->keyTypeId,

            ]);
        return redirect()->route('apiKey.index')->withSuccess("Api Key Added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ApiKey  $apiKey
     * @return \Illuminate\Http\Response
     */
    public function show(ApiKey $apiKey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ApiKey  $apiKey
     * @return \Illuminate\Http\Response
     */
    public function edit(ApiKey $apiKey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ApiKey  $apiKey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApiKey $apiKey)
    {
        $path = null;
        $data = [
            'key'         => $request->key,
            'value'       => $request->value,
            'description' => $request->description,
            'status'      => $request->status,
            'key_type_id' => $request->keyTypeId,
        ];

        $apiKey->update($data);
        return redirect()->route('apiKey.index')->withSuccess("Api Key Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ApiKey  $apiKey
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiKey $apiKey)
    {
        $apiKey->delete();
        return redirect()->route('apiKey.index')->withSuccess("Api Key Deleted!");
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
            'key'         => ['required', 'string', 'max:255'],
            'value'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'status'      => ['required', 'string', 'max:255'],
            'keyTypeId'   => ['required', 'string', 'max:255'],

        ]);
    }
}

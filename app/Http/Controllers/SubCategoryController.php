<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = null;
        if (!is_null(request()->filter)) {
            $category = Category::where("name","like","%".$request->filter."%")->first();
        }
        $data = [
            "subCategories" => !is_null(request()->filter) ?
            SubCategory::when(request()->filter == "0" || request()->filter == "1" || request()->filter == "Active" || request()->filter == "Inactive", function ($query, $filter) {
                $data = request()->filter;
                if (request()->filter == "Active" || request()->filter == "1") {
                    $data = 1;
                } else {
                    $data = 0;
                }

                return $query->whereStatus($data);
            }, function ($query, $filter) use ($request, $category) {
            	if($category->id??false)
            	{
            		return $query->where("name",'like',"%".$request->filter."%")
                    ->orWhere("category_id",$category->id);
            	}
              return $query->where("name",'like',"%".$request->filter."%");
            })
                ->paginate(20) :

            SubCategory::whereStatus(1)->paginate(20), "categories" => Category::all()];
        return view('subCategories.index', $data);
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
        $path = $request->file('image')->store('subCategory');

        SubCategory::insert(["name" => $request->name, "status" => $request->status, "image" => $path, "category_id" => $request->category]);
        return redirect()->route('subCategory.index')->withSuccess("Sub Category Added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $path = null;
        $data = ["name" => $request->name, "status" => $request->status, "category_id" => $request->category];
        if ($request->image) {
            $path          = $request->file('image')->store('subCategory');
            $data["image"] = $path;
        }
        $subCategory->update($data);
        return redirect()->route('subCategory.index')->withSuccess("Sub Category Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return redirect()->route('subCategory.index')->withSuccess("Sub Category Deleted!");
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
            'name'     => ['required', 'string', 'max:255'],
            'image'    => ['required', 'file'],
            'category' => ['required', 'integer'],
            'status'   => ['required', 'string'],
        ]);
    }
}

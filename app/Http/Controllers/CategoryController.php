<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(!is_null(request()->filter) ?
        //     Category::whereName(request()->filter)->orWhere('status', (int)request()->filter)->get() :
        //     Category::paginate(15));

        $data = [
            "categories" => !is_null(request()->filter) ?
            Category::whereName(request()->filter)->orWhere('status', (int)request()->filter)->paginate(15) :
            Category::paginate(5),
        ];
        return view('categories.index', $data);
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
        $path = $request->file('image')->store('category');

        Category::insert(["name" => $request->name, "status" => $request->status, "image" => $path]);
        return redirect()->route('category.index')->withSuccess("Sub Category Added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $path = null;
        $data = ["name" => $request->name, "status" => $request->status];
        if ($request->image) {
            $path          = $request->file('image')->store('category');
            $data["image"] = $path;
        }
        $category->update($data);
        return redirect()->route('category.index')->withSuccess("Category Updated!");
    }

/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Category  $category
 * @return \Illuminate\Http\Response
 */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->withSuccess("Category Deleted!");

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
            'name'   => ['required', 'string', 'max:255'],
            'image'  => ['required', 'file'],
            'status' => ['required', 'string'],
        ]);
    }
}

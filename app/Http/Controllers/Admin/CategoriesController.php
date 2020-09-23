<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Categories\CategoryRequest;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.list',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category;
        return view('admin.categories.form',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if(Category::create($request->validated())) {
            return redirect()->route('admin.categories.index')->with(['success' => ' تم اضافه التصنيف  بنجاح']);
        }
        return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجي اعاده المحاوله لاحقاً']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.form',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        if($category->update($request->validated())) {
            return redirect()->route('admin.categories.index')->with(['success' => ' تم تعديل التصنيف  بنجاح']);
        }
        return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجي اعاده المحاوله لاحقاً']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->delete()) {
            return redirect()->back()->with(['success' => ' تم حذف التصنيف بنجاح']);
        }
        return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجي اعاده المحاوله لاحقاً']);
    }


    public function list() {

        $categories =  Category::select(["id","category"])->get()->map(function($cat){
                return [
                    'id'       => $cat->id,
                    'category' => $cat->category,
                ];
        });
        return response()->json(['categories' => $categories], 200);
    }
}

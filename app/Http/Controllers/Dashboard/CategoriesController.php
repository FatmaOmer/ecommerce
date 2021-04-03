<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function index(){

      $categories=Category::with('_parent')->orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view ('dashboard.categories.index',compact('categories'));
    }
    public function edit($id)
    {
        $category =Category::orderBy('id','DESC')->find($id);
        if(!$category)
        {
            return redirect()->route('admin.maincategories')->with(['error'=>trans('categorynotfound')]);
        }
        $categories=Category::orderBy('id','DESC')->get();
        return view('dashboard.categories.edit',compact('category','categories'));
    }

        public function update($id, CategoryRequest $request){
        try {

            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }

            $category = Category::find($id);
            if (!$category)
                return redirect()->route('admin.maincategories')->with(['error' => trans('admin/categories.categorynotfound')]);

            $category->update($request->all());
            $category->name = $request->name;
            $category->save();
            return redirect()->route('admin.maincategories')->with(['success' => trans('admin/categories.categoryupdated')]);
        }catch (\Exception $ex)
        {
            return redirect()->route('admin.maincategories')->with(['success' => trans('admin/categories.categoryerror')]);
        }




    }
    public function destroy($id){
        try {
            $category = Category::find($id);
            if (!$category)
                return redirect()->route('admin.maincategories')->with(['error' => trans('admin/categories.categorynotfound')]);

            $category->delete();

            return redirect()->route('admin.maincategories')->with(['success' => trans('admin/categories.categorydeleted')]);
        }catch (\Exception $ex)
        {
            return redirect()->route('admin.maincategories')->with(['success' => trans('admin/categories.categoryerror')]);
        }

    }

    public function create()
    {
        $categories = Category::select('id','parent_id')->get();
        return view('dashboard.categories.create',compact('categories'));
    }
    public function store(CategoryRequest $request){

        try {
            DB::begintransaction();
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }
            if($request-> type == 1)
            {
                $request->request->add(['parent_id' => null]);

            }
            $category=Category::create($request->except('_token'));
            $category->name = $request->name;
            $category->save();
            return redirect()->route('admin.maincategories')->with(['success' => trans('admin/categories.categorycreated')]);
            DB::commit();

        }
        catch (\Exception $ex)
        {
            return redirect()->back()-> with (["error"=> trans('messages.error')]);
            DB::rollback();
        }
    }
}

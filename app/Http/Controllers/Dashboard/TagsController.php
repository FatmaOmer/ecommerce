<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\SubCategoryRequest;
use App\Http\Requests\TagRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Setting;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{
    public function index(){

      $tags=Tag::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view ('dashboard.tags.index',compact('tags'));
    }
    public function edit($id)
    {

        $tag =Tag::orderBy('id','DESC')->find($id);
        if(!$tag)
        {
            return redirect()->route('admin.tags')->with(['error'=>trans('tagnotfound')]);
        }
        return view('dashboard.tags.edit',compact('tag'));
    }

        public function update($id,TagRequest $request){
        try {
            $tag = Tag::find($id);
            if (!$tag)
                return redirect()->route('admin.tags')->with(['error' => trans('admin/tags.tagnotfound')]);
            DB::begintransaction();


            $tag ->update($request->all());
            $tag->name = $request->name;
            $tag->save();
            DB::commit();
            return redirect()->route('admin.tags')->with(['success' => trans('admin/tags.tagupdated')]);
        }catch (\Exception $ex)
        {
            return redirect()->route('admin.tags')->with(['success' => trans('admin/tags.tagerror')]);
            DB::rollback();
        }




    }
    public function destroy($id){
        try {
            $tag = Tag::find($id);
            if (!$tag)
                return redirect()->route('admin.tags')->with(['error' => trans('admin/tags.tagnotfound')]);

            $tag->delete();

            return redirect()->route('admin.tags')->with(['success' => trans('admin/tags.tagdeleted')]);
        }catch (\Exception $ex)
        {
            return redirect()->route('admin.tags')->with(['success' => trans('admin/tags.tagerror')]);
        }

    }

    public function create()
    {

        return view('dashboard.tags.create');
    }
    public function store(TagRequest $request){

        try {
            DB::begintransaction();
            $tag = Tag::create($request->all());
            $tag->name = $request->name;
            $tag->save();
            DB::commit();
            return redirect()->route('admin.tags')->with(['success' => trans('admin/tags.tagcreated')]);
        }catch (\Exception $ex)
        {
            return redirect()->route('admin.tags')->with(['success' => trans('admin/tags.tagerror')]);
        }




    }
}

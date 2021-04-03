<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
    public function index(){

      $brands=Brand::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view ('dashboard.brands.index',compact('brands'));
    }
    public function edit($id)
    {

        $brand =Brand::orderBy('id','DESC')->find($id);
        if(!$brand)
        {
            return redirect()->route('admin.brands')->with(['error'=>trans('brandnotfound')]);
        }
        return view('dashboard.brands.edit',compact('brand'));
    }

        public function update($id,BrandRequest $request){
        try {
            $brand = Brand::find($id);
            if (!$brand)
                return redirect()->route('admin.brands')->with(['error' => trans('admin/brands.brandnotfound')]);
            DB::begintransaction();
            $fileName=" ";
            if($request->has('photo'))
            {
                $fileName=uploadImage('brands',$request->photo);
                Brand::where('id',$id)->update(['photo'=>$fileName]);
            }
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }
            $brand ->update($request->except('_token','photo','id'));
            $brand->name = $request->name;
            $brand->save();
            DB::commit();
            return redirect()->route('admin.brands')->with(['success' => trans('admin/brands.brandupdated')]);
        }catch (\Exception $ex)
        {
            return redirect()->route('admin.brands')->with(['success' => trans('admin/brands.branderror')]);
            DB::rollback();
        }




    }
    public function destroy($id){
        try {
            $brand = Brand::find($id);
            if (!$brand)
                return redirect()->route('admin.brands')->with(['error' => trans('admin/brands.brandnotfound')]);

            $brand->delete();

            return redirect()->route('admin.brands')->with(['success' => trans('admin/brands.branddeleted')]);
        }catch (\Exception $ex)
        {
            return redirect()->route('admin.brands')->with(['success' => trans('admin/brands.branderror')]);
        }

    }

    public function create()
    {

        return view('dashboard.brands.create');
    }
    public function store(BrandRequest $request){
        try {

            DB::begintransaction();
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }
            $fileName = " ";
            if ($request->has('photo')) {
                $fileName = uploadImage('brands', $request->photo);
            }
            $brand = Brand::create($request->except('_token', 'photo'));
            $brand->name = $request->name;
            $brand->photo = $fileName;
            $brand->save();
            DB::commit();
            return redirect()->route('admin.brands')->with(['success' => trans('admin/brands.brandcreated')]);

        }
        catch (\Exception $ex)
                {
                    return redirect()->route('admin.brands')->with(['success' => trans('admin/brands.branderror')]);
                }


    }
}

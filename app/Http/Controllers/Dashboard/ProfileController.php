<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function editProfile()
    {
        $admin = Admin::find(auth('admin')->user()->id);

        return view ('dashboard.profile.edit',compact('admin'));
    }
    public function updateProfile(ProfileRequest $request)
    {

            $admin = Admin::find(auth('admin')->user()->id);

           if($request->filled('password'))
            {
                $request->merge(['password'=>bcrypt($request->password)]);
            }

            unset($request['id']);
            unset($request['password_confirmation']);

            $array=$request->except(['_token','password','confirmpass','_method']);
            if(isset($request['password'])&&!empty($request['password'])){
                $array['password']=bcrypt($request['password']);
            }

               $admin->update($array);
               $admin->save();

            return redirect()->back()-> with (["success"=> trans('messages.success')]);




    }



}

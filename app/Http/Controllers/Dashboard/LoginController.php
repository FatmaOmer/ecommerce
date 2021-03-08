<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
Use Hash;
use Illuminate\Auth\Events\Validated;


class LoginController extends Controller
{
    public function login()
    {
        return view('dashboard.auth.login');

    }
    public function loginpost(AdminLoginRequest $request )
    {
        $remember_me = $request->has('remember_me') ? true : false;


        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")])) {
            // notify()->success('تم الدخول بنجاح  ');
            return redirect() -> route('admin.dashboard');
        }
        // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->back()->with(['error' => trans("messages.error")]);


    }
    public function logout()
    {
     $guard=  $this->getGuard();
     $guard->logout();
     return redirect()->route('admin.logout');
    }

    private function getGuard()
    {
        return auth('admin');
    }

}

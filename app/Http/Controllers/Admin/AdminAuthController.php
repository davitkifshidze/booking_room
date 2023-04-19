<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLogin;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{

    public function __construct()
    {
        //Login Page can be viewd by anyone
        $this->middleware("guest:admin");
    }

    /**
     * Return Login form
     */
    public function show()
    {
        return view('admin.login');
    }

    public function login(AdminLogin $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->guard('admin')->attempt($credentials))
        {
            return redirect()->route('dashboard')->with('login_success',__('მოგესალმებით კიდევ ერთხელ!'));
        } else {
            return back()->withInput()->with('wrong_fields', __('არასწორი ინფორმაცია. სცადეთ თავიდან'));
        }
    }

    public function logout()
    {

        if(auth()->guard('admin')->check())
        {
            auth()->guard('admin')->logout();
            session()->invalidate();
            session()->regenerateToken();
            return redirect()->route('admin_login_show')->with('logout', __('თქვენ წარმატებით დატოვეთ სისტემა!'));
        }

    }

}

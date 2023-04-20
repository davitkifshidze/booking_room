<?php

namespace App\Http\Controllers\Site\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{

    public function __construct()
    {
        //Login Page can be viewd by anyone
        $this->middleware("guest:user");
    }

    /**
     * Return Login form
     */
    public function show()
    {
        return view('site.user.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('personal_number', 'password');

        if (auth()->guard('user')->attempt($credentials))
        {
            return redirect()->route('user_dashboard');
        } else {
            return back()->withInput()->with('wrong_fields', __('არასწორი ინფორმაცია. სცადეთ თავიდან'));
        }
    }

    public function logout()
    {

        if(auth()->guard('user')->check())
        {
            auth()->guard('user')->logout();
            session()->invalidate();
            session()->regenerateToken();
            return redirect()->route('admin_login_show')->with('logout', __('თქვენ წარმატებით დატოვეთ სისტემა!'));
        }

    }

}

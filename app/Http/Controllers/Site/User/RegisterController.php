<?php

namespace App\Http\Controllers\Site\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Return Registration form
     */
    public function show()
    {
        return view('site.user.registration');
    }

    /**
     * Register User
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'personal_number' => $request->personal_number,
            'password' => bcrypt($request->password),
        ]);

        if ($user):
            auth()->guard('user')->login($user);
            return redirect()->route('user_dashboard')->with('success', "მომხმარებელი წარმატებით დარეგისტრირდა");
        endif;

    }

}

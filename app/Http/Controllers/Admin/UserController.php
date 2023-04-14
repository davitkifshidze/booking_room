<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestUser;
use App\Models\Admin\Category;
use App\Models\Admin\CategoryTranslation;
use App\Models\Admin\User;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::select('users.id' , 'users.name', 'users.surname', 'users.personal_number', 'users.created_at', 'users.updated_at')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.user.index', compact('users'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestUser $request)
    {

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'personal_number' => $request->personal_number,
            'password' => $request->password,
        ]);

        return response()->json(['success' => 'create_success']);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $user_id = $id;

        $user = User::select('users.id' , 'users.name', 'users.surname', 'users.personal_number', 'users.created_at', 'users.updated_at')
            ->where('id', '=', $user_id)
            ->first();

        return response()->json($user);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestUser $request, string $id)
    {

        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'personal_number' => $request->personal_number,
            'password' => $request->password ?? $user->password,
        ]);

        return response()->json(['success' => 'true']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => true]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    public function profile()
    {
        return view('me.profile', [
            'user' => Auth::user()
        ]);
    }

    public function edit()
    {
        return view('me.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(UpdateUserProfile $request,User $user)
    {
        $user = Auth::user();
        $data = $request->validated();

        $user->name = $data['name'] ?? $user->name;
        $user->surname = $data['surname'] ?? $user->surname;
        $user->email = $data['email'] ?? $user->email;
        $user->pesel = $data['pesel'] ?? $user->pesel;
        $user->save();

        return redirect()
            ->route('me.profile')
            ->with('status', 'Profil został zaktualizowany');
    }

    public function delete()
    {
        $user = User::find(Auth::user()->id);

        Auth::logout();

        // if ($user->delete()) {

         return Redirect::route('/')->with('status', 'Your account has been deleted!');
        // }
    }


}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfile;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class MeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('me.profile', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('me.edit', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserProfile  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserProfile $request, User $user)
    {
        $user = Auth::user();
        $data = $request->validated();
        if (!empty($data['avatar'])) {

            $path = $data['avatar']->store('avatars', 'public');

            if ($path) {
                Storage::disk('public')->delete($user->avatar);
                $data['avatar'] = $path;
            }
        }

        $user->name = $data['name'] ?? $user->name;
        $user->surname = $data['surname'] ?? $user->surname;
        $user->email = $data['email'] ?? $user->email;
        $user->pesel = $data['pesel'] ?? $user->pesel;
        $user->avatar = $path ?? $user->path;
        $user->save();



        return redirect()
            ->route('me.index')
            ->with('status', 'Profil został zaktualizowany');
    }

    public function destroyAccountIndex()
    {

        return view('me.deleteAccount');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = User::find(Auth::user()->id);
        $user->role = 0;
        $user->save();

        Auth::logout();

        return Redirect::route('me.index')->with('status', 'Konto zostało zamknięte!');

    }

    public function changePasswordIndex()
    {

        return view('me.changePassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        Auth::logout();

         return Redirect::route('me.index')->with('status', 'Hasło zostało zmienione!');

    }
}

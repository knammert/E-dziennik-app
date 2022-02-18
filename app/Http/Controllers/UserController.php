<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserByAdminRequest;
use App\Http\Requests\UpdateUserProfile;
use App\Models\Class_name;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index(Request $request)
    {
       // $users = User::latest()->paginate(10);

        $classes = Class_name::all();

        $users   = User::usersByRoleOrName()
        ->paginate(10);



        return view('adminPanel.users.index', ['users' => $users, 'classes'=> $classes])
            ->with('i', (request()->input('page', 1) - 1) * 5);;
    }


    public function profile()
    {

    }

    public function edit()
    {

    }

    public function update(UpdateUserByAdminRequest $request, User $user)
    {

        $data = $request->validated();



        if($data['role']!=1 && $data['class_name_id']> 0){
            return redirect()
            ->route('users.index')
            ->with('status', 'Tylko uczeń może posiadać klasę!');
        }

        $user->role = $data['role'] ?? $user->role;
        $user->class_name_id = $data['class_name_id'] ?? $user->class_name_id;
        $user->save();

        return redirect()
            ->route('users.index')
            ->with('status', 'Użytkownik został zaktualizowany');
    }

    public function delete(Request $request)
    {
        $user = User::find(Auth::user()->id);


         return Redirect::route('/')->with('status', 'Konto zostało usunięte!');

    }




}

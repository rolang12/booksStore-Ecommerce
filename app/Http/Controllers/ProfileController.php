<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate(
            ['phone' => 'numeric|starts_with:3',
            'address' => 'string',
             'email' => 'indisposable|email'
        ]);

        $user = User::find(Auth()->user()->id);
        
        $user->update([
            'phone' => $request['phone'],
            'address' => $request['address'],
            'email' => $request['email'],
        ]);


        return redirect()->back()->with('status','Profile Updated');

    }

    public function updatePassword(Request $request)
    {

        if ($request->password != $request->confirm_password) {
            return redirect()->back()->withErrors('The passwords does not match');
        }
        
        if ($request->current_password != Auth()->user()->getAuthPassword()) {
            return redirect()->back()->withErrors('The current password is incorrect');
        }

        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required',
        ]);

        $user = User::find(Auth()->user()->id);

        $user->update([
            'password' => encrypt($request['password'],true)
        ]);

        return redirect()->back()->with('status','Profile Updated');
       

    }


}

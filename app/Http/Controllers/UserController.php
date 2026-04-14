<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //
    public function userForm()
    {
        return view('users.form');
    }

   public function register(Request $req)
    {
        $validated = $req->validate([
            'name' => 'required|string',
            'avatar' => 'nullable|image|max:2048',
            'username' => [
                'required',
                'min:6',
                'alpha_num',
                'regex:/[A-Za-z]/',
                'regex:/[0-9]/',
                'unique:users,username',
            ],
            'password' => 'required|min:6',
        ]);

        if ($req->hasFile('avatar')) {
            $imageName = time() . '.' . $req->file('avatar')->extension();
            $req->file('avatar')->move(public_path('avatars'), $imageName);
            $validated['avatar'] = $imageName;
        }

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        Auth::login($user);
        $req->session()->regenerate();

        return redirect('/')->with('success', 'Registration successful');
    }

    public function edit()
    {   
        $user = Auth::user();
        return view('users.edit',compact('user'));
    }

    
    public function update(Request $req)
    {
        $user = Auth::user();

        $validated = $req->validate([
            'name' => 'sometimes|nullable|string',
            'avatar' => 'sometimes|nullable|image|max:2048',
            'username' => [
                'sometimes',
                'nullable',
                'min:6',
                'alpha_num',
                'regex:/[A-Za-z]/',
                'regex:/[0-9]/',
                'unique:users,username,' . $user->id,
            ],
            'password' => 'sometimes|nullable|min:6',
        ]);

       

        if ($req->hasFile('avatar')) {
            $file = $req->file('avatar');
            $imageName = time() . '.' . $file->extension();
            $file->move(public_path('avatars'), $imageName);

            $validated['avatar'] = $imageName;
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

         $user->update(array_filter($validated));

        Auth::login($user);
        $req->session()->regenerate();

        return redirect('/')->with('success', 'Updated');
    }


    public function removeAvatar()
    {
        $user = Auth::user();

        $user->avatar = null;
        $user->save();

        return redirect()->back()->with('success', 'Avatar Successfully Removed!');
    }

    public function login(Request $req)
    {
        $creds = [
            'username' => $req->username,
            'password' => $req->password
        ];

        if(Auth::attempt($creds))
            {
                return redirect('/');
            }
        else
            {
                return redirect()->back()->withErrors(
                    ['error' => 'Invalid Input']
                );
            }
    }   

    public function logout(Request $req)
    {
        
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect('/');
    }
}

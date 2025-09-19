<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:users,email',
                'regex:/^[A-Za-z0-9._%+-]+@pkuwsb\.id$/i'
            ],
            'password' => [
                'required',
                'string',
                'min:7',
                'regex:/[0-9]/',   
                'regex:/[A-Z]/',   
                'regex:/[a-z]/'    
            ],
            'profile_photo' => ['nullable', File::image()->max(2048)], 
        ], [
            'email.regex' => 'Email harus berakhiran @pkuwsb.id',
        ]);

        $photoPath = null;
        if ($request->hasFile('profile_photo')) {
            $photoPath = $request->file('profile_photo')->store('profiles', 'public');
        }

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'profile_photo' => $photoPath, 
        ]);

        Auth::login($user);

        return redirect()->route('patients.index')->with('success', 'Registrasi berhasil. Selamat datang!');
    }

}

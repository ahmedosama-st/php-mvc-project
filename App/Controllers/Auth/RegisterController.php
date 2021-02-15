<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use SecTheater\Validation\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.signup');
    }

    public function store()
    {
        $validator = new Validator;
        $validator->setRules([
            'username' => ['required', 'alnum'],
            'email' => 'required|email'
        ]);
        $validator->make(request()->all());

        if ($validator->passes()) {
            User::create([
                'username' => request('username'),
                'name' => request('name'),
                'email' => request('email'),
                'password' => bcrypt(request('password'))
            ]);
        }
    }
}

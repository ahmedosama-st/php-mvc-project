<?php

namespace App\Controllers\Auth;

use SecTheater\Validation\Validator;
use App\Controllers\Controller;

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

        var_dump($validator->errors());
        if ($validator->passes()) {
        }
    }
}

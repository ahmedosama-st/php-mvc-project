<?php

namespace App\Controllers\Auth;

use Acme\Validation\Validator;
use App\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.signup');
    }

    public function store()
    {
        validator()->make(request()->all());
    }
}

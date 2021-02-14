<?php

namespace App\Controllers\Auth;

use Acme\Validation\Validator;
use App\Controllers\Controller;
use Acme\Validation\Rules\EmailRule;
use Acme\Validation\Rules\AlphaNumRule;
use Acme\Validation\Rules\RequiredRule;

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
            'username' => [new RequiredRule, new AlphaNumRule],
            'email' => [new RequiredRule, new EmailRule]
        ]);
        $validator->make(request()->all());

        var_dump($validator->errors());
        if ($validator->passes()) {
        }
    }
}

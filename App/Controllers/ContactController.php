<?php

namespace App\Controllers;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store()
    {
        var_dump($_POST);
    }
}

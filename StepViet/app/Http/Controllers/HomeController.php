<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function women()
    {
        return view('women'); 
    }

    public function men()
    {
        return view('men');
    }

    public function kids()
    {
        return view('kids');
    }

    public function sale()
    {
        return view('sale');
    }

    public function collection()
    {
        return view('collection');
    }
}


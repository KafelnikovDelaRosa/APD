<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function home()
    {
        // Return the "Home" view
        return view('main/home');
    }

    public function codequest()
    {
        // Return the "Home" view
        return view('main/codequest');
    }

    public function news()
    {
        // Return the "Home" view
        return view('main/news');
    }

    public function about()
    {
        // Return the "Home" view
        return view('main/about');
    }

    public function profile()
    {
        return view('main/profile');
    }

    //Code Quest routes

    public function mpcq()
    {
        // Return the "Home" view
        return view('main/codequest/mpcq');
    }

    public function fe()
    {
        // Return the "Home" view
        return view('main/codequest/fe');
    }

    public function be()
    {
        // Return the "Home" view
        return view('main/codequest/be');
    }
}

//Code Quest routes


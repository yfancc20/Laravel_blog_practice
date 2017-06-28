<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // index of blog
    public function index()
    {
        return view('main');
    }
}

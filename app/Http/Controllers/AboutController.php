<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AboutController extends Controller
{
    public function index()
    {
        
        return view("about", [
            "user" => Auth::user(),
        ]);
    }
}

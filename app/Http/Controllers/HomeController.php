<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index() {
        return view('welcome');
    }

    public function about() {
        // return '<h1>about page</h1>';
        return view('about');
    }

    public function contact() {
        // return '<h1>contact page</h1>';
        return view('contact');
    }
}

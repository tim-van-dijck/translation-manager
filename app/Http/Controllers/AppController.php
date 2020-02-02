<?php

namespace App\Http\Controllers;

use App\App;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        return view('vue.app');
    }
}

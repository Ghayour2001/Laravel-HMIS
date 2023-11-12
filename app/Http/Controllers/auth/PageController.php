<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('auth.bedsetup.index');
    }

    public function destination()
    {
        return view('auth.bedsetup.menu');
    }
}

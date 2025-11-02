<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $todaysDate = Carbon::today();
        return view('backend.pages.dashboard', compact('todaysDate'));
    }
}

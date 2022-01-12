<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourierSender;

class HomeController extends Controller
{
    
    
    public function index()
    {
        return view('home');
    }

    public function dash()
    {
        $recents = CourierSender::orderBy('id', 'desc')->limit(5)->get();
        return view('pages.dashboard',  ['recents' => $recents] );

    }

    public function clearCache()
    {
        \Artisan::call('cache:clear');
        return view('clear-cache');
    }
}

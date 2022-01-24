<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourierSender;
use Auth;

class HomeController extends Controller
{
    
    
    public function index()
    {

        return view('home');
    }

    public function dash()
    {
        if (Auth::check())
         {
        $recents = CourierSender::orderBy('id', 'desc')->limit(7)->get();
        return view('pages.dashboard',  ['recents' => $recents] );
    
        return redirect('/login');
    }

    }

    public function clearCache()
    {
        \Artisan::call('cache:clear');
        return view('clear-cache');
    }
}

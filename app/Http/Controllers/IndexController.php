<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class IndexController extends Controller
{
    
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('about');
    }

    public function results()
    {
        return view('results.index');
    }

    public function latest_winner()
    {
        return view('latest_winner.index');
    }

}

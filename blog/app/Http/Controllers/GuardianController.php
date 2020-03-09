<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuardianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('parent');
        $this->middleware(function ($request, $next){
            return $next($request);

        });
    }
    public function guardian(){
        return view('/Guardian.guardian');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){
        if(Auth::user()){

            if(Auth::user()->role =='superadmin'){
                return redirect()->route('home');
            }
            elseif (Auth::user()->role =='parent'){
                return redirect()->route('guardian');
            }

        }

        else{

            return redirect()->route('login');
        }
    }
}

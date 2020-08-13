<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\user;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_id = Auth::user()->role_id;
        if ($role_id == 3) {
            $companies = collect(Company::all());
            return view('home', compact('companies', 'role_id'));
        }
        $companies = collect(Auth::user()->companies);
        return view('home', compact('companies', 'role_id'));
    }
}

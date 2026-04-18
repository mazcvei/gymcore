<?php

namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $plans = MembershipPlan::all();

        return view('welcome', compact('plans'));
      
    }
}

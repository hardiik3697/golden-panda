<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{

    public function __construct()
    {
        // if (Gate::denies('access-admin')) {
        //     abort(403, 'Access Denied');
        // }
    }

    public function dashboard(Request $request)
    {
        return view("dashboard");
    }
}

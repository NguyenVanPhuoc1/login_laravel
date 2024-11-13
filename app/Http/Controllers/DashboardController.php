<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function viewChart(Request $request){
        return view('admin.trangchu');
    }
}

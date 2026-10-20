<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashbordControlle extends Controller
{
    public function index(){
        return view('admin.dashboarrd');
    }
}

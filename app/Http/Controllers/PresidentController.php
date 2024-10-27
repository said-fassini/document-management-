<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresidentController extends Controller
{
    public function index()
{
    return view('president.dashboard');
}

}

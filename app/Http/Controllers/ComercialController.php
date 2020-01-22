<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComercialController extends Controller
{
    public function index()
    {
        return view('comercial.index');
    }
}

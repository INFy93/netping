<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Netping;

class MainController extends Controller
{
   public function index()
   {
       $netpings = Netping::all();

        return view('home', compact('netpings'));
   }
}


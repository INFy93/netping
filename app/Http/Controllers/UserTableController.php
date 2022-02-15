<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserTableController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user_table.index');
    }

    public function addUser()
    {

    }
}

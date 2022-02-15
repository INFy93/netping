<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $email_info = User::where('id', Auth::user()->id)->select('order_email')->first();

        $status = $email_info->order_email;

        return view('user.profile', compact('status'));
    }

    public function updateUserInfo(Request $req)
    {
        $user = User::where('id', $req->user_id)->first();

        $user->name = $req->name;
        $user->email = $req->email;
        $user->order_email = $req->is_emailed;

        $user->save();

        return $user->toJson();
    }
}

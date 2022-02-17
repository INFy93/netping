<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\Netping;
use App\Models\User;
class LogController extends Controller
{
    public function index()
    {
        $logs = Log::join('actions', 'actions.id', '=', 'logs.action')
        ->join('netping', 'netping.id', '=', 'logs.netping_id')
        ->join('users', 'users.id', '=', 'logs.user_id')
        ->select('actions.*', 'netping.name as netping_name', 'users.login as user_login', 'logs.created_at as time')
        ->orderBy('logs.created_at', 'desc')
        ->get();


        foreach ($logs as $log)
        {
            switch($log->id)
            {
                case 1: $log->color = 'yellow'; break;
                case 2: $log->color = 'green'; break;
            }
        }

        $netping_list = Netping::select('name')->get();
        $user_list = User::select('login')->get();
        //dd($logs);
        return view('logs.index', compact('logs', 'netping_list', 'user_list'));
    }
}

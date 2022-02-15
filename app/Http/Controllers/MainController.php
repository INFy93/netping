<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Netping;
use App\Http\Requests\NetpingRequest;
use App\Http\Requests\UpdateNetpingRequest;

class MainController extends Controller
{
   public function index()
   {
       $netpings = Netping::all();

        return view('netping.netping', compact('netpings'));
   }

   public function netpingAddPage()
   {
        return view('netping.create');
   }

   public function netpingAddPoint(NetpingRequest $request)
    {
        $netping = new Netping();

        $netping->name = $request->input('netping_name');
        $netping->ip = $request->input('netping_ip');
        $netping->camera_ip = $request->input('camera_ip');
        $netping->power_state = env('NETPING_LOGIN') . $request->input('netping_ip') . env('POWER_STATE');
        $netping->door_state = env('NETPING_LOGIN') . $request->input('netping_ip') . env('DOOR_STATE');
        $netping->alarm_state = env('NETPING_LOGIN') . $request->input('netping_ip') . env('ALARM_STATE');
        $netping->alarm_control = env('NETPING_LOGIN') . $request->input('netping_ip') . env('ALARM_CONTROL');
        $netping->netping_state = env('NETPING_LOGIN') . $request->input('netping_ip') . env('NETPING_STATE');

        $netping->save();

        toastr()->success('Точка успешно добавлена!');

        return redirect()->route('home');
    }

    public function netpingEditPage($id)
   {
        $netping = Netping::find($id);
        return view('netping.update', compact('netping'));
   }

    public function netpingEditPoint(UpdateNetpingRequest $request, $id)
    {
        $netping = Netping::find($id);

        $netping->name = $request->input('netping_name');
        $netping->ip = $request->input('netping_ip');
        $netping->camera_ip = $request->input('camera_ip');
        $netping->door_state = env('NETPING_LOGIN') . $request->input('netping_ip') . env('DOOR_STATE');
        $netping->alarm_state = env('NETPING_LOGIN') . $request->input('netping_ip') . env('ALARM_STATE');

        $netping->save();

        toastr()->success('Точка успешно обновлена!');

        return redirect()->route('home');
    }
}


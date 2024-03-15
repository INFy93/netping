<?php

namespace App\Http\Controllers;

use App\Models\Bdcom;
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
        $bdcom = new Bdcom();

        if ($request->input('bdcom_name') !== null && $request->input('bdcom_ip') !== null)
        {
            $bdcom->bdcom_name = $request->input('bdcom_name');
            $bdcom->bdcom_ip = $request->input('bdcom_ip');

            $bdcom->save();
        }

        $netping->name = $request->input('netping_name');
        $netping->ip = $request->input('netping_ip');
        $netping->camera_ip = $request->input('camera_ip');
        $netping->revision = $request->input('revision');

        if ($request->input('revision') == 2)
        {
            $netping->power_state = env('NETPING_LOGIN') . $request->input('netping_ip') . env('POWER_STATE');
            $netping->door_state = env('NETPING_LOGIN') . $request->input('netping_ip') . env('DOOR_STATE');
            $netping->alarm_state = env('NETPING_LOGIN') . $request->input('netping_ip') . env('ALARM_STATE');
            $netping->alarm_control = env('NETPING_LOGIN') . $request->input('netping_ip') . env('ALARM_CONTROL');
            $netping->netping_state = env('NETPING_LOGIN') . $request->input('netping_ip') . env('NETPING_STATE');
            $netping->bdcom_id = $bdcom->id;
        }
        else if ($request->input('revision') == 4)
        {
            $netping->power_state = env('NETPING_LOGIN') . $request->input('netping_ip') . env('POWER_STATE_V4');
            $netping->door_state = env('NETPING_LOGIN') . $request->input('netping_ip') . env('DOOR_STATE_V4');
            $netping->alarm_state = env('NETPING_LOGIN') . $request->input('netping_ip') . env('ALARM_STATE_V4');
            $netping->alarm_control = env('NETPING_LOGIN') . $request->input('netping_ip') . env('ALARM_CONTROL_V4');
            $netping->netping_state = env('NETPING_LOGIN') . $request->input('netping_ip') . env('NETPING_STATE_V4');
            $netping->alarm_switch_v4 = env('NETPING_LOGIN') . $request->input('netping_ip') . env('ALARM_SWITCH_V4');
            $netping->bdcom_id = $bdcom->id;
        }


        $netping->save();



        toastr()->success('Точка успешно добавлена!');

        return redirect()->route('home');

       /* dd( $request );
        return $request->input('revision'); */
    }

    public function netpingEditPage($id)
   {
        $netping = Netping::with('bdcom')
        ->find($id);
        return view('netping.update', compact('netping'));
   }

    public function netpingEditPoint(UpdateNetpingRequest $request, $id)
    {
        $netping = Netping::find($id);
        $bdcom = Bdcom::find($netping->bdcom_id);

        if ($request->input('bdcom_name') !== null && $request->input('bdcom_ip') !== null)
        {
            if ($bdcom) //если уже есть бдком - обновляем его
            {
                $bdcom->bdcom_name = $request->input('bdcom_name');
                $bdcom->bdcom_ip = $request->input('bdcom_ip');

                $bdcom->save();
            }
            else //иначе - создаем новую запись в таблице bdcoms
            {
                $bdcom = new Bdcom();

                $bdcom->bdcom_name = $request->input('bdcom_name');
                $bdcom->bdcom_ip = $request->input('bdcom_ip');

                $bdcom->save();
            }

        }

        $netping->name = $request->input('netping_name');
        $netping->ip = $request->input('netping_ip');
        $netping->camera_ip = $request->input('camera_ip');
        $netping->door_state = env('NETPING_LOGIN') . $request->input('netping_ip') . env('DOOR_STATE');
        $netping->alarm_state = env('NETPING_LOGIN') . $request->input('netping_ip') . env('ALARM_STATE');
        $netping->bdcom_id = $bdcom->id;

        $netping->save();

        toastr()->success('Точка успешно обновлена!');

        return redirect()->route('home');
    }
}


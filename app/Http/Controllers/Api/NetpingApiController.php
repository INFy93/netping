<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Netping;
use App\Models\User;
use App\Models\Log;
use Illuminate\Support\Facades\Http;
use App\Jobs\QueueSenderEmail;
use Illuminate\Support\Facades\Auth;

class NetpingApiController extends Controller
{
    /*
    *  методы для ajax-запросов
    */
    public function get_power_data($netping_id)
    {
        $netping = Netping::find($netping_id);

        $current_power_state = \NetpingApi::get_power_state($netping->power_state);

        return $current_power_state;
    }

    public function get_door_data($netping_id)
    {
        $netping = Netping::find($netping_id);

        $current_door_state = \NetpingApi::get_door_state($netping->door_state);

        return $current_door_state;
    }

    public function get_alarm_data($netping_id)
    {
        $netping = Netping::find($netping_id);

        $current_alarm_state = \NetpingApi::get_alarm_state($netping->alarm_state);

        return $current_alarm_state;
    }
    public function get_netping_data($netping_id)
    {
        $netping = Netping::find($netping_id);

        $current_alarm_state = \NetpingApi::get_netping_state($netping->netping_state);

        return $current_alarm_state;
    }
    public function set_alarm($netping_id)
    {
        $netping = Netping::find($netping_id);
        $log = new Log();
        $users = User::get();
        $current_state = \NetpingApi::get_netping_state($netping->netping_state);
        switch ($current_state) {
            case 3:
                return 'Ошибка связи с точкой!';
                break;
            case 'direction:2': //точка на охране - снимаем охрану
                try {
                    $raw_state = HTTP::timeout(env('NETPING_TIMEOUT'))->get($netping->alarm_control . '1');
                } catch (ConnectionException $exp) {
                    return 3;
                }
                $state = explode("'", $raw_state);
                //dd($state);
                if ($state[1] == 'ok') {
                    $log->user_id = Auth::id();
                    $log->netping_id = $netping_id;
                    $log->action = 1;
                    $log->save();
                    foreach ($users as $user) {
                        if ($user->order_email == 1) {
                            dispatch(new QueueSenderEmail($user->email, Auth::user()->name, $netping->name, 'Снята с охраны', date('H:i:s'), date('Y-m-d')));
                        }
                    }
                    return 'Снята с охраны';
                } else if ($state[1] == 'error') {
                    return 'Ошибка запроса';
                }
                break;
            case 'direction:1': //точка не на охране - ставим на охрану
                try {
                    $raw_state = HTTP::timeout(env('NETPING_TIMEOUT'))->get($netping->alarm_control . '2');
                } catch (ConnectionException $exp) {
                    return 3;
                }
                $state = explode("'", $raw_state);
                if ($state[1] == 'ok') {
                    $log->user_id = Auth::id();
                    $log->netping_id = $netping_id;
                    $log->action = 2;
                    $log->save();
                    foreach ($users as $user) {
                        if ($user->order_email == 1) {
                            dispatch(new QueueSenderEmail($user->email, Auth::user()->name, $netping->name, 'Поставлена на охрану', date('H:i:s'), date('Y-m-d')));
                        }
                    }
                    return 'Поставлена на охрану';
                } else if ($state[1] == 'error') {
                    return 'Ошибка запроса';
                }
                break;
        }
    }
}

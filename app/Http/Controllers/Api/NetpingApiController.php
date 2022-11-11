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

        $revision = $netping->revision;
        $current_alarm_state = \NetpingApi::get_alarm_state($netping->alarm_state);

        return [
            'revision' => $revision,
            'alarm_state' => $current_alarm_state
        ];
    }
    public function get_netping_data($netping_id)
    {
        $netping = Netping::find($netping_id);

        $revision = $netping->revision;
        $current_alarm_state = \NetpingApi::get_netping_state($netping->netping_state, $revision);

        return [
            'revision' => $revision,
            'secure_state' => $current_alarm_state
        ];
    }
    public function set_alarm($netping_id)
    {
        $netping = Netping::find($netping_id);
        $current_state = \NetpingApi::get_netping_state($netping->netping_state, $netping->revision);
        if ($netping->revision == 4) {
            return $this->set_alarm_v4($netping_id, $current_state);
        } else {
            $log = new Log();
            $users = User::get();
            switch ($current_state) {
                case 3:
                    $status = 3;
                    break;
                case 'direction:2': //точка на охране - снимаем охрану
                    try {
                        $raw_state = HTTP::timeout(env('NETPING_TIMEOUT'))->get($netping->alarm_control . '1');
                    } catch (ConnectionException $exp) {
                        $status = 3;
                    }
                    $state = explode("'", $raw_state);
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
                        $status = 0;
                    } else if ($state[1] == 'error') {
                        $status = 2;
                    }
                    break;
                case 'direction:1': //точка не на охране - ставим на охрану
                    $door_state = $this->get_door_data($netping_id);
                    if ($door_state == 1) {
                        $status = 4;
                        break;
                    } else {
                        try {
                            $raw_state = HTTP::timeout(env('NETPING_TIMEOUT'))->get($netping->alarm_control . '2');
                        } catch (ConnectionException $exp) {
                            $status = 3;
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
                            $status = 1;
                        } else if ($state[1] == 'error') {
                            $status = 2;
                        }
                        break;
                    }
            }
        }
        return $status;
    }

    public function set_alarm_v4($netping_id, $current_state)
    {
        if ($current_state == 3) {
            $status = 3;
        }

        $netping_v4 = Netping::find($netping_id);

        $log = new Log();
        $users = User::get();


        switch ($current_state[0]) {
            case '1': //точка на охране, снимаем охрану
                try {
                    $raw_state =  HTTP::timeout(env('NETPING_TIMEOUT'))->get($netping_v4->alarm_control . '0');
                } catch (ConnectionException $exp) {
                    $status = 3;
                }

                try {
                    $turn_off_the_alarm = HTTP::timeout(env('NETPING_TIMEOUT'))->get($netping_v4->alarm_switch_v4 . '0');
                } catch (ConnectionException $exp) {
                    $status = 3;
                }

                $answer = explode("'", $turn_off_the_alarm);

                if ($answer[1] == 'ok') {
                    $log->user_id = Auth::id();
                    $log->netping_id = $netping_id;
                    $log->action = 1;
                    $log->save();
                    foreach ($users as $user) {
                        if ($user->order_email == 1) {
                            dispatch(new QueueSenderEmail($user->email, Auth::user()->name, $netping_v4->name, 'Снята с охраны', date('H:i:s'), date('Y-m-d')));
                        }
                    }
                    $status = 0;
                } else if ($answer[1] == 'error') {
                    $status = 2;
                }
                break;
            case '0': //точка снята с охраны, исправляем это недоразумение
                $door_state = $this->get_door_data($netping_id);
                if ($door_state == 1) {
                    $status = 4;
                    break;
                } else {
                    try {
                        $raw_state =  HTTP::timeout(env('NETPING_TIMEOUT'))->get($netping_v4->alarm_control . '1');
                    } catch (ConnectionException $exp) {
                        return 3;
                    }

                    try {
                        $restart_logic =  HTTP::timeout(env('NETPING_TIMEOUT'))->get($netping_v4->alarm_control . '2');
                    } catch (ConnectionException $exp) {
                        return 3;
                    }
                    if ($raw_state && $restart_logic) {
                        $log->user_id = Auth::id();
                        $log->netping_id = $netping_id;
                        $log->action = 2;
                        $log->save();
                        foreach ($users as $user) {
                            if ($user->order_email == 1) {
                                dispatch(new QueueSenderEmail($user->email, Auth::user()->name, $netping_v4->name, 'Поставлена на охрану', date('H:i:s'), date('Y-m-d')));
                            }
                        }
                        $status = 1;
                    } else {
                        $status = 2;
                    }
                    break;
                }
        }
        return $status;
    }
}

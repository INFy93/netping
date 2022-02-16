<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Hash;
class UserTableController extends Controller
{
    public function index()
    {
        $users = User::all();
        foreach ($users as $u)
        {
            $u->role_color = $u->is_admin == 1 ? 'green' : 'blue';
            $u->role = $u->is_admin == 1 ? 'Администратор' : 'Пользователь';

            $u->mail_color = $u->order_email == 1 ? 'green' : 'red';
            $u->mail_text = $u->order_email == 1 ? 'Да' : 'Нет';
        }

        return view('user_table.index', compact('users'));
    }

    public function addUser()
    {
        return view('user_table.create');
    }

    public function addUserToDB(UsersRequest $request)
    {
        $user = new User();

        $user->name = $request->input('user_name');
        $user->login = $request->input('user_login');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('user_pass'));
        $user->is_admin = isset($request->user_is_admin) ? 1 : 0;

        $user->save();

        toastr()->success('Пользователь успешно добавлен!');

        return redirect()->route('users');
    }

    public function changeNotify($id)
    {
        $user = User::find($id);

        if ($user->order_email == 1)
        {
            $user->order_email = 0;
            $user->save();

            $toastr_message = 'Уведомления по email отключены.';
            $span_text = 'Нет';
            $tooltip_text = 'Включить уведомления';
            $old_class = 'bg-green-400';
            $class = 'bg-red-400';
        } else
        {
            $user->order_email = 1;
            $user->save();

            $toastr_message = 'Уведомления по email включены.';
            $span_text = 'Да';
            $tooltip_text = 'Отключить уведомления';
            $old_class = 'bg-red-400';
            $class = 'bg-green-400';
        }

        return response()->json([
            'message' => $toastr_message,
            'text' => $span_text,
            'tooltip_text' => $tooltip_text,
            'old_class' => $old_class,
            'class' => $class
        ]);
    }
}

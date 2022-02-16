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
}

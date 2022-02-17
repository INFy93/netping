<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Action;

class ActionController extends Controller
{
    public function index()
    {
        $actions = Action::all();

        return view('actions.index', compact('actions'));
    }

    public function addActionPage()
    {
        return view('actions.create');
    }

    public function addAction(Request $request)
    {
        $action = new Action();

        $action->name = $request->input('action_name');

        $action->save();

        toastr()->success('Действие успешно добавлено!');

        return redirect()->route('actions');
    }
}

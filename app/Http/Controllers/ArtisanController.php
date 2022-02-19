<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    public function index()
    {
        return view('artisan.index');
    }

    public function clearCaches()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');

        return response()->json('Кеши успешно очищены');
    }
    public function createSimlink()
    {
        Artisan::call('storage:link');

        return response()->json(Artisan::output());
    }
}

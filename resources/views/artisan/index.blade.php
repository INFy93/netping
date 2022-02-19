@extends('layouts.app')
@section('title')Artisan @endsection

@section('heading')NetPing - artisan @endsection

@section('content')


<div class="block mb-8">
    <a href="#" data-tooltip-target="artisan-tooltip" data-tooltip-placement="right" class="clear-caches bg-green-500 hover:bg-green-700 text-white dark:bg-gray-700 dark:hover:bg-gray-600 font-bold py-2 px-4 rounded">Очистить кеши</a>
</div>
<div id="artisan-tooltip" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
    Выполняемые команды:
    <br>
    <p>php artisan route:clear</p>
    <p>php artisan config:clear</p>
    <p>php artisan cache:clear</p>
    <p>php artisan view:clear</p>
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>

<div class="block mb-8">
    <a href="#" data-tooltip-target="simlink-tooltip" data-tooltip-placement="right" class="simlink bg-green-500 hover:bg-green-700 text-white dark:bg-gray-700 dark:hover:bg-gray-600 font-bold py-2 px-4 rounded">Создать симлинк</a>
</div>
<div id="simlink-tooltip" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
    php artisan storage:link
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
@endsection

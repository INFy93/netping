@extends('layouts.app')
@section('title')Логи @endsection

@section('heading')NetPing - логи@endsection

@section('content')
<div class="px-4 py-2 sm:p-6 mb-2">

    <a href="#" class="filter-switch bg-green-500 hover:bg-green-700 dark:bg-gray-700 dark:hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Показать
        фильтры</a>
</div>


<div class="grid grid-cols-3 gap-2 bg-white dark:bg-gray-500 dark:text-gray-100 filters" style="display: none;">

    <div>
        <div class="px-4 py-5  sm:p-6">
            Точки:
            <select class="w-full border bg-white rounded px-3 py-2 outline-none dark:bg-gray-600 dark:text-gray-100" id="netping_sort">
                <option value=""></option>
                @foreach ($netping_list as $n_list)
                <option>{{ $n_list->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <div class="px-4 py-5  sm:p-6">
            Юзеры:
            <select class="w-full border bg-white rounded px-3 py-2 outline-none dark:bg-gray-600 dark:text-gray-100" id="user_sort">
                <option value=""></option>
                @foreach ($user_list as $u_list)
                <option>{{ $u_list->login }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <div class="px-4 py-5 bg-white dark:bg-gray-500 dark:text-gray-100 sm:p-6">
            <label for="dates" class="block text-gray-700 dark:text-gray-100">Даты:</label>
            <input type="text" name="dates" id="dates" class="form-input rounded-md shadow-sm mt-1 block w-full dark:bg-gray-600 dark:text-gray-100" />
        </div>
    </div>
</div>

<table class="border-collapse w-full bg-white" id="log_table">
    <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 dark:bg-gray-700 dark:text-gray-400 border border-gray-300 hidden lg:table-cell">
                Дата</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 dark:bg-gray-700 dark:text-gray-400 border border-gray-300 hidden lg:table-cell">
                Пользователь</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 dark:bg-gray-700 dark:text-gray-400 border border-gray-300 hidden lg:table-cell">
                Действие
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 dark:bg-gray-700 dark:text-gray-400 border border-gray-300 hidden lg:table-cell">
                Точка
            </th>
        </tr>
    </thead>
    <tbody class="bg-white  divide-y divide-gray-200 dark:bg-gray-500 dark:divide-gray-600">
        @foreach ($logs as $log)
        <tr class="log_row">
            <td
                class="w-full lg:w-auto dark:bg-gray-500 dark:text-gray-100 p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ date('Y-m-d H:i:s', strtotime($log->time)) }}
            </td>
            <td
                class="w-full lg:w-auto p-3 dark:bg-gray-500 dark:text-gray-100 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <b>{{ $log->user_login }}</b>
            </td>
            <td
                class="bg-{{ $log->color }}-400 dark:bg-{{ $log->color }}-600 w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                {{ $log->name }}

            </td>
            <td
                class="w-full lg:w-auto p-3 text-gray-800 dark:bg-gray-500 dark:text-gray-100 text-center border border-b block lg:table-cell relative lg:static">
                {{ $log->netping_name }}

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

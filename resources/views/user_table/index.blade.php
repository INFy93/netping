@extends('layouts.app')
@section('title')Пользователи @endsection

@section('heading')NetPing - пользователи@endsection

@section('content')
<div class="block mb-8">
    <a href="{{ route('add_user') }}"
        class="bg-green-500 hover:bg-green-700 text-white dark:bg-gray-700 dark:hover:bg-gray-600 font-bold py-2 px-4 rounded">Добавить
        пользователя</a>
</div>
<div class="flex flex-col">
    <div class="test"></div>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div
                class="shadow overflow-hidden border-b border-gray-200 dark:border-gray-400 dark:bg-gray-700 sm:rounded-lg">
                <table class="border-collapse w-full" id="main_table">
                    <thead>
                        <tr>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Имя</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Логин</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Email</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Emailed?</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Добавлен</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Последний вход</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-500 dark:divide-gray-600">

                    </tbody>
                </table>
                @endsection

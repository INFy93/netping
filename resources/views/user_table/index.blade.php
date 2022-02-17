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
                                Роль</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Email</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Уведомлять?</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Добавлен</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Последний вход</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-500 dark:divide-gray-600">
                        @foreach ($users as $user)
                        <tr>
                            <td class="w-full lg:w-auto p-3 text-gray-800 dark:text-gray-100 text-left border border-b block lg:table-cell relative lg:static">
                                    <span class="lg:hidden flex absolute top-0 left-0 bg-blue-200 dark:bg-gray-700 px-2 py-1 text-xs font-bold uppercase">Имя</span>
                                    @if (Auth::id() != $user->id)
                                    <a href="#" class="text-blue-600 dark:text-blue-200 hover:text-blue-200 dark:hover:text-blue-300 underline">
                                        {{ $user->name }}
                                    </a>
                                    @else
                                    <strong>{{ $user->name }}</strong>
                                    @endif
                            </td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 dark:text-gray-100 text-center border border-b block lg:table-cell relative lg:static">
                                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 dark:bg-gray-700 px-2 py-1 text-xs font-bold uppercase">Логин</span>
                                {{ $user->login }}
                            </td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 dark:text-gray-100 text-center border border-b block lg:table-cell relative lg:static">
                                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 dark:bg-gray-700 px-2 py-1 text-xs font-bold uppercase">Уведомлять?</span>
                                <span class="rounded bg-{{ $user->role_color }}-400 py-1 px-3 text-xs font-bold">{{ $user->role }}</span>
                            </td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 dark:text-gray-100 text-left border border-b block lg:table-cell relative lg:static">
                                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 dark:bg-gray-700 px-2 py-1 text-xs font-bold uppercase">Email</span>
                                {{ $user->email }}
                            </td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 dark:text-gray-100 text-center border border-b block lg:table-cell relative lg:static">
                                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 dark:bg-gray-700 px-2 py-1 text-xs font-bold uppercase">Уведомлять?</span>
                                <span data-tooltip-target="tooltip-{{ $user->id }}" data-tooltip-placement="bottom" user-id="{{ $user->id }}" class="email_span rounded bg-{{ $user->mail_color }}-400 py-1 px-3 text-xs font-bold">{{ $user->mail_text }}</span>
                                <div id="tooltip-{{ $user->id }}" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                                    <div id="emailed_text-{{ $user->id }}">{{$user->order_email == 1 ? 'Отключить уведомления' : 'Включить уведомления'}}</div>
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 dark:text-gray-100 text-left border border-b block lg:table-cell relative lg:static">
                                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 dark:bg-gray-700 px-2 py-1 text-xs font-bold uppercase">Добавлен</span>
                                {{ date('Y-m-d H:i:s', strtotime($user->created_at)) }}
                            </td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 dark:text-gray-100 text-left border border-b block lg:table-cell relative lg:static">
                                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 dark:bg-gray-700 px-2 py-1 text-xs font-bold uppercase">Добавлен</span>
                                {{ $user->last_login == NULL ? 'Никогда' : date('Y-m-d H:i:s', strtotime($user->last_login)) }} <strong>{{ $user->last_login_ip == NULL? '' : '('.$user->last_login_ip.')' }}</strong>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endsection

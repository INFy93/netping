@extends('layouts.app')
@section('title')Netping @endsection

@section('heading')NetPing (обновление раз в 20 сек)@endsection

@section('content')

<div class="block mb-8">
    <a href="{{ route('netping_add_page') }}" class="bg-green-500 hover:bg-green-700 text-white dark:bg-gray-700 dark:hover:bg-gray-600 font-bold py-2 px-4 rounded">Добавить точку</a>
</div>

<div class="flex flex-col">
    <div class="test"></div>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 dark:border-gray-500 sm:rounded-lg">
                <table class="border-collapse w-full" id="main_table">
                    <thead>
                        <tr>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Имя точки</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Питание</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Охрана</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Дверь</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Сирена</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                IP точки</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Действия</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Камера</th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($netpings as $netping)
                        <tr>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-left border border-b block lg:table-cell relative lg:static">
                                {{ $netping->name }}

                                <a href="/netping/{{ $netping->id }}/edit">
                                    <svg style="float:right; display:inline-block; width: 10%;"
                                        xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </a>
                            </td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static power_state"
                                data="{{ $netping->id }}">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Питание</span>

                            </td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static netping_state"
                                data="{{ $netping->id }}" id="{{ $netping->id }}">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Охрана</span>

                            </td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static door_state"
                                data="{{ $netping->id }}">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Дверь</span>
                            </td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static alarm_state"
                                data="{{ $netping->id }}">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Сирена</span>
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-left border border-b block lg:table-cell relative lg:static">
                                <a href="http://{{ $netping->ip }}"
                                    class="text-blue-600 hover:text-blue-800 underline" target="_blank">{{
                                    $netping->ip }}</a>
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 border border-b text-left block lg:table-cell relative lg:static">
                                <a href="#"
                                    class="netping_action text-blue-600 hover:text-blue-800 underline"
                                    data-id="{{ $netping->id }}" id="act_link{{$netping->id}}"></a>
                            </td>
                            @php
                            header("Content-Type: image/jpeg");
                            @endphp
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 border border-b text-left block lg:table-cell relative lg:static">
                                @if ($netping->camera_ip)
                                <a href="#cam_popup" id="cam_link" rel="modal:open"
                                    cam_id="{{ $netping->id }}"><svg
                                        style="margin-left:auto; margin-right:auto; display:block;"
                                        xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endsection

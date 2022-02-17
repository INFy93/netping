@extends('layouts.app')
@section('title')Действия @endsection

@section('heading')NetPing - действия@endsection

@section('content')
<div class="block mb-8">
    <a href="{{ route('add_action') }}"
        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Добавить
        действие</a>
</div>
<table class="border-collapse" id="main_table">
    <thead>
        <tr>
            <th
                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                ID</th>
            <th
                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                Действие</th>
                <th
                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($actions as $action)
        <tr>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span
                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">ID</span>
                    {{ $action->id }}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span
                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Действие</span>
                   {{ $action->name }}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span
                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase"></span>
                    <a href="#"
                        class="text-blue-600 hover:text-blue-800 underline">Редактировать действие</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

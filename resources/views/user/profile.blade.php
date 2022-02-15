@extends('layouts.app')
@section('title')Профиль @endsection

@section('heading')Профиль@endsection

@section('content')
<div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-semibold text-gray-900">Персональные данные</h3>
            <p class="mt-1 text-sm text-gray-600">Обновить имя, выбрать получение статуса точек на почту...</p>
        </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form id="update_info">
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-4">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Имя
                        </label>
                        <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" id="name" type="text" autocomplete="name" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <label class="block font-medium text-sm text-gray-700" for="email">
                            Email
                        </label>
                        <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" id="email" type="email" value="{{ Auth::user()->email }}">
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="order_email" name="order_email" value="ok" {{ $status == 1 ? 'checked':''}}><span class="px-2">Получать уведомления на почту</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                <div class="info_field text-sm text-gray-600 mr-3">

                </div>
                <button type="submit" id="save" data-user-id={{ Auth::user()->id }} class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

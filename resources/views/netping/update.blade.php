@extends('layouts.app')
@section('title')Обновить точку @endsection

@section('heading')NetPing - обновить точку@endsection

@section('content')
<div class="mt-5 md:m-0 md:m-auto md:w-2/4 justify-center">
    <form method="post" action="{{ route('netping_edit_point', $netping->id) }}">
        @csrf
        <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white dark:bg-gray-600 sm:p-6">
                <label for="netping_name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Имя точки</label>
                <input type="text" name="netping_name" id="netping_name" class="dark:bg-gray-500 dark:text-gray-100 form-input rounded-md shadow-sm mt-1 block w-full"
                       value="{{ $netping->name }}" />
                @error('netping_name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-600">
                <label for="netping_ip" class="block font-medium text-sm text-gray-700 dark:text-gray-300">IP точки</label>
                <input type="text" name="netping_ip" id="netping_ip" class="dark:bg-gray-500 dark:text-gray-100 form-input rounded-md shadow-sm mt-1 block w-full"
                       value="{{ $netping->ip }}" />
                @error('description')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-600">
                <label for="camera_ip" class="block font-medium text-sm text-gray-700 dark:text-gray-300">IP камеры (необязательно)</label>
                <input type="text" name="camera_ip" id="camera_ip" class="dark:bg-gray-500 dark:text-gray-100 form-input rounded-md shadow-sm mt-1 block w-full"
                       value="{{ $netping->camera_ip }}" />
                @error('description')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-600 text-right sm:px-6">
                <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                   Обновить
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

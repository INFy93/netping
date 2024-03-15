@extends('layouts.app')
@section('title')Добавить точку @endsection

@section('heading')NetPing - добавить точку@endsection

@section('content')
<div class="mt-5 md:m-0 md:m-auto md:w-2/4 justify-center">
    <form method="post" action="{{ route('netping_add_point') }}">
        @csrf
        <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white dark:bg-gray-600 sm:p-6">
                <label for="netping_name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Имя точки</label>
                <input type="text" name="netping_name" id="netping_name" class="dark:bg-gray-500 dark:text-gray-100 form-input rounded-md shadow-sm mt-1 block w-full"
                       value="{{ old('netping_name', '') }}" />
                @error('netping_name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-600">
                <label for="netping_ip" class="block font-medium text-sm text-gray-700 dark:text-gray-300">IP точки</label>
                <input type="text" name="netping_ip" id="netping_ip" class="dark:bg-gray-500 dark:text-gray-100 form-input rounded-md shadow-sm mt-1 block w-full"
                       value="{{ old('netping_ip', '') }}" />
                @error('netping_ip')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-600">
                <label for="camera_ip" class="block font-medium text-sm text-gray-700 dark:text-gray-300">IP камеры (необязательно)</label>
                <input type="text" name="camera_ip" id="camera_ip" class="dark:bg-gray-500 dark:text-gray-100 form-input rounded-md shadow-sm mt-1 block w-full"
                       value="{{ old('camera_ip', '') }}" />
                @error('camera_ip')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-600">
                <label for="bdcom_name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">BDCOM</label>
                <input type="text" name="bdcom_name" id="bdcom_name" class="dark:bg-gray-500 dark:text-gray-100 form-input rounded-md shadow-sm mt-1 block w-full"
                       value="{{ old('bdcom_name', '') }}" />
                @error('camera_ip')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-600">
                <label for="bdcom_ip" class="block font-medium text-sm text-gray-700 dark:text-gray-300">BDCOM IP</label>
                <input type="text" name="bdcom_ip" id="bdcom_ip" class="dark:bg-gray-500 dark:text-gray-100 form-input rounded-md shadow-sm mt-1 block w-full"
                       value="{{ old('bdcom_ip', '') }}" />
                @error('bdcom_ip')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-600">
                <label for="netping_ip" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Ревизия точки</label>
                <input id="revision" type="radio" value="2" name="revision" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked>
                <label for="revision" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">v.2</label>
                <input id="revision" type="radio" value="4" name="revision" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="revision" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">v.4</label>
            </div>
            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-600 text-right sm:px-6">
                <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                   Добавить
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

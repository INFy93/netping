@extends('layouts.app')
@section('title')Добавить пользователя @endsection

@section('heading')NetPing - добавить пользователя@endsection

@section('content')
<div class="mt-5 md:m-0 md:m-auto md:w-2/4 justify-center">
    <form method="post" action="{{ route('store_user') }}">
        @csrf
        <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white dark:bg-gray-600 sm:p-6">
                <label for="user_name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Имя</label>
                <input type="text" name="user_name" id="user_name" class="dark:bg-gray-500 dark:text-gray-100 form-input rounded-md shadow-sm mt-1 block w-full"
                       value="{{ old('user_name', '') }}" />
                @error('user_name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-600">
                <label for="user_login" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Логин</label>
                <input type="text" name="user_login" id="user_login" class="dark:bg-gray-500 dark:text-gray-100 form-input rounded-md shadow-sm mt-1 block w-full"
                       value="{{ old('user_login', '') }}" />
                @error('description')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-600">
                <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" id="email" class="dark:bg-gray-500 dark:text-gray-100 form-input rounded-md shadow-sm mt-1 block w-full"
                       value="{{ old('user_email', '') }}" />
                @error('description')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-600">
                <label for="user_pass" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Пароль</label>
                <input type="password" name="user_pass" id="user_pass" class="dark:bg-gray-500 dark:text-gray-100 form-input rounded-md shadow-sm mt-1 block w-full"
                       value="{{ old('user_pass', '') }}" />
                @error('description')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="px-4 py-2 bg-white sm:p-6 border-t dark:border-gray-500 dark:bg-gray-600">
                <input type="checkbox" class="rounded focus:outline-none focus:ring dark:ring-offset-gray-600 dark:focus:ring-gray-500 border-gray-300 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400" id="order_email" name="user_is_admin"><span class="px-2 dark:text-gray-100">Администратор</span>
            </div>
            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-500 text-right sm:px-6">
                <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                   Добавить
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

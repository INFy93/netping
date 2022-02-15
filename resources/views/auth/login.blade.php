@extends('layouts.enter-forms')

@section('content')
@section('title')Вход@endsection
@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="px-8 py-6 mt-4 text-left bg-white shadow-lg">
        <div class="flex justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
              </svg>
        </div>
        <h3 class="text-2xl font-bold text-center">NetPing - вход</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mt-4">
                <div>
                    <label class="block" for="login">Логин<label>
                            <input type="text" id="login" name="login" placeholder="Логин"
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                @error('login')
                            <span class="text-xs tracking-wide text-red-600">Логин обязателен </span>
                            @enderror
                </div>
                <div class="mt-4">
                    <label class="block">Пароль<label>
                            <input type="password" id="password" name="password" placeholder="Пароль"
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                @error('password')
                                <span class="text-xs tracking-wide text-red-600">Пароль обязателен </span>
                                @enderror
                </div>
                <div class="flex items-baseline justify-between">
                    <button class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">Войти</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

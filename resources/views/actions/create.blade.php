@extends('layouts.app')
@section('title')Добавить действие @endsection

@section('heading')NetPing - добавить действие@endsection

@section('content')
<div class="mt-5 md:m-0 md:m-auto md:w-2/4 justify-center">
    <form method="post" action="{{ route('store_action') }}">
        @csrf
        <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white dark:bg-gray-600 sm:p-6">
                <label for="action_name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Действие</label>
                <input type="text" name="action_name" id="action_name" class="dark:bg-gray-500 dark:text-gray-100 form-input rounded-md shadow-sm mt-1 block w-full"
                       />
                @error('action_name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-500 text-right sm:px-6">
                <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                   Добавить действие
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

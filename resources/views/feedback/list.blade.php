<?php
/** @var \App\Models\Feedback $feedback */
?>

<x-app-layout>
    <x-slot name="header">
        <h2>

            @if( (Auth::user()->role) == 'manager' )
                {{ __('Запросы обратной связи') }}
            @else
                {{ __('Обратная связь') }}
            @endif

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="table-fixed w-full bg-gray-50">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <thead>
                            <tr>
                                <th class="w-16 px-6 py-2 text-xs text-gray-500">id</th>
                                <th class="w-4/6 px-6 py-2 text-xs text-gray-500">Тема</th>
                                <th class="px-6 py-2 text-xs text-gray-500">Сообщение</th>
                                <th class="px-6 py-2 text-xs text-gray-500">Имя клиента</th>
                                <th class="px-6 py-2 text-xs text-gray-500">Почта клиента</th>
                                <th class="px-6 py-2 text-xs text-gray-500">Ссылка на файл</th>
                                <th class="px-6 py-2 text-xs text-gray-500">Создан</th>
                                <th class="px-6 py-2 text-xs text-gray-500">Ответ</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($feedback as $fb)
                                <tr class="whitespace-nowrap">
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $fb->id }}</td>
                                    <td class="px-6 py-4">{{ $fb->title }}</td>
                                    <td class="px-6 py-4">{{ $fb->description }}</td>
                                    <td class="px-6 py-4">{{ $fb->user->name }}</td>
                                    <td class="px-6 py-4">{{ $fb->user->email }}</td>
                                    <td class="px-6 py-4">
                                        @if($fb->file)
                                            <a href="{{ asset('storage/' . $fb->file) }}">Скачать файл</a>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">{{ $fb->created_at }}</td>
                                    <td>
                                        <form action="{{ route('feedback.update', $fb->id) }}" method="POST" enctype="multipart/form-data" class="w-full">
                                            @csrf

                                            @if($fb->reply_at)
                                                {{ $fb->reply_at }}
                                            @else
                                                <input type="submit" style="color:black;border:1px solid #000" value="Ответил" {{ ($fb->reply_at) ? 'hidden' : '' }}>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

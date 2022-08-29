<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

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

                    <form action="{{ route('feedback.store') }}" method="POST" enctype="multipart/form-data" class="w-full">
                        @csrf

                        @if($lastFeedbackCheck == 'false')
                            <div class="alert alert-error">
                                Следующий запрос Вы можете отправить после {{ $lastFeedback->addDays(1) }}
                            </div>
                        @endif

                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                        @error('title')
                            <div class="text-red-600">Укажите тему обращения!</div>
                        @enderror

                        <div class="flex items-center border-b border-gray-400 border-teal-500 mb-4 py-2">
                            <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Тема обращения" aria-label="Тема обращения..." name="title" value="{{ old('title') }}" {{ ($lastFeedbackCheck == 'false') ? 'disabled' : '' }}>
                        </div>

                        <textarea name="description" id="ckeditor" rows="10" cols="80" {{ ($lastFeedbackCheck == 'false') ? 'disabled' : '' }}>{{ old('description') }}</textarea>

                        @error('description')
                            <div class="text-red-600">Опишите Вашу проблему</div>
                        @enderror

                        <div class="md:flex md:items-center mt-6">
                            <div class="md:w-1/3">
                                <input type="file" name="file" {{ ($lastFeedbackCheck == 'false') ? 'disabled' : '' }}>
                            </div>
                        </div>

                        <input type="submit" style="color:black;border:1px solid #000" value="Отправить" {{ ($lastFeedbackCheck == 'false') ? 'disabled' : '' }}>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@extends('layouts.basic')
@section('content')
    {{-- Show success message --}}
    @if (session('message'))
        <div id="toast-success" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
             class="fixed bottom-2 right-4 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 z-10"
             role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ml-3 text-sm font-normal">{{ session('message') }}</div>
            <button type="button"
                    class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    @endif
    {{-- List all the provided articles --}}
    @foreach($articles as $article)
        <div class="flex justify-center flex-col md:flex-row gap-10 md:gap-5 pt-10 px-10">
            <div
                class="overflow-hidden shadow-lg transition duration-500 ease-in-out hover:shadow-2xl rounded-lg md:w-80 dark:bg-gray-800">
                <a href="{{ route('article.show',$article) }}">
                    <img alt="blog photo"
                         src="{{ asset($article['thumbnail']) }}"
                         class="max-h-40 w-full object-cover"/>
                </a>
                <div class="w-full p-4">
                    <a href="{{ route('article.show',$article) }}"
                       class="dark:text-white text-2xl font-medium">{{ $article['title'] }}</a>
                    <p class="text-gray-300 font-light text-md mt-1">{{$article['content']}}...<a
                            class="inline-flex text-green-600" href="#">Read More</a>
                    </p>
                    <div
                        class="flex flex-wrap justify-starts items-center py-3 text-xs text-white font-medium">
                        <a href="#" class="m-1 px-2 py-1 rounded bg-green-500">#online </a>
                        <a href="#" class="m-1 px-2 py-1 rounded bg-green-500">#internet </a>
                        <a href="#" class="m-1 px-2 py-1 rounded bg-green-500">#education </a>
                    </div>
                </div>
            </div>
    @endforeach
@endsection

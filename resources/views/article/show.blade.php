@extends('layouts.basic')
@section('content')
    <div class="max-w-screen-lg mx-auto">
        <main class="mt-10">

            <div class="mb-4 md:mb-0 w-full mx-auto relative">
                <div class="px-4 lg:px-0">
                    <h2 class="text-4xl font-semibold text-gray-800 dark:text-white leading-tight">
                        {{ $article['title'] }}
                    </h2>
                    <a href="#" class="py-2 text-green-600 inline-flex items-center justify-center mb-2">Cryptocurrency
                    </a>
                </div>
                <img
                    src="https://images.unsplash.com/photo-1587614387466-0a72ca909e16?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2100&q=80"
                    class="w-full object-cover lg:rounded" style="height: 28em;"/>
            </div>
            <div class="flex mt-4">
                <a href="{{ route('article.edit',$article) }}"
                   class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-md text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none dark:focus:ring-gray-800">
                    <svg fill="none" class="w-4 h-auto inline-block mb-1 mx-2" stroke="currentColor" stroke-width="1.5"
                         viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                    </svg>
                    Edit Article
                </a>
                <form action="{{ route('article.destroy',$article) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit"
                            class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
            <div class="flex flex-col lg:flex-row lg:space-x-12">
                <div
                    class="px-4 lg:px-0 mt-12 text-gray-700 dark:text-gray-200 text-lg leading-relaxed w-full lg:w-3/4">
                    <p class="pb-6">
                        {{ $article['content'] }}
                    </p>
                </div>
            </div>
        </main>
    </div>
@endsection

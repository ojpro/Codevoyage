@extends('layouts.blank')
@section('content')
    {{-- Page Title --}}
    @section('title', 'Create New Article')

    <a href="{{ $previous_page }}"
       class="dark:text-blue-100 font-bold dark:hover:text-blue-400 hover:text-blue-500 m-2 block">
        <svg fill="none" class="w-4 h-auto inline-block mb-1 mx-2" stroke="currentColor" stroke-width="1.5"
             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"></path>
        </svg>
        Go Back
    </a>
    <!-- Main modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true"
         class="overflow-y-auto overflow-x-hidden flex justify-center items-center w-full md:h-full md:mt-36">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div
                    class="pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Add Article
                    </h3>
                </div>
                <!-- Modal body -->
                <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="">
                        <div>
                            <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" name="title" id="brand"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Article's Title" value="{{ old('title') }}" required="">
                            @error('title') <span
                                class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span> @enderror
                        </div>


                        <div class="my-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   for="thumbnail">Add thumbnail</label>
                            <input name="thumbnail"
                                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                   id="thumbnail" type="file" required>
                            @error('thumbnail') <span
                                class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span> @enderror
                        </div>


                        <div class="my-4">
                            <label for="description"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content</label>
                            <textarea id="description" rows="4" name="content"
                                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                      placeholder="Write article content here">{{ old('content') }}</textarea>
                            @error('content') <span
                                class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Publish
                        <svg fill="none" class="w-5 h-auto mx-2" stroke="currentColor" stroke-width="1.5"
                             viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

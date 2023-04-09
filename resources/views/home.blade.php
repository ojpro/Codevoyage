@extends('layouts.basic')
@section('content')
    <div class="flex justify-center flex-col md:flex-row gap-10 md:gap-5 pt-10 px-10">
        <div
            class="overflow-hidden shadow-lg transition duration-500 ease-in-out hover:shadow-2xl rounded-lg md:w-80 dark:bg-gray-800">
            <a href="#">
                <img alt="blog photo"
                     src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80"
                     class="max-h-40 w-full object-cover"/>
            </a>
            <div class="w-full p-4">
                <a href="#" class="dark:text-white text-2xl font-medium">Should You Get Online Education?</a>
                <p class="text-gray-300 font-light text-md mt-1"> It is difficult to believe that we have become so used
                    to
                    having instant access to information at...
                    <a class="inline-flex text-green-600" href="#">Read More</a>
                </p>
                <div
                    class="flex flex-wrap justify-starts items-center py-3 text-xs text-white font-medium">
                    <a href="#" class="m-1 px-2 py-1 rounded bg-green-500">#online </a>
                    <a href="#" class="m-1 px-2 py-1 rounded bg-green-500">#internet </a>
                    <a href="#" class="m-1 px-2 py-1 rounded bg-green-500">#education </a>
                </div>
            </div>
        </div>
@endsection

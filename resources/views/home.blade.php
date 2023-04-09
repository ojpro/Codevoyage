@extends('layouts.basic')
@section('content')
    @foreach($articles as $article)
        <div class="flex justify-center flex-col md:flex-row gap-10 md:gap-5 pt-10 px-10">
            <div
                class="overflow-hidden shadow-lg transition duration-500 ease-in-out hover:shadow-2xl rounded-lg md:w-80 dark:bg-gray-800">
                <a href="{{ route('article.show',$article) }}">
                    <img alt="blog photo"
                         src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80"
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

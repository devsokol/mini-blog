<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="GET" action="{{ route('posts.index') }}">
                        <div class="flex flex-wrap items-center mb-3">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2 mr-2">Author:</label>
                            <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-auto py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2" placeholder="Enter author name" value="{{ request()->query('name') }}">

                            <label for="created_at" class="block text-gray-700 text-sm font-bold mb-2 mr-2">Created At:</label>
                            <input type="date" name="created_at" id="created_at" class="shadow appearance-none border rounded w-auto py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2" value="{{ request()->query('created_at') }}">

                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Filter</button>

                            <a href="{{ route('posts.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">Clear Filter</a>
                        </div>
                    </form>

                    @foreach($posts as $post)
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                            <p class="text-gray-600">{{ $post->body }}</p>
                            <div class="mt-2">
                                <p class="text-gray-500">Created by: {{ $post->user->name }}</p>
                                <p class="text-gray-500">Created at: {{ $post->created_at->format('Y-m-d H:i:s') }}</p>
                                <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500">View</a>
                                <a href="{{ route('posts.edit', $post->id) }}" class="ml-2 text-blue-500">Edit</a>
                                <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    <div class="my-4">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

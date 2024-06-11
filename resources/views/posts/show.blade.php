<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                    <p class="text-gray-600">{{ $post->body }}</p>
                    <p class="text-gray-600">Created at: {{ $post->created_at->format('Y-m-d H:i:s') }}</p>
                    <p class="text-gray-600">Updated at: {{ $post->updated_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">Comments</h3>
                    <ul class="list-disc list-inside">
                        @foreach($post->comments as $comment)
                            <li>
                                <p>{{ $comment->body }}</p>
                                <p class="text-gray-500">Created by: {{ $comment->user->name }}</p>
                                <p class="text-gray-500">Created at: {{ $comment->created_at->format('Y-m-d H:i:s') }}</p>
                            </li>
                        @endforeach
                    </ul>
                    <form method="POST" action="{{ route('posts.comments.store', $post->id) }}">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                                Add Comment
                            </label>
                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="body" placeholder="Enter your comment" name="body"></textarea>
                        </div>
                        <div class="flex items-center justify-between">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                Add Comment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

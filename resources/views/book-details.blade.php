<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Book Details Section -->
                    <div class="flex flex-col md:flex-row items-start mb-8">
                        <!-- Book Image -->
                        <div class="w-full md:w-1/3">
                            <img 
                                src="/images/book.jpeg" 
                                alt="Book Cover" 
                                class="rounded shadow-md w-full"
                            >
                        </div>

                        <!-- Book Details -->
                        <div class="w-full md:w-2/3 md:pl-6 mt-4 md:mt-0">
                            <h1 class="text-2xl font-bold mb-2">{{ $book->title }}</h1>
                            <p class="text-lg text-gray-600 dark:text-gray-400 mb-2">by {{ $book->author }}</p>
                            <p class="text-gray-800 dark:text-gray-300 mb-4">{{ $book->description }}</p>
                            <p class="text-sm text-gray-500 mb-2">Published on: {{ $book->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    <!-- Ratings Section -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold mb-4">Ratings</h2>

                        @if ($book->ratings->isEmpty())
                            <p class="text-gray-500">No ratings yet. Be the first to rate this book!</p>
                        @else
                            @foreach ($book->ratings as $rating)
                                <div class="mb-4">
                                    <p class="font-semibold">{{ $rating->user->name }} rated:</p>
                                    <p class="text-yellow-500">
                                        @for ($i = 0; $i < $rating->rating; $i++)
                                            ★
                                        @endfor
                                    </p>
                                    <p class="text-sm text-gray-500">{{ $rating->created_at->diffForHumans() }}</p>
                                </div>
                            @endforeach
                        @endif

                        <!-- Add a Rating -->
                        <!-- Add a Rating -->
<form action="{{ route('ratings.store') }}" method="POST" class="mt-6">
    @csrf
    <input type="hidden" name="book_id" value="{{ $book->id }}">

    <label for="stars" class="block mb-2">Rate this book:</label>
    <div class="flex items-center space-x-2">
        @for ($i = 1; $i <= 5; $i++)
            <label class="cursor-pointer">
                <input 
                    type="radio" 
                    name="stars" 
                    value="{{ $i }}" 
                    class="hidden peer" 
                />
                <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke-width="1.5" 
                    stroke="currentColor" 
                    class="w-8 h-8 text-gray-300 peer-checked:text-yellow-500 hover:text-yellow-400 transition">
                    <path 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        d="M11.48 3.499a.998.998 0 011.04 0l2.47 1.458 2.41-1.276c.577-.308 1.3.126 1.3.753v4.008l2.35 2.36c.44.44.148 1.182-.44 1.238l-4.372.48-1.392 4.005c-.245.707-1.152.707-1.398 0l-1.392-4.005-4.372-.48c-.588-.056-.88-.797-.44-1.238l2.35-2.36V4.434c0-.627.723-1.061 1.3-.753l2.41 1.276 2.47-1.458z" 
                    />
                </svg>
            </label>
        @endfor
    </div>

    <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">
        Submit Rating
    </button>
</form>

                    </div>

                    <!-- Comments Section -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold mb-4">Comments</h2>

                        @if ($book->comments->isEmpty())
                            <p class="text-gray-500">No comments yet. Be the first to comment on this book!</p>
                        @else
                            @foreach ($book->comments as $comment)
                                <div class="mb-4">
                                    <p class="font-semibold">{{ $comment->user->name }} says:</p>
                                    <p class="mt-2">{{ $comment->comment }}</p>
                                    <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            @endforeach
                        @endif

                        <!-- Add a Comment -->
                        <form action="{{ route('comments.store') }}" method="POST" class="mt-6">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <label for="comment" class="block mb-2">Leave a comment:</label>
                            <textarea name="body" id="comment" rows="4" class="block w-full p-2 rounded border-gray-300"></textarea>
                            <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">
                                Submit Comment
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

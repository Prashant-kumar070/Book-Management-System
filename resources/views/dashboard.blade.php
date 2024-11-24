<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>

                <div class="p-6">
                    <form method="GET" action="{{ route('dashboard') }}" class="flex items-center">
                        <input type="text" name="search" value="{{ request()->search }}" placeholder="Search by title or author" class="px-4 py-2 rounded-lg border border-gray-300 w-full sm:w-1/2" />
                        <button type="submit" class="ml-4 bg-blue-500 text-white px-4 py-2 rounded-lg">Search</button>
                    </form>
                </div>
                
                <!-- Books Ticket Style -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
                    @foreach ($books as $book)
                        <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white dark:bg-gray-800">
                            <!-- Dummy Image -->
                            <img class="w-full h-48 object-cover" src="images/book.jpeg" alt="Book Image">
                            
                            <div class="px-6 py-4">
                                <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200">{{ $book->title }}</h2>
                                <p class="text-sm text-gray-600 dark:text-gray-400">by {{ $book->author }}</p>
                                <p class="text-base text-gray-700 dark:text-gray-300 mt-2">{{ $book->description }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Created on: {{ $book->created_at->format('d M Y') }}</p>
                            </div>

                            <div class="px-6 py-4">
                                <!-- You can add actions like a button for more details or view comments -->
                                <a href="{{ route('book.details', $book->id) }}" class="text-blue-500 hover:text-blue-700">View Details</a>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-4">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chat and Discussion') }}
        </h2>
    </x-slot>
@vite(['resources/css/app.css', 'resources/js/chat.js'])
{{-- <body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-4xl bg-white shadow-md rounded-lg flex h-[500px]"> --}}
        <body class="bg-gray-100 flex items-center justify-center h-screen">
            <div class="w-full max-w-4xl bg-white shadow-md rounded-lg flex h-[500px] mx-auto  mt-12">
          
        <!-- Left Sidebar: Users List -->
        <div class="w-1/3 bg-gray-200 p-4 overflow-y-auto">
            <h2 class="text-lg font-semibold mb-3">Users</h2>
            <ul>
                @foreach($users as $user)
                    <li class="p-2 flex items-center cursor-pointer hover:bg-gray-300 rounded-md"
                        onclick="selectUser({{ $user->id }}, '{{ $user->name }}')">
                        <img src="storage/{{ $user->profile_picture ?? '/default-avatar.png' }}" class="w-8 h-8 rounded-full mr-2">
                        <span>{{ $user->name }}</span>
                        <span id="new-msg-{{ $user->id }}" class="text-red-500 text-sm hidden ml-2">New</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Right Side: Chatbox -->
        <div class="w-2/3 flex flex-col">
            <!-- Chat Header -->
            <div id="chat-header" class="p-4 bg-blue-500 text-white text-lg font-semibold">
                Select a user to chat
            </div>

            <!-- Messages Container -->
            <div id="messages" class="flex-1 overflow-y-auto border p-4 bg-gray-50 flex flex-col space-y-2"></div>

            <!-- Message Input -->
            <div class="p-2 border-t flex">
                <input type="text" id="messageInput" class="flex-1 border p-2 rounded-l focus:outline-none" placeholder="Type a message...">
                <button id="sendMessage" class="bg-blue-500 text-white px-4 py-2 rounded-r">Send</button>
            </div>
        </div>
    </div>
    {{-- <button id="checkStatusButton">Check Online Status</button>
    <p id="statusMessage">User is offline</p> <!-- This will show the status --> --}}
    
    <script>
        const CURRENT_USER_ID = {{ auth()->id() }};
        const CURRENT_USER_PROFILE_PICTURE = "{{ auth()->user()->profile_picture }}";
    </script>
</body>
{{-- </html> --}}
</x-app-layout>

import * as Ably from 'ably';

// Initialize Ably
window.Ably = new Ably.Realtime({ key: 'V7o31w.07nOFw:ZNQp5CvPisYmMX6e3lati0F5OAc1bBV15RRmShduSHI' });
const userId = CURRENT_USER_ID;
let selectedUserId = null;  // Track selected user
// Function to select a user to chat with
window.selectUser = (id, name) => {
    selectedUserId = id;
    document.getElementById('chat-header').innerText = `${name}`;
    document.getElementById('messages').innerHTML = ''; // Clear messages

    // Fetch old messages from the server
    fetch(`/fetch-messages/${id}`)
        .then(response => response.json())
        .then(data => {
            data.forEach(message => {
                updateChatUI(message, 'private');
            });
        })
        .catch(error => console.error('Error fetching messages:', error));

    // Hide "New" indicator when opening chat
    const newMsgIndicator = document.getElementById(`new-msg-${id}`);
    if (newMsgIndicator) {
        newMsgIndicator.classList.add('hidden');
    }
};

// Subscribe to the private channel for messages
const privateChannel = window.Ably.channels.get(`private-chat-${userId}`);
privateChannel.subscribe('message.sent', (message) => {
    console.log('🔒 Private Message Received:', message.data);

    if (message.data.sender_id === selectedUserId) {
        updateChatUI(message.data, 'private');
    } else {
        const newMsgIndicator = document.getElementById(`new-msg-${message.data.sender_id}`);
        if (newMsgIndicator) {
            newMsgIndicator.classList.remove('hidden');
        }
    }
});
// Function to send a message
document.getElementById('sendMessage').addEventListener('click', () => {
    const input = document.getElementById('messageInput');
    const message = input.value.trim();
    const  profile_picture= CURRENT_USER_PROFILE_PICTURE;
       
    if (!message || !selectedUserId) return;

    const chatType = selectedUserId === 'public' ? 'public' : 'private';

    const messageData = {
        message: message,
        receiver_id: selectedUserId === 'public' ? null : selectedUserId,
        chat_type: chatType,
        profile_picture: CURRENT_USER_PROFILE_PICTURE,

    };

    fetch('/send-message', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify(messageData),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateChatUI({ sender_id: userId, message: message, timestamp: new Date(), sender_name: 'You' , profile_picture: profile_picture }, chatType);
            input.value = '';
        } else {
            console.error('Error sending message:', data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});

// Function to update chat UI
function updateChatUI(message, type) {
    const messagesContainer = document.getElementById('messages');
    if (!messagesContainer) return;

    const isUserMessage = message.sender_id === userId;
    const messageElement = document.createElement('div');
    messageElement.classList.add('p-2', 'mb-2', 'rounded-lg', 'max-w-xs', 'break-words');

    if (isUserMessage) {
        messageElement.classList.add('bg-blue-500', 'text-white', 'self-end');
    } else {
        messageElement.classList.add('bg-white', 'text-gray-800', 'self-start');
    }

    // Display sender name for old messages
    // messageElement.innerHTML = `<strong>${isUserMessage ? 'You' : message.sender_name}:</strong> ${message.message}`;
    // messageElement.innerHTML = `<strong>${isUserMessage ? 'You' : message.sender_name}:</strong> ${message.message}`;
    messageElement.innerHTML = `
    <img src="/storage/${message.profile_picture}" alt="${message.sender_name}" class="w-6 h-6 inline-block rounded-full">
    ${message.message}
`;

    const messageWrapper = document.createElement('div');
    messageWrapper.classList.add('flex', isUserMessage ? 'justify-end' : 'justify-start');
    messageWrapper.appendChild(messageElement);

    messagesContainer.appendChild(messageWrapper);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

// Debug Ably Connection
window.Ably.connection.on('connected', () => console.log('✅ Connected to Ably'));
window.Ably.connection.on('disconnected', () => console.log('❌ Disconnected from Ably'));





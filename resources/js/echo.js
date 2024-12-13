import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

const chatMessages = document.querySelector('.chat-messages');
function appendMessage(message, type) {
    // Create the message div
    const messageHtml = `
        <div class="message ${type}">
            ${message}
        </div>
    `;

    chatMessages.insertAdjacentHTML('beforeend', messageHtml);
}


// Get the user ID from local storage
const userId = localStorage.getItem('userId');
window.Echo.channel('messages.' + userId)
    .listen('MessageSent', (e) => {
        appendMessage(e.text, 'received')
    })


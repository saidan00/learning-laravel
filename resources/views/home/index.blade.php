<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Interface</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .chat-container {
            width: 400px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            padding: 10px 15px;
            background: #007bff;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        /* .chat-messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            background: #f1f1f1;
        }

        .message {
            margin-bottom: 10px;
            padding: 8px 12px;
            border-radius: 10px;
            max-width: 75%;
        }

        .message.sent {
            background: #007bff;
            color: white;
            align-self: flex-end;
            text-align: right;
        }

        .message.received {
            background: #e1e1e1;
            color: black;
            align-self: flex-start;
        } */

        .chat-footer {
            display: flex;
            padding: 10px;
            background: #fff;
            border-top: 1px solid #ddd;
            border-radius: 0 0 10px 10px;
        }

        .chat-footer input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .chat-footer button {
            margin-left: 5px;
            padding: 8px 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .chat-footer button:hover {
            background: #0056b3;
        }

        .chat-messages {
            display: flex;
            flex-direction: column;
            gap: 10px;
            /* Space between messages */
            width: 100%;
            margin: 0 auto;
            /* Center the chat container horizontally */
            padding: 20px;
            border-radius: 10px;
            overflow-y: auto;
            /* Enable scrolling if content overflows */
            height: 400px;
            /* Set the height of the chat box */
            position: relative;
        }

        .message {
            padding: 10px 15px;
            border-radius: 10px;
            max-width: 70%;
            /* Limit the message bubble width */
            font-size: 14px;
            line-height: 1.5;
            position: relative;
        }

        /* Sent messages (aligned to the right) */
        .message.sent {
            background-color: #007bff;
            /* Light blue for sent messages */
            color: #fff;
            align-self: flex-end;
            /* Align the bubble to the right */
            margin-left: auto;
            /* Push to the right */
            text-align: left;
            /* Text stays left-aligned within the bubble */
        }

        /* Received messages (aligned to the left) */
        .message.received {
            background-color: #eaeaea;
            /* Light gray for received messages */
            align-self: flex-start;
            /* Align the bubble to the left */
            margin-right: auto;
            /* Push to the left */
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="chat-container">
        {{-- <div>
            <input type="text" id="username" placeholder="Enter your name" />
        </div> --}}
        <div class="chat-header">
            Chat Interface
        </div>
        <div class="chat-messages">
            {{-- <div class="message sent">
                Hello, how are you?
            </div>
            <div class="message received">
                I'm good, thank you! How about you?
            </div>
            <div class="message sent">
                I'm doing well, thanks!
            </div> --}}
        </div>
        <div class="chat-footer">
            <input id="message" type="text" placeholder="Type a message...">
            <button id="send-message">Send</button>
        </div>
    </div>

    <script>
        const sendMessageButton = document.getElementById('send-message');
        const messageInput = document.getElementById('message');
        const userId = localStorage.getItem('userIdToSent');
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
        sendMessageButton.addEventListener('click', () => {
            const message = messageInput.value;

            axios.post('/send-message', {
                message: message,
                user_id: userId
            }).then((response) => {
                console.log(response.data.status);
                appendMessage(message, 'sent')
                messageInput.value = '';
            }).catch((error) => {
                console.error(error);
            });
        });
    </script>
</body>

</html>

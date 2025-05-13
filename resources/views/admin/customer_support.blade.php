<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Chat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #1c1c1e;
            color: white;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #121212;
            padding: 20px;
            overflow-y: auto;
            border-right: 2px solid #00cc00;
        }

        .sidebar h3 {
            margin-bottom: 20px;
            color: #00cc00;
        }

        .contact {
            padding: 12px;
            background-color: #2c2c2e;
            border-radius: 6px;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .contact:hover, .contact.active {
            background-color: #00cc00;
            color: black;
        }

        .chat-window {
            flex: 1;
            display: flex;
            flex-direction: column;
            background-color: #1c1c1e;
        }

        .chat-header {
            background-color: #00cc00;
            color: black;
            padding: 15px;
            font-size: 16px;
            border-bottom: 1px solid #333;
        }

        .chat-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .message {
            display: flex;
            margin-bottom: 12px;
        }

        .message.sent {
            justify-content: flex-end;
        }

        .message.received {
            justify-content: flex-start;
        }

        .bubble {
            max-width: 70%;
            padding: 10px 15px;
            border-radius: 10px;
            background-color: #3a3a3a;
            position: relative;
            color: white;
            font-size: 14px;
        }

        .message.sent .bubble {
            background-color: #007bff;
            color: white;
        }

        .bubble small {
            display: block;
            margin-top: 5px;
            font-size: 10px;
            color: #ccc;
        }

        .chat-input {
            display: flex;
            padding: 15px 20px;
            border-top: 1px solid #333;
            background-color: #2c2c2e;
        }

        .chat-input input {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #1c1c1e;
            color: white;
        }

        .chat-input button {
            background-color: #00cc00;
            border: none;
            color: black;
            padding: 10px 15px;
            margin-left: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>

</head>
<body>

<div class="container">
    @include('admin.sidebar')
    <div class="sidebar">
        <h3>Customer Query</h3>
        <div class="contact-list">
            <div class="contact" id="contact-0" onclick="openChat(0, 'TEST USER', 'test1@gmail.com', [
                {text: 'HEY TEST USER 😎', time: '39 minutes ago', type: 'sent'},
                {text: 'What\'s up Abdo 😁', time: '38 minutes ago', type: 'received'},
                {text: 'I\'m good, onta', time: '38 minutes ago', type: 'sent'}
            ])">
                TEST USER<br><small>test1@gmail.com</small>
            </div>
            <div class="contact" id="contact-1" onclick="openChat(1, 'Vance Williamson', 'arvel03@example.com', [
                {text: 'Hey Vance, how\'s it going?', time: '1 hour ago', type: 'sent'},
                {text: 'It\'s going great! What\'s up?', time: '59 minutes ago', type: 'received'}
            ])">
                Vance Williamson<br><small>arvel03@example.com</small>
            </div>
            <div class="contact" id="contact-2" onclick="openChat(2, 'Jeramie Shields', 'katelynn.quigley@example.com', [
                {text: 'Hey Jeramie, long time no see!', time: '2 hours ago', type: 'sent'},
                {text: 'I know! How have you been?', time: '1 hour ago', type: 'received'}
            ])">
                Jeramie Shields<br><small>katelynn.quigley@example.com</small>
            </div>
            <div class="contact" id="contact-3" onclick="openChat(3, 'Dr. Gwen Stamm MD', 'bbogan@example.org', [
                {text: 'Hello Dr. Stamm!', time: '30 minutes ago', type: 'sent'},
                {text: 'Good day! How can I help?', time: '29 minutes ago', type: 'received'}
            ])">
                Dr. Gwen Stamm MD<br><small>bbogan@example.org</small>
            </div>
        </div>
    </div>

    <div class="chat-window">
        <div class="chat-header">
            <div id="chat-header">
                <strong>No chat selected</strong><br>
                <small>Click on a contact to start chatting</small>
            </div>
        </div>

        <div class="chat-messages" id="chat-messages">
            <!-- Chat messages will be injected here by JavaScript -->
        </div>

        <div class="chat-input">
            <input type="text" id="message-input" placeholder="Type your message here..." />
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>
</div>
<script>
    // Function to open the chat window and dynamically load messages
    function openChat(userId, userName, userEmail, messages) {
        // Update chat header with the selected user's name and email
        document.getElementById('chat-header').innerHTML = `<strong>${userName}</strong><br><small>${userEmail}</small>`;

        // Clear previous chat messages
        let chatMessages = document.getElementById('chat-messages');
        chatMessages.innerHTML = '';

        // Add messages to the chat window
        messages.forEach(message => {
            let messageDiv = document.createElement('div');
            messageDiv.classList.add('message', message.type);
            messageDiv.innerHTML = `<div class="bubble">${message.text}<br><small>${message.time}</small></div>`;
            chatMessages.appendChild(messageDiv);
        });

        // Optionally scroll to the bottom of the chat messages
        chatMessages.scrollTop = chatMessages.scrollHeight;

        // Reset the "active" class for all contacts
        let contacts = document.querySelectorAll('.contact');
        contacts.forEach(contact => contact.classList.remove('active'));

        // Set the "active" class on the clicked contact
        document.getElementById('contact-' + userId).classList.add('active');
    }

    // On page load, ensure no chat is selected and default message is shown
    document.addEventListener('DOMContentLoaded', function () {
        let contacts = document.querySelectorAll('.contact');
        contacts.forEach(contact => contact.classList.remove('active'));
        document.getElementById('chat-header').innerHTML = `<strong>No chat selected</strong><br><small>Click on a contact to start chatting</small>`;
    });

    // Function to send message
    function sendMessage() {
        // Get the input message
        let messageInput = document.getElementById('message-input');
        let messageText = messageInput.value.trim();

        // Check if the message is not empty
        if (messageText) {
            // Create a new message element and add it to the chat window
            let chatMessages = document.getElementById('chat-messages');
            let messageDiv = document.createElement('div');
            messageDiv.classList.add('message', 'sent');
            messageDiv.innerHTML = `<div class="bubble">${messageText}<br><small>Just now</small></div>`;
            chatMessages.appendChild(messageDiv);

            // Optionally scroll to the bottom of the chat messages
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Clear the input field
            messageInput.value = '';
        }
    }
</script>

</body>
</html>

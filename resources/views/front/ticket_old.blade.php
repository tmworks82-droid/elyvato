<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Ticket System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
        }
        .ticket-container {
            max-width: 800px;
            margin-top: 50px;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden; /* Ensures child elements respect border-radius */
        }
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e9ecef;
            font-size: 1.25rem;
            font-weight: 600;
            padding: 1.5rem;
        }
        .card-body, .card-footer {
            padding: 1.5rem;
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: background-color 0.2s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }
        #chat-log {
            height: 400px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .chat-message {
            padding: 0.75rem 1rem;
            border-radius: 18px;
            max-width: 75%;
            word-wrap: break-word;
        }
        .chat-message img {
            max-width: 100%;
            border-radius: 10px;
            margin-top: 10px;
            cursor: pointer;
        }
        .user-message {
            background-color: #0d6efd;
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 4px;
        }
        .agent-message {
            background-color: #e9ecef;
            color: #212529;
            align-self: flex-start;
            border-bottom-left-radius: 4px;
        }
        .message-time {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 4px;
        }
        .user-message + .message-time {
            text-align: right;
        }
        .agent-message + .message-time {
            text-align: left;
        }
        .typing-indicator {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 0.75rem 1rem;
        }
        .typing-indicator span {
            height: 8px;
            width: 8px;
            background-color: #6c757d;
            border-radius: 50%;
            display: inline-block;
            animation: bounce 1.4s infinite ease-in-out both;
        }
        .typing-indicator span:nth-of-type(1) { animation-delay: -0.32s; }
        .typing-indicator span:nth-of-type(2) { animation-delay: -0.16s; }
        @keyframes bounce {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1.0); }
        }
    </style>
</head>
<body>

    

    <div class="container ticket-container">
        <!-- Section 1: Form to raise a new ticket -->
        <div id="ticket-form-section">
            <div class="d-grid mb-3">
                <button class="btn btn-primary btn-lg d-flex justify-content-between align-items-center" id="toggle-form-btn" type="button">
                    <span id="toggle-btn-text">Raise a New Ticket</span>
                    <span>
                        <svg id="toggle-icon-expand" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                        </svg>
                        <svg id="toggle-icon-collapse" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill d-none" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg>
                    </span>
                </button>
            </div>
            <div class="card d-none" id="ticket-form-card">
                <div class="card-header">
                    Please fill out the details below
                </div>
                <div class="card-body">
                    <form id="new-ticket-form">
                        <div class="mb-4">
                            <label for="department" class="form-label fw-medium">Select Department</label>
                            <select class="form-select form-select-lg" id="department" required>
                                <option value="" selected disabled>Choose a department...</option>
                                <option value="Technical Support">Technical Support</option>
                                <option value="Billing & Payments">Billing & Payments</option>
                                <option value="Sales & Inquiries">Sales & Inquiries</option>
                                <option value="General Feedback">General Feedback</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="issue" class="form-label fw-medium">Describe your issue</label>
                            <textarea class="form-control" id="issue" rows="6" placeholder="Please provide as much detail as possible..." required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="attachment" class="form-label fw-medium">Attach an image (optional)</label>
                            <input class="form-control" type="file" id="attachment" accept="image/*">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Section 2: Chat interface for an existing ticket -->
        <div id="ticket-chat-section" class="d-none">
            <div class="card">
                <div class="card-header" id="chat-header">
                    Conversation with Technical Support
                </div>
                <div class="card-body" id="chat-log">
                    <!-- Chat messages will be appended here -->
                </div>
                <div class="card-footer bg-white">
                    <form id="reply-form">
                        <div class="input-group">
                            <input type="text" id="reply-message" class="form-control form-control-lg" placeholder="Type your reply..." aria-label="Type your reply" required>
                            <button class="btn btn-primary" type="submit" id="send-reply-btn">
                                <!-- Send Icon SVG -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                  <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Custom JavaScript -->
    <script>
        const ticketFormSection = document.getElementById('ticket-form-section');
        const ticketChatSection = document.getElementById('ticket-chat-section');
        const newTicketForm = document.getElementById('new-ticket-form');
        const replyForm = document.getElementById('reply-form');
        const chatLog = document.getElementById('chat-log');
        const chatHeader = document.getElementById('chat-header');
        const replyMessageInput = document.getElementById('reply-message');

        // New elements for the toggle functionality
        const toggleFormBtn = document.getElementById('toggle-form-btn');
        const ticketFormCard = document.getElementById('ticket-form-card');
        const toggleBtnText = document.getElementById('toggle-btn-text');
        const expandIcon = document.getElementById('toggle-icon-expand');
        const collapseIcon = document.getElementById('toggle-icon-collapse');

        // Event listener for the toggle button
        toggleFormBtn.addEventListener('click', () => {
            ticketFormCard.classList.toggle('d-none');
            const isHidden = ticketFormCard.classList.contains('d-none');
            
            toggleBtnText.textContent = isHidden ? 'Raise a New Ticket' : 'Close Form';
            expandIcon.classList.toggle('d-none', !isHidden);
            collapseIcon.classList.toggle('d-none', isHidden);
        });

        // Function to get current time as a string
        const getCurrentTime = () => new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

        // Function to scroll chat to the bottom
        const scrollToBottom = () => {
            chatLog.scrollTop = chatLog.scrollHeight;
        };
        
        // Function to add a typing indicator
        const showTypingIndicator = () => {
            const indicatorHtml = `
                <div id="typing-indicator" class="agent-message typing-indicator">
                    <span></span><span></span><span></span>
                </div>
            `;
            chatLog.insertAdjacentHTML('beforeend', indicatorHtml);
            scrollToBottom();
        };

        // Function to remove the typing indicator
        const removeTypingIndicator = () => {
            const indicator = document.getElementById('typing-indicator');
            if (indicator) {
                indicator.remove();
            }
        };


        // Function to add a message to the chat log
        const addMessage = (sender, text) => {
            const messageClass = sender === 'user' ? 'user-message' : 'agent-message';
            const messageHtml = `
                <div>
                    <div class="chat-message ${messageClass}">${text.replace(/\n/g, '<br>')}</div>
                    <div class="message-time">${getCurrentTime()}</div>
                </div>
            `;
            chatLog.insertAdjacentHTML('beforeend', messageHtml);
            scrollToBottom();
        };
        
        // Function to add an image with a caption to the chat log
        const addImageMessage = (sender, caption, file) => {
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const messageClass = sender === 'user' ? 'user-message' : 'agent-message';
                // Sanitize the caption text before inserting
                const sanitizedCaption = caption.replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\n/g, '<br>');
                const messageHtml = `
                    <div>
                        <div class="chat-message ${messageClass}">
                            ${sanitizedCaption}
                            <img src="${e.target.result}" alt="User attachment">
                        </div>
                        <div class="message-time">${getCurrentTime()}</div>
                    </div>
                `;
                chatLog.insertAdjacentHTML('beforeend', messageHtml);
                scrollToBottom();
            }
            reader.readAsDataURL(file);
        };


        // Mock agent replies
        const agentReplies = [
            "Thank you for reaching out. Please give me a moment to review your issue.",
            "I understand your concern. Could you please provide your account number or email address?",
            "We are looking into this with high priority. We'll get back to you with an update shortly.",
            "I've escalated your ticket to the relevant team. Their reference ID is #T789-B. Is there anything else I can help with?",
            "Thank you for your patience. We have resolved the issue. Please let us know if you face any further problems."
        ];
        let replyIndex = 0;
        
        // Simulate an agent replying
        const simulateAgentReply = () => {
            showTypingIndicator();
            
            setTimeout(() => {
                removeTypingIndicator();
                const replyText = agentReplies[replyIndex % agentReplies.length];
                replyIndex++;
                addMessage('agent', replyText);
            }, Math.random() * 2000 + 1000); // random delay between 1-3 seconds
        };


        // Event Listener for the new ticket form submission
        newTicketForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const department = document.getElementById('department').value;
            const issue = document.getElementById('issue').value;
            const attachment = document.getElementById('attachment').files[0];

            // Update chat header
            chatHeader.textContent = `Conversation with ${department}`;

            // Add the user's first message, with an image if attached
            if (attachment) {
                addImageMessage('user', issue, attachment);
            } else {
                addMessage('user', issue);
            }
            
            // Switch views
            ticketFormSection.classList.add('d-none');
            ticketChatSection.classList.remove('d-none');

            // Simulate the first agent reply
            simulateAgentReply();
        });

        // Event Listener for the reply form submission
        replyForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const messageText = replyMessageInput.value.trim();

            if (messageText) {
                addMessage('user', messageText);
                replyMessageInput.value = ''; // Clear input field
                
                // Simulate another agent reply
                simulateAgentReply();
            }
        });

    </script>
</body>
</html>



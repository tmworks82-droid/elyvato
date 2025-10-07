@php
    $title = 'Dashboard - Elyvato';
    $robotsMeta = 'noindex, nofollow';
@endphp


 @extends('layouts.front.user-app')


@section('pageContent')
@section('styles')
    <!-- Dropzone CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/dropzone.css">

    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">-->
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
            overflow: hidden;
            /* Ensures child elements respect border-radius */
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e9ecef;
            font-size: 1.25rem;
            font-weight: 600;
            padding: 1.5rem;
        }

        .card-body,
        .card-footer {
            padding: 1.5rem;
        }

        .btn-primary {
            background-color: #f97a00;
            border-color: #f97a00;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #8c32f6;
            border-color: #8c32f6;
        }

        #chat-log {
            height: 400px;
            overflow-y: scroll;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            scrollbar-width: none;
        }

        #chat-log::-webkit-scrollbar {
            display: none;
        }

        .chat-message {
            padding: 0.10rem 1rem;
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
            background-color: #f97a00;
            color: white;
            float: right;
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

        .user-message+.message-time {
            text-align: right;
        }

        .agent-message+.message-time {
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

        .typing-indicator span:nth-of-type(1) {
            animation-delay: -0.32s;
        }

        .typing-indicator span:nth-of-type(2) {
            animation-delay: -0.16s;
        }

        @keyframes bounce {

            0%,
            80%,
            100% {
                transform: scale(0);
            }

            40% {
                transform: scale(1.0);
            }
        }

        /* here for img
             */

        #attachment-preview .thumb {
            width: 64px;
            height: 64px;
            border-radius: .5rem;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, .1);
            background: #fff;
        }

        #attachment-preview .thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        #attachment-preview .pill {
            font-size: .9rem;
            padding: .35rem .6rem;
            border-radius: 999px;
            border: 1px solid rgba(0, 0, 0, .15);
            background: #fff;
        }
    </style>
@endsection
<style>
    th{
            font-weight: 600;
    }
</style>


{{-- header --}}
<div class="mb-3 mb-lg-4">
    <div class="d-flex gap-3 flex-wrap">
        <button class="btn d-inline d-lg-none p-0 fs-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <i class="ri-menu-2-line"></i>
        </button>
        <h1 class="fw-bold mb-0">Dashboard</h1>
    </div>
</div>


<section class="container ticket-container">
        <!-- Section 1: Form to raise a new ticket -->
        @if (empty($tickets))
            <div id="ticket-form-section">
                <div class="d-grid mb-3">
                    <button class="btn btn-primary btn-lg d-flex justify-content-between align-items-center"
                        id="toggle-form-btn" type="button">
                        <span id="toggle-btn-text">Raise a New Ticket</span>
                    </button>
                </div>
                <div class="card" id="ticket-form-card">
                    <div class="card-header">
                        Please fill out the details below
                    </div>
                    <div class="card-body">
                        <form id="new-ticket-form" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="department" class="form-label fw-medium">Select Department</label>
                                <select class="form-select form-select-lg" name="department" id="department" required>
                                    <option value="" selected disabled>Choose a department...</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="issue" class="form-label fw-medium">Describe your issue</label>
                                <textarea class="form-control" id="issue" name="issue" rows="6"
                                    placeholder="Please provide as much detail as possible..." required></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="attachment" class="form-label fw-medium">Attach an image (optional)</label>

                                {{-- <input class="form-control" type="file" name="attachment" id="attachment" accept="image/*"> --}}

                                <div class="dropzone" id="portfolio-dropzone">
                                    <div class="dz-message">Drop file here or click to upload</div>
                                </div>

                                <input type="hidden" name="attachment" id="attachment">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Submit Ticket</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <!-- Section 2: Chat interface for an existing ticket -->
            <div id="ticket-chat-section" class="d-nonee">
                <div class="card mb-5">
                    <div class="card-header" id="chat-header">
                        Conversation with  <span id="withname">Technical Support</span>  <br>

                        <span style="font-size: small; color: green;">TicketId- {{ $tickets->ticket_id }} </span>

                        <button id="close-ticket-btn" class="btn btn-sm btn-main" data-ticket-id="{{ $tickets->id }}" style="float: inline-end;">Close Ticket </button>

                    </div>
                    <div class="card-body" id="chat-log">
                        <!-- Chat messages will be appended here -->
                        <div>
                            <div class="chat-message user-message">
                                <span>{{ $tickets->describe_issue }}</span> <br>
                                @php
                                    $attachments = json_decode($tickets->image, true);
                                @endphp

                                @if (!empty($attachments))
                                    @foreach ($attachments as $file)
                                        <img src="{{ asset($file) }}" alt="Attachment"
                                            style="width: 200px; margin: 5px; border-radius: 5px;">
                                    @endforeach
                                @endif
                                <div class="message-time text-light">{{ $tickets->created_at->format('H:i') }}</div>
                            </div>
                        </div>
                      

                        @if (!empty($tickets->messages) && count($tickets->messages))
                            @foreach ($tickets->messages as $message)
                                @if ($message->sender == 'user')
                                    <div>
                                        <div class="chat-message user-message">
                                            <span> {{ $message->message }}</span> <br>
                                            @if (!empty($message->image))
                                                <img src="{{ url($message->image) }}" alt="" style="width: 200px;">
                                            @endif
                                            <div class="message-time text-light">{{ $message->created_at->format('H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div>
                                        <div class="chat-message agent-message">
                                            <span id="namewith" style="font-size: 13px; color: #652398;">{{ GetUser($message->user_id)->name ?? GetUser($message->user_id)->username }}</span>
                                            <br>
                                            {{ $message->message }} <br>

                                            @if (!empty($message->image))
                                                <img src="{{ url($message->image) }}" alt="" style="width: 200px;">
                                            @endif
                                            <br>
                                             <span
                                                class="message-time">{{ $message->created_at->format('H:i') }}</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif

                    </div>
                    <div class="card-footer bg-white">
                        <form id="reply-form" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <!-- Reply Message Input -->
                                <input type="text" id="reply-message" name="message"
                                    class="form-control form-control-lg" placeholder="Type your reply..."
                                    aria-label="Type your reply" required>

                                <!-- Attachment Button -->
                                <label for="attachment" class="btn btn-outline-secondary" title="Attach a file">
                                    <i class="ri-attachment-line"></i>
                                    <span class="visually-hidden">Attach a file</span>
                                </label>

                                <!-- Hidden File Input -->
                                <input type="file" id="attachment" name="attachment" class="d-none"
                                    accept="image/*,application/pdf" onchange="updateAttachmentName()">

                                <!-- Preview area -->
                                <div id="attachment-preview" class="mt-2 d-flex align-items-center gap-2"></div>
                                <!-- Send Button -->
                                <button class="btn btn-primary" type="submit" id="send-reply-btn">
                                    <!-- Send Icon SVG -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="dropzone-container" style="display: none;" id="portfolio-dropzone">
                        <div class="dz-message">Drop file here or click to upload</div>
                    </div>

                    <script>
                        // Function to update the file name when a file is selected
                        function updateAttachmentName() {
                            const input = document.getElementById('attachment');
                            const preview = document.getElementById('attachment-preview');

                            preview.innerHTML = ''; // reset

                            const file = input.files && input.files[0];
                            if (!file) return;

                            // Remove button
                            const removeBtn = document.createElement('button');
                            removeBtn.type = 'button';
                            removeBtn.className = 'btn btn-sm btn-outline-danger';
                            removeBtn.textContent = 'Remove';
                            removeBtn.addEventListener('click', () => {
                                input.value = ''; // clear input
                                preview.innerHTML = ''; // clear preview
                            });

                            // If image → show thumbnail
                            if (file.type.startsWith('image/')) {
                                const url = URL.createObjectURL(file);
                                const wrap = document.createElement('div');
                                wrap.className = 'd-flex align-items-center gap-2';

                                const thumb = document.createElement('div');
                                thumb.className = 'thumb';
                                thumb.innerHTML = `<img src="${url}" alt="${file.name}">`;

                                const meta = document.createElement('div');
                                meta.innerHTML = `
      <div class="fw-semibold small">${file.name}</div>
      <div class="text-muted small">${Math.round(file.size/1024)} KB</div>
    `;

                                wrap.appendChild(thumb);
                                wrap.appendChild(meta);
                                wrap.appendChild(removeBtn);
                                preview.appendChild(wrap);

                            } else {
                                // PDF (or other) → show a pill with name
                                const pill = document.createElement('span');
                                pill.className = 'pill';
                                pill.textContent = file.name;

                                const wrap = document.createElement('div');
                                wrap.className = 'd-flex align-items-center gap-2';
                                wrap.appendChild(pill);
                                wrap.appendChild(removeBtn);
                                preview.appendChild(wrap);
                            }
                        }
                    </script>




                </div>
            </div>
        @endif

        <!-- Section 2: Chat interface for an existing ticket -->
        <div id="ticket-chat-section" class="d-none">
            <div class="card mb-5">
                <div class="card-header" id="chat-header">
                    Conversation with Technical Support
                </div>
                <div class="card-body" id="chat-log">
                    <!-- Chat messages will be appended here -->


                </div>
                <div class="card-footer bg-white">
                    <form id="reply-form" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" id="reply-message" name="message" class="form-control form-control-lg"
                                placeholder="Type your reply..." aria-label="Type your reply" required>
                            <button class="btn btn-primary" type="submit" id="send-reply-btn">
                                <!-- Send Icon SVG -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                </svg>
                            </button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <!-- Custom JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/dropzone.min.js"></script>
    <script>
        Dropzone.autoDiscover = false;

        var uploadedFiles = []; // Array to store uploaded file paths

        var myDropzone = new Dropzone("#portfolio-dropzone", {
            url: "{{ route('upload.ticket.attachment') }}",
            paramName: "file",
            addRemoveLinks: true,
            dictDefaultMessage: "Drop files here or click to upload",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            maxFiles: 10, // Max files allowed, adjust as needed
            uploadMultiple: false, // false = one file per request, true = multiple in one request
            parallelUploads: 10, // Number of files uploaded in parallel
            success: function(file, response) {
                if (response.status) {
                    // Add uploaded file path to array
                    uploadedFiles.push(response.filepath);
                    // Update hidden input with JSON string of all uploaded files
                    document.getElementById("attachment").value = JSON.stringify(uploadedFiles);
                } else {
                    alert('File upload failed');
                }
            },
            removedfile: function(file) {
                // Remove file from Dropzone preview
                file.previewElement.remove();

                // Remove file from uploadedFiles array if already uploaded
                if (file.xhr) {
                    var response = JSON.parse(file.xhr.response);
                    var index = uploadedFiles.indexOf(response.filepath);
                    if (index > -1) {
                        uploadedFiles.splice(index, 1);
                        document.getElementById("attachment").value = JSON.stringify(uploadedFiles);
                    }
                }
            },
            error: function(file, response) {
                alert("Error uploading file: " + response.message);
            }
        });



        // Event Listener for the new ticket form submission
        $(document).ready(function() {
            // Event Listener for the form submission
            $('#new-ticket-form').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Prepare the form data
                const formData = new FormData(this);

                // Send the form data via AJAX to the Laravel backend
                $.ajax({
                    url: "{{ route('tickets.store') }}", // The URL to send the request to
                    type: "POST",
                    data: formData,
                    processData: false, // Don't process the data
                    contentType: false, // Don't set content-type header
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            'content') // CSRF token for protection
                    },
                    success: function(data) {
                        if (data.success) {
                            // Update the chat header with department name
                            $('#chat-header').text(`Conversation with ${data.department_name}`);

                            const issue = $('#issue').val();
                            // const attachment = $('#attachment')[0].files[0];
                            const attachment = $('#attachment');

                            // Add the user's first message, with or without an image
                            if (attachment) {
                                addImageMessage('user', issue, attachment);
                            } else {
                                addMessage('user', issue);
                            }

                            // Switch views
                            $('#ticket-form-section').addClass('d-none');
                            $('#ticket-chat-section').removeClass('d-none');

                            // Save the current ticket ID for future replies
                            window.currentTicketId = data.ticket_id;

                            // Simulate the agent's first reply
                            simulateAgentReply();
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        alert("Something went wrong. Please try again.");
                    }
                });
            });
        });





        // DOM Element References
        const ticketFormSection = document.getElementById('ticket-form-section');
        const ticketChatSection = document.getElementById('ticket-chat-section');
        const newTicketForm = document.getElementById('new-ticketss-form');
        const replyForm = document.getElementById('reply-formr');
        const chatLog = document.getElementById('chat-log');
        const chatHeader = document.getElementById('chat-header');
        const replyMessageInput = document.getElementById('reply-message');

        // New elements for the toggle functionality
        const toggleFormBtn = document.getElementById('toggle-form-btn');
        const ticketFormCard = document.getElementById('ticket-form-card');
        const toggleBtnText = document.getElementById('toggle-btn-text');
        const expandIcon = document.getElementById('toggle-icon-expand');
        const collapseIcon = document.getElementById('toggle-icon-collapse');


        // Function to toggle the ticket form visibility
        function toggleTicketForm() {
            ticketFormCard.classList.toggle('d-none');
            const isHidden = ticketFormCard.classList.contains('d-none');

            toggleBtnText.textContent = isHidden ? 'Raise a New Ticket' : 'Close Form';
            expandIcon.classList.toggle('d-none', !isHidden);
            collapseIcon.classList.toggle('d-none', isHidden);
        }

        // Function to get current time as a string
        function getCurrentTime() {
            return new Date().toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Function to scroll chat to the bottom
        function scrollToBottom() {
            chatLog.scrollTop = chatLog.scrollHeight;
        }

        // Function to show typing indicator
        function showTypingIndicator() {
            const indicatorHtml = `
        <div id="typing-indicator" class="agent-message typing-indicator">
            <span></span><span></span><span></span>
        </div>
    `;
            chatLog.insertAdjacentHTML('beforeend', indicatorHtml);
            scrollToBottom();
        }

        // Function to remove typing indicator
        function removeTypingIndicator() {
            const indicator = document.getElementById('typing-indicator');
            if (indicator) {
                indicator.remove();
            }
        }

        // Function to add a message to the chat log
        function addMessage(sender, text) {

            const messageClass = sender === 'user' ? 'user-message' : 'agent-message';
            const messageHtml = `
        <div>
            <div class="chat-message ${messageClass}">${text.replace(/\n/g, '<br>')}
             <br> <span class="message-time">${getCurrentTime()}</span>
            </div>
        </div>
    `;
            chatLog.insertAdjacentHTML('beforeend', messageHtml);
            scrollToBottom();
        }

        // Function to add an image with a caption to the chat log
        function addImageMessage(sender, caption, file) {
            window.location.reload();
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const messageClass = sender === 'user' ? 'user-message' : 'agent-message';
                const sanitizedCaption = caption.replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\n/g, '<br>');
                const messageHtml = `
            <div>
                <div class="chat-message ${messageClass}">
                  <span>${sanitizedCaption}</span> <br>  
                    <img src="${file}" alt="User attachment" style="width:200px;">
                    <div class="message-time text-light">${getCurrentTime()}</div>
                </div>
            </div>
        `;
                chatLog.insertAdjacentHTML('beforeend', messageHtml);
                scrollToBottom();
            }
            // reader.readAsDataURL(file);
        }

        // Simulate an agent reply
        const agentReplies = [
            "Thank you for reaching out. Please give me a moment to review your issue.",

        ];

        let replyIndex = 0;

        function simulateAgentReply() {
            showTypingIndicator();

            setTimeout(() => {
                removeTypingIndicator();
                const replyText = agentReplies[replyIndex % agentReplies.length];
                replyIndex++;
                addMessage('agent', replyText);
            }, Math.random() * 2000 + 1000); // random delay between 1-3 seconds
        }

        // AJAX submission for new ticket
        function submitNewTicketForm(e) {
            e.preventDefault(); // Prevent default form submission

            const formData = new FormData(newTicketForm);

            // Debug: Log form data
            // formData.forEach((value, key) => {
            //     console.log(key, value); // Log each form field name and its value
            // });

            fetch("{{ route('tickets.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                            .content // CSRF token for protection
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                        // Update chat header with department name
                        chatHeader.textContent = `Conversation with ${data.department_name}`;

                        const issue = document.getElementById('issue').value;
                        const attachment = document.getElementById('attachment').files[0];
                        window.location.reload();
                        // Add the user's first message, with an image if attached
                        if (attachment) {
                            addImageMessage('user', issue, attachment);
                        } else {
                            addMessage('user', issue);
                        }

                        // Switch views
                        ticketFormSection.classList.add('d-none');
                        ticketChatSection.classList.remove('d-none');

                        // Save the current ticket ID for future replies
                        window.currentTicketId = data.ticket_id;

                        // Simulate the first agent reply
                        simulateAgentReply();
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Something went wrong. Please try again.");
                });
        }

        // Event Listener for the new ticket form submission
        // newTicketForm.addEventListener('submit', submitNewTicketForm);

        // Event Listener for the reply form submission
        function submitReplyForm(e) {
            e.preventDefault();
            const messageText = replyMessageInput.value.trim();

            if (messageText) {
                addMessage('user', messageText);
                replyMessageInput.value = ''; // Clear input field

                // Simulate another agent reply
                simulateAgentReply();
            }
        }

        // replyForm.addEventListener('submit', submitReplyForm);


        // here is auto reply 

        $(document).ready(function() {
            // Event Listener for the reply form submission
            $('#reply-form').submit(function(e) {
                e.preventDefault(); // Prevent default form submission

                const formData = new FormData(this);

                // Debugging: Check the contents of FormData
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]); // This will log each key-value pair in FormData
                }

                // Send the reply via AJAX
                $.ajax({
                    url: "{{ route('tickets.reply') }}", // The URL to send the request to
                    type: "POST",
                    data: formData,
                    processData: false, // Don't process the data
                    contentType: false, // Don't set content-type header
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success == true) {


                            message = data.message;
                            type = data.type;
                            img = data.img
                            addMessages(type, message, img); // Correct usage

                            // Simulate the agent's reply after the user reply
                            // simulateAgentReply();
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        alert("Failed to send the reply. Please try again.");
                    }
                });

                // Clear the reply input field after submitting
                $('#reply-message').val('');
            });

            function addMessages(sender, text, img) {
                //     alert('tun');
                //    console.log(text.message);
                //  console.log(text.imgage);
                //    console.log(sender);
                // alert(img);


                const messageClass = sender === 'user' ? 'user-message' : 'agent-message';

                if (img == true) {
                    window.location.reload();

                } else {
                    const messageHtml = `
        <div>
            <div class="chat-message ${messageClass}">${text.message}
             <br> <span class="message-time">${getCurrentTime()}</span>
            </div>
        </div>
    `;
                    chatLog.insertAdjacentHTML('beforeend', messageHtml);
                    scrollToBottom();
                }


            }

        });

        //  here close ticket 

        $(document).on('click', '#close-ticket-btn', function(e) {
            e.preventDefault();

            if (!confirm('Are you sure you want to close this ticket?')) return;

            const $btn = $(this);
            const ticketId = $btn.data('ticket-id');
            if (!ticketId) return alert('Missing ticket id.');

            $btn.prop('disabled', true);

            $.ajax({
                url: "{{ route('tickets.close.user') }}",
                type: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    ticket_id: ticketId
                },

                success: function(resp, status, xhr) {
                    // Backend may return ok:true or ok:false (with 200 or 409)
                    if (resp && resp.ok === true) {

                        $.toast?.({
                            heading: 'Success',
                            text: resp.message || 'Ticket closed successfully.',
                            icon: 'success',
                            position: 'top-right'
                        }) || alert(resp.message || 'Ticket closed successfully.');
                        return location.reload();
                    }

                    // ❌ Not ok (e.g., already closed but returned 200)
                    const msg = (resp && resp.message) || 'Failed to close ticket.';
                    $.toast?.({
                        heading: 'Error',
                        text: msg,
                        icon: 'error',
                        position: 'top-right'
                    }) || alert(msg);
                },

                error: function(xhr) {

                    const r = xhr.responseJSON || {};
                    const msg =
                        r.message ||
                        (r.errors && Object.values(r.errors)[0]?.[0]) ||
                        xhr.statusText ||
                        'Something went wrong.';
                    $.toast?.({
                        heading: 'Error',
                        text: msg,
                        icon: 'error',
                        position: 'top-right'
                    }) || alert(msg);


                    if (xhr.status === 409) {
                        $btn.removeClass('btn-warning bg-warning').addClass('btn-secondary').text(
                            'Closed');
                        $('#reply-form').find('input, textarea, button, select').prop('disabled', true);
                    } else {
                        $btn.prop('disabled', false);
                    }
                }
            });
        });

        $(document).ready(function(){
            var name=$('#namewith').text();
            // alert(name);
            if(name==''){
                name="Support";
            }
            $('#withname').html(name);
        })
    </script>
@endsection

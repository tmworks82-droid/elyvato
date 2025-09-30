@php
    $page_name = 'Ticket Reply';
    $permission = 'ticket';
@endphp

@extends('layouts.main')
@section('title', 'ElyvatoContent| ' . $page_name . ' list')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #d12323;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: #fff;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #4CAF50;
        /* Green for "live" */
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #4CAF50;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    /* here is chat css  */

    .ticket-container {
        /* max-width: 800px; */
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
        background-color: #e9ecef;
        color: #000000;
        float: left;
        border-bottom-right-radius: 4px;
    }

    .agent-message {
        background-color: #6777dd;
        color: #ffffff;

        float: right;
        border-bottom-left-radius: 4px;
    }

    .message-time {
        font-size: 0.75rem;
        color: #ffffff;
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
</style>

<style>
    #file-previews .thumb {
        width: 60px;
        height: 60px;
        border-radius: .5rem;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, .08);
        position: relative;
    }

    #file-previews .thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    #file-previews .file-pill {
        font-size: .85rem;
        padding: .25rem .5rem;
        border: 1px solid rgba(0, 0, 0, .12);
        border-radius: 999px;
        background: #fff;
    }
</style>


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $page_name }} page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $page_name }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->

        <section class="content ticket-container">
            <div class="container-fluid">
                <div class="row">
                    <!-- Section 2: Chat interface for an existing ticket -->
                    <div id="ticket-chat-section" class="d-nonee col-sm-12">
                        <div class="card mb-5">
                            <div class="card-header" id="chat-header">
                                Conversation with <span class="text-primary">
                                    {{ $tickets->user->name ?? $tickets->user->username }}</span>
                                    
                                    <button  id="close-ticket-btn" class="btn btn-sm btn-warning float-right" data-ticket-id="{{ $tickets->id }}"
                                    >Close Ticket </button>

                                    @if($tickets->ticket_close=='close')
                                        <span class="badge badge-danger m-1">Ticket Closed</span>
                                    @else
                                        <span class="badge badge-success m-1">{{ucfirst($tickets->ticket_close)}}</span>
                                    @endif
                       <br> <span style="font-size: small; color: green;">TicketId- {{$tickets->ticket_id}} </span>


                            </div>
                            <div class="card-body" id="chat-log">
                                <!-- Chat messages will be appended here -->

                                <div>
                                    <div class="chat-message user-message">
                                        <span> {{ $tickets->describe_issue }}</span> <br>

                                        @php
                                            $attachments = json_decode($tickets->image, true);
                                        @endphp
                                        @if (!empty($attachments))
                                            @foreach ($attachments as $file)
                                                <img src="{{ url($file) }}" alt="" style="width: 200px;">
                                            @endforeach
                                        @endif
                                        <div class="message-time text-light">{{ $tickets->created_at->format('H:i') }}</div>
                                    </div>
                                </div>

                                @if (!empty($tickets->messages))
                                    @foreach ($tickets->messages as $message)
                                        @if ($message->sender == 'user')
                                            <div>
                                                <div class="chat-message user-message">
                                                    <span> {{ $message->message }}</span> <br>
                                                    @if (!empty($message->image))
                                                        <img src="{{ url($message->image) }}" alt=""
                                                            style="width: 200px;">
                                                    @endif
                                                    <div class="message-time text-dark">
                                                        {{ $message->created_at->format('H:i') }}</div>
                                                </div>
                                            </div>
                                        @else
                                            <div>
                                                <div class="chat-message agent-message">{{ $message->message }}
                                                    <br>
                                                    @if (!empty($message->image))
                                                        <img src="{{ url($message->image) }}" alt=""
                                                            style="width: 200px;">
                                                    @endif <br>
                                                    <span
                                                        class="message-time">{{ $message->created_at->format('H:i') }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                            </div>
                            {{-- <div class="card-footer bg-white">
                            <form id="reply-form" method="post">
                                @csrf
                                <input type="hidden" name="ticket_id" value="{{ $tickets->id }}">
                                <div class="input-group">
                                    <input type="text" id="reply-message" name="message"
                                        class="form-control form-control-lg" placeholder="Type your reply..."
                                        aria-label="Type your reply" required>
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
                        </div> --}}

                            <div class="card-footer bg-white">
                                <form id="reply-form" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="ticket_id" value="{{ $tickets->id }}">
                                    {{-- Preview strip --}}
                                    <div id="file-previews" class="mt-2 d-flex flex-wrap gap-2"></div>

                                    <div class="input-group">

                                        {{-- Attach button (opens hidden file input) --}}
                                        <button class="btn btn-outline-secondary" type="button" id="attach-btn"
                                            title="Attach file(s)">
                                            <i class="fas fa-paperclip"></i>
                                            <span id="attach-count" class="badge bg-secondary ms-1 d-none">0</span>
                                        </button>

                                        {{-- Hidden file input (multiple) --}}
                                        <input id="chat-files" name="attachments" type="file" class="d-none" multiple
                                            accept="image/*,.pdf,.doc,.docx,.xls,.xlsx,.txt">

                                        {{-- Message input --}}
                                        <input type="text" id="reply-message" name="message"
                                            class="form-control form-control-lg" placeholder="Type your reply..."
                                            aria-label="Type your reply" required  @if($tickets->ticket_close=='close') disabled @endif>

                                        {{-- Send --}}
                                        <button class="btn btn-primary" type="submit" id="send-reply-btn" title="Send" @if($tickets->ticket_close=='close') disabled @endif>
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>


                                </form>
                            </div>


                        </div>
                    </div>
                </div>


                <!-- Section 2: Chat interface for an existing ticket -->
                <div id="ticket-chat-section" class="d-none">
                    <div class="card card-primary card-outline direct-chat direct-chat-primary mb-4">

                        <div class="card-header">
                            <h3 class="card-title">Conversation with Technical Support</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div id="chat-log" class="direct-chat-messages"><!-- messages append here --></div>
                        </div>

                      

                        <div class="card-footer bg-white">
                            <form id="reply-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="ticket_id" value="{{ $tickets->id }}">

                                <div class="input-group">
                                    {{-- Attach button (stays visible) --}}
                                    <label for="attachment" class="btn btn-outline-secondary" title="Attach a file">
                                        <i class="ri-attachment-line"></i>
                                        <span class="visually-hidden">Attach a file</span>
                                    </label>



                                    {{-- Message input --}}
                                    <input type="text" id="reply-message" name="message" class="form-control"
                                        placeholder="Type your reply..." aria-label="Type your reply" required>

                                    {{-- Send --}}
                                    <button class="btn btn-primary" type="submit" id="send-reply-btn" title="Send">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>

                                {{-- Previews strip --}}
                                <div id="file-previews" class="mt-2 d-flex flex-wrap gap-2"></div>
                            </form>
                        </div>



                    </div>
                </div>


                <!-- Bootstrap JS for tabs (make sure this is included once in your layout) -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

                {{-- here end  --}}

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        Footer
    </div>
    <!-- /.card-footer-->
    </div>
    <!-- /.card -->

    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
@push('scripts')
    <script>
        (function() {
            const input = document.getElementById('chat-files');
            const attach = document.getElementById('attach-btn');
            const badge = document.getElementById('attach-count');
            const strip = document.getElementById('file-previews');

            attach.addEventListener('click', () => input.click());

            input.addEventListener('change', (e) => {
                const files = Array.from(e.target.files || []);
                strip.innerHTML = '';

                files.forEach(f => {
                    if (f.type.startsWith('image/')) {
                        const url = URL.createObjectURL(f);
                        const div = document.createElement('div');
                        div.className = 'thumb';
                        div.innerHTML = `<img src="${url}" alt="">`;
                        strip.appendChild(div);
                    } else {
                        const pill = document.createElement('span');
                        pill.className = 'file-pill me-2 mb-2';
                        pill.textContent = f.name;
                        strip.appendChild(pill);
                    }
                });

                if (files.length) {
                    badge.textContent = files.length;
                    badge.classList.remove('d-none');
                } else {
                    badge.classList.add('d-none');
                }
            });
        })();

        // here is auto reply 

        $(document).ready(function() {
            const chatLog = document.getElementById('chat-log');

            $('#reply-form').submit(function(e) {
                e.preventDefault();

                const formData = new FormData(this);


                for (var pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }

                $.ajax({
                    url: "{{ route('admin.ticket.reply') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success == true) {

                            message = data.message;
                            type = data.type;
                            msg = data.msg;
                            addMessages(type, message, msg);

                        }
                    },
                    error: function(err) {
                        console.log(err);
                        alert("Failed to send the reply. Please try again.");
                    }
                });

                $('#reply-message').val('');
            });

            function addMessages(sender, text, msg) {
                if (msg == true) {
                    window.location.reload();
                } else {
                    const messageClass = sender === 'user' ? 'user-message' : 'agent-message';
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



            function scrollToBottom() {
                chatLog.scrollTop = chatLog.scrollHeight;
            }

            function getCurrentTime() {
                return new Date().toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }
        });

    // here close ticket

    $(document).on('click', '#close-ticket-btn', function (e) {
  e.preventDefault();

  if (!confirm('Are you sure you want to close this ticket?')) return;

  const $btn = $(this);
  const ticketId = $btn.data('ticket-id');
  if (!ticketId) return alert('Missing ticket id.');

  $btn.prop('disabled', true);

  $.ajax({
    url: "{{ route('admin.ticket.close') }}",
    type: 'POST',
    dataType: 'json',
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    data: { ticket_id: ticketId },

    success: function (resp, status, xhr) {
      // Backend may return ok:true or ok:false (with 200 or 409)
      if (resp && resp.ok === true) {
        // ✅ Closed now
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
      $.toast?.({ heading: 'Error', text: msg, icon: 'error', position: 'top-right' }) || alert(msg);

      // If it's already closed, reflect that in UI
      if (/already closed/i.test(msg) || xhr.status === 409) {
        $btn.removeClass('btn-warning bg-warning').addClass('btn-secondary').text('Closed');
        $('#reply-form').find('input, textarea, button, select').prop('disabled', true);
      } else {
        $btn.prop('disabled', false);
      }
    },

    error: function (xhr) {
      
      const r = xhr.responseJSON || {};
      const msg =
        r.message ||
        (r.errors && Object.values(r.errors)[0]?.[0]) ||
        xhr.statusText ||
        'Something went wrong.';
      $.toast?.({ heading: 'Error', text: msg, icon: 'error', position: 'top-right' }) || alert(msg);

      if (xhr.status === 409) {
        $btn.removeClass('btn-warning bg-warning').addClass('btn-secondary').text('Closed');
        $('#reply-form').find('input, textarea, button, select').prop('disabled', true);
      } else {
        $btn.prop('disabled', false);
      }
    }
  });
});
 </script>
@endpush

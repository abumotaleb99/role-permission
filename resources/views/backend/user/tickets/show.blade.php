@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Your Ticket Details</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @include('backend.message') 
            <div class="card">
              <div class="card-body">
                <table class="">
                  <tr>
                    <th class="pr-2">Subject</th>
                    <td>{{ $ticket->subject }}</td>
                  </tr>
                  <tr>
                    <th class="pr-2">Priority</th>
                    <td>{{ ucfirst($ticket->priority) }}</td>
                  </tr>
                  <tr>
                    <th class="pr-2">Message</th>
                    <td>{{ $ticket->message }}</td>
                  </tr>

                  @if($ticket->file)
                    <tr>
                      <th class="pr-2">File</th>
                      <td>
                        <a href="{{ asset($ticket->file) }}" target="_blank">View Attachment</a>
                      </td>
                    </tr>
                  @endif

                </table>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card card-primary card-outline direct-chat direct-chat-primary">
              <div class="card-header">
                <h3 class="card-title">Support Chat</h3> 
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="direct-chat-messages">

                  @foreach($replies as $reply)
                    @if($reply->admin_id)
                      <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-left">Admin</span>
                          <span class="direct-chat-timestamp float-right">{{ $reply->created_at->format('d M h:i a') }}</span>
                        </div>
                        <div class="direct-chat-text ml-0">
                          {{ $reply->message }}
                        </div>
                        @if($reply->file)
                          <a href="{{ asset($reply->file) }}" target="_blank">View Attachment</a>
                        @endif
                      </div>
                    @elseif($reply->user_id)
                      <div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-right">{{ $ticket->user->name }}</span>
                          <span class="direct-chat-timestamp float-left">{{ $reply->created_at->format('d M h:i a') }}</span>
                        </div>
                        <div class="direct-chat-text mr-0">
                          {{ $reply->message }}
           
                        </div>
                        @if($reply->file)
                          <a href="{{ asset($reply->file) }}" target="_blank">View Attachment</a>
                        @endif
                      </div>
                    @endif
                  @endforeach

                </div>
              </div>
              <div class="card-footer">
                <form action="{{ route('user.tickets.reply', $ticket->id) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="input-group mb-3">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                  </div>
                  <div class="input-group mb-3">
                    <input type="file" name="file" class="form-control">
                  </div>
                  <div class="text-right">
                      <button type="submit" class="btn btn-primary">Reply</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        var chatContainer = document.querySelector('.direct-chat-messages');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    });
  </script>
@endsection

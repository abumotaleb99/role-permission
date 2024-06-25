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

                @foreach ($ticket->replies as $reply)
                  <div class="direct-chat-msg {{ $reply->admin_id ? 'right' : '' }}">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-{{ $reply->admin_id ? 'right' : 'left' }}">
                        {{ $reply->admin_id ? 'Admin' : $reply->user->name }}
                      </span>
                      <span class="direct-chat-timestamp float-{{ $reply->admin_id ? 'left' : 'right' }}">
                        {{ $reply->date }}
                      </span>
                    </div>
                    <div class="direct-chat-text {{ $reply->admin_id ? 'mr-0' : 'ml-0' }}">
                      {{ $reply->message }}
                    </div>
                    @if ($reply->file)
                      <div class="mt-2">
                        <a href="{{ asset($reply->file) }}" target="_blank">View Attachment</a>
                      </div>
                    @endif
                  </div>
                @endforeach

                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Admin</span>
                      <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                    </div>
                    <div class="direct-chat-text ml-0">
                      Is this template really for free? That's unbelievable!
                    </div>
                  </div>

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
@endsection

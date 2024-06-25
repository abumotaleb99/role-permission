@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ticket Details</h1>
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
                    <th class="pr-2">User</th>
                    <td>{{ $ticket->user->name }}</td>
                  </tr>
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

                  @foreach($replies as $reply)

                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">{{ $ticket->user->name }}</span>
                      <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                    </div>
                    <div class="direct-chat-text ml-0">
                      Is this template really for free? That's unbelievable!
                    </div>
                  </div>
                  @endforeach

                  {{-- <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right">Admin</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                    </div>
                    <div class="direct-chat-text mr-0">
                      You better believe it!
                    </div>
                  </div> --}}

                </div>
              </div>

              <div class="card-footer">
                <form action="{{ route('admin.tickets.reply', $ticket->id) }}" method="post" enctype="multipart/form-data">
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

@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1>Ticket List</h1>
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
              <div class="card-body table-responsive p-3">
                <table id="dataTable" class="table table-striped">
                  <thead>
                    <tr>
                      <th>User</th>
                      <th>Subject</th>
                      <th>Priority</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($tickets) > 0)
                  
                  @foreach($tickets as $ticket)
                    <tr>
                      <td>{{ $ticket->user->name }}</td>
                      <td>{{ $ticket->subject }}</td>
                      <td>{{ ucfirst($ticket->priority) }}</td>
                      <td>{{ $ticket->created_at->format('d M Y, h:i A') }}</td>
                      <td>
                        @if($ticket->status == 0)
                            <span class="badge badge-warning">Pending</span>
                        @elseif($ticket->status == 1)
                            <span class="badge badge-primary">Replied</span>
                        @elseif($ticket->status == 2)
                            <span class="badge badge-success">Closed</span>
                        @endif
                      </td>
                      <td class="d-flex">
                          <a href="{{ url('admin/tickets/' . $ticket->id) }}" class="btn btn-sm btn-primary mr-1">View Ticket</a>
                          <a href="{{ url('admin/admins/' . $ticket->id . '/delete') }}" onclick="return confirm('Are you sure you want to delete this Admin?')" class="btn btn-sm btn-danger">Delete</a>
                      </td>
                    </tr>
                  @endforeach
                  @else
                    <tr>
                      <td colspan="6" class="text-center">No data found.</td>
                    </tr>
                  @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
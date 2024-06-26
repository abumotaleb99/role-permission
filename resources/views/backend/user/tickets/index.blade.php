@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1>Ticket List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('user/tickets/add') }}" class="btn btn-primary">Open A New Ticket</a>
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
                      <th>Date</th>
                      <th>Service</th>
                      <th>Subject</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($tickets) > 0)
                  
                  @foreach($tickets as $ticket)
                    <tr>
                      <td>{{ $ticket->date }}</td>
                      <td>{{ $ticket->subject }}</td>
                      <td>{{ $ticket->subject }}</td>
                      
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
                          <a href="{{ url('user/tickets/' . $ticket->id) }}" class="btn btn-sm btn-primary mr-1">View Ticket</a>
                      </td>
                    </tr>
                  @endforeach
                  @else
                    <tr>
                      <td colspan="5" class="text-center">No data found.</td>
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
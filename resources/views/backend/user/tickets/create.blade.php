@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Ticket</h1>
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
              <form action="{{ route('user.tickets.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Subject</label>
                    <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" placeholder="Subject">
                    <span class="text-danger">{{ $errors->has('subject') ? $errors->first('subject') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Priority</label>
                    <select class="form-control" name="priority">
                      <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                      <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                      <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                  </select>
                    <span class="text-danger">{{ $errors->has('priority') ? $errors->first('priority') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control" name="message" placeholder="Message">{{ old('message') }}</textarea>
                    <span class="text-danger">{{ $errors->has('message') ? $errors->first('message') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>File</label>
                    <input type="file" class="form-control" name="file">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
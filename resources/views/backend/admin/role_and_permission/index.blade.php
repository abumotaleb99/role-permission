@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1>Role List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('admin/roles/add') }}" class="btn btn-primary">Add New Role</a>
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
                      <th style="width: 80px">S. No.</th>
                      <th>Role Name</th>
                      <th>Permissions</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($roles) > 0)
                  
                  @php($i = 1)
                  @foreach($roles as $role)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $role->name }}</td>
                      <td>
                        @foreach ($role->permissions as $permission)
                          
                          <span class="badge badge-success">{{$permission->name}}</span>
                        @endforeach
                      </td>
                      <td class="d-flex">
                        <a href="{{ url('admin/roles/' . $role->id . '/edit') }}" class="btn btn-sm btn-primary mr-1">Edit</a>
                        <a href="{{ url('admin/roles/' . $role->id . '/delete') }}" onclick="return confirm('Are you sure you want to delete this Role?')" class="btn btn-sm btn-danger">Delete</a>
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
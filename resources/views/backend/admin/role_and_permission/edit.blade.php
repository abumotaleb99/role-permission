@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Role</h1>
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
              <form action="{{ route('admin.roles.update') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $role->name) }}" placeholder="Name">
                    <input type="hidden" class="form-control" name="role_id" value="{{ $role->id }}">
                    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : "" }}</span>
                  </div>
                  <div class="form-group mb-0">
                    <label>Permissions</label>
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="permissionAll" value="1" {{ App\Models\User::roleHasAllPermissions($role, $allPermissions) ? 'checked' : '' }}>
                      <label for="permissionAll">All</label>
                    </div>
                    <hr>
                  </div>

                  @php $groupIndex = 1; @endphp
                  @foreach ($permissionGroups as $group)
                    <div class="row mb-2">
                      @php
                        $permissions = App\Models\User::getPermissionsByGroupName($group->name);
                      @endphp
                      <div class="col-md-3">
                        <div class="form-group">
                          <div class="form-check">
                            <input 
                              type="checkbox" 
                              class="form-check-input" 
                              id="role-permissions-group{{$groupIndex}}" 
                              value="{{ $group->name }}" 
                              onclick="checkPermissionByGroup('role-permissions{{$groupIndex}}', this)"
                              {{ App\Models\User::roleHasAllPermissions($role, $permissions) ? 'checked' : '' }}
                            >
                            <label for="role-permissions-group{{$groupIndex}}">{{ $group->name }}</label>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-9 role-permissions{{$groupIndex}}">
                        @foreach ($permissions as $permission)
                          <div class="form-group m-0">
                            <div class="form-check">
                              <input 
                                type="checkbox" 
                                class="form-check-input" 
                                id="permission{{$permission->id }}" 
                                name="permissions[]" 
                                value="{{ $permission->name }}"
                                @if(old('permissions') !== null && in_array($permission->name, old('permissions'))) checked @endif
                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                onclick="checkSinglePermission('role-permissions{{$groupIndex}}', 'role-permissions-group{{$groupIndex}}', {{ count($permissions) }})"
                              >
                              <label class="form-check-label" for="permission{{$permission->id }}">{{ $permission->name }}</label>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                    @php  $groupIndex++; @endphp
                  @endforeach

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

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("permissionAll").addEventListener("click", function () {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function (checkbox) {
          checkbox.checked = document.getElementById("permissionAll").checked;
        });
      });
    });

    function checkPermissionByGroup(permissionClassName, checkThis) {
      const groupCheckbox = document.getElementById(checkThis.id);
      const permissionCheckboxes = document.querySelectorAll('.' + permissionClassName + ' input');
  
      if (groupCheckbox.checked) {
        permissionCheckboxes.forEach(function(checkbox) {
          checkbox.checked = true;
        });
      } else {
        permissionCheckboxes.forEach(function(checkbox) {
          checkbox.checked = false;
        });
      }
      
      updateAllPermissionsCheckbox();
    }

    function checkSinglePermission(permissionClassName, groupID, countTotalPermission) {
      const permissionCheckboxes = document.querySelectorAll('.' + permissionClassName + ' input');
      const groupIDCheckbox = document.getElementById(groupID);

      let checkedCount = 0;
      permissionCheckboxes.forEach(function(checkbox) {
          if (checkbox.checked) {
              checkedCount++;
          }
      });

      if (checkedCount === countTotalPermission) {
          groupIDCheckbox.checked = true;
      } else {
          groupIDCheckbox.checked = false;
      }

      updateAllPermissionsCheckbox();
    }

    function updateAllPermissionsCheckbox() {
      const totalPermissionsCount = {{ count($allPermissions) }};
      const totalPermissionGroupsCount = {{ count($permissionGroups) }};
      
      const allCheckboxes = document.querySelectorAll('input[type="checkbox"]');
      const checkedCheckboxesCount = Array.from(allCheckboxes).filter(checkbox => checkbox.checked).length;

      const permissionAllCheckbox = document.getElementById("permissionAll");
      if (checkedCheckboxesCount >= (totalPermissionsCount + totalPermissionGroupsCount)) {
        permissionAllCheckbox.checked = true;
      } else {
        permissionAllCheckbox.checked = false;
      }
    }

  </script>
@endsection




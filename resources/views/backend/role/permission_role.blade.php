<h4>{{$roleData->role}}</h4>
<div class="card card-body">
    <input type="hidden" name="role_id" id="role_id" value="{{ $role_id }}">
    <div class="row m-0 p-l-0">
        @foreach ($moduleData as $module)
            <div class="col-md-3 mb-2">
                <h4 style="margin-left:25px;">
                    <span class="bg-warning badge text-dark">{{ $module->module_name }}</span>
                </h4>
                @foreach ($module->permissions as $permission)
                    <div class="form-check form-switch ms-5">
                        <input 
                            class="form-check-input permission-checkbox" 
                            type="checkbox" 
                            name="permissions[]"
                            value="{{ $permission->id }}" 
                             @if($permissionData->contains('permission_id', $permission->id)) checked @endif
                        >
                        <label class="form-check-label">{{ $permission->name }}</label>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-3">
        <button class="btn btn-outline-success" type="button" onclick="savePermissions()">Save Permissions</button>
    </div>
</div>

<script>
function savePermissions() {
    let roleId = document.getElementById('role_id').value;
    let enabledPermissions = {};

    document.querySelectorAll('.permission-checkbox').forEach((checkbox) => {
        const value = checkbox.value;           
    const isChecked = checkbox.checked; 
      enabledPermissions[value] = isChecked;
    });

    $.ajax({
        type: "POST",
        url: "{{ route('admin.permission_role_update') }}",
        data: {
            _token: "{{ csrf_token() }}",
            role_id: roleId,
            permissions: enabledPermissions
        },
        success: function(response) {
            alert('Permissions updated successfully.');
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while updating permissions.');
        }
    });
}
</script>

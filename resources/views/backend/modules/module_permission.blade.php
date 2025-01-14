<div class="card card-body">
   <h4>{{$moduleData->module_name}}</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Permission</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissionData as $permission)
                <tr>    
                    <td>{{ $permission->name }}</td>
                    <td>
                        <div class="form-check form-switch" style="margin-left:15px;">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                name="permission_{{ $permission->id }}" 
                                value="1" 
                                {{ $permission->status ? 'checked' : '' }}
                                onclick="permissionSwitch({{ $permission->id }}, this)">
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function permissionSwitch(permissionId, checkbox) {
    let value = checkbox.checked ? 1 : 0;

    $.ajax({
        type: "POST",
        url: "{{ route('admin.module_permission_switch') }}",
        data: {
            _token: "{{ csrf_token() }}",
            id: permissionId,
            value: value
        },
        success: function(response) {
            // Optionally update the UI or show a success message
            console.log('Success:', response);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            // Revert checkbox state if something goes wrong
            checkbox.checked = !checkbox.checked;
            alert('Something went wrong');
        }
    });
}
</script>

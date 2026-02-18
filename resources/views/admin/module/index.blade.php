@extends('admin.layout.app')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="main-content">
    <div class="card">

        <div class="card-header">
            <h3>Department Permissions</h3>
        </div>

        <div class="card-body">

            <!-- 🔥 Department Dropdown -->
            <div class="form-group">
                <label>Select Department</label>
                <select id="department_id" class="form-control">
                    <option value="">Select Department</option>
                    @foreach($department as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- 🔥 Module Table -->
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Module</th>
                        <th>View</th>
                        <th>Add</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($module as $mod)
                        <tr>
                            <td>{{ $mod->name }}</td>

                            <td>
                                <input type="checkbox" class="perm"
                                    data-module="{{ $mod->id }}"
                                    data-type="view">
                            </td>

                            <td>
                                <input type="checkbox" class="perm"
                                    data-module="{{ $mod->id }}"
                                    data-type="add">
                            </td>

                            <td>
                                <input type="checkbox" class="perm"
                                    data-module="{{ $mod->id }}"
                                    data-type="edit">
                            </td>

                            <td>
                                <input type="checkbox" class="perm"
                                    data-module="{{ $mod->id }}"
                                    data-type="delete">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- 🔥 Save Button -->
            <button class="btn btn-success mt-3" id="savePermission">
                Save Permissions
            </button>

        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    // CSRF setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // ================= LOAD PERMISSIONS =================
    $('#department_id').change(function(){

        let id = $(this).val();

        if(!id) return;

        $.get(`/admin/module/get/${id}`, function(res){

            // reset
            $('.perm').prop('checked', false);

            // set values
            $('.perm').each(function(){

                let module = $(this).data('module');
                let type = $(this).data('type');

                if(res[module] && res[module][type] == 1){
                    $(this).prop('checked', true);
                }

            });

        });

    });


    // ================= SAVE PERMISSIONS =================
    $('#savePermission').click(function(){

        let department_id = $('#department_id').val();

        if(!department_id){
            alert('Please select department');
            return;
        }

        let permissions = [];

        $('.perm').each(function(){

            permissions.push({
                module_id: $(this).data('module'),
                type: $(this).data('type'),
                value: $(this).is(':checked') ? 1 : 0
            });

        });

        $.ajax({
            url: "{{ route('admin.module.store') }}",
            type: "POST",
            data: {
                department_id: department_id,
                permissions: permissions
            },
            success: function(res){
                alert(res.message || 'Saved Successfully');
            }
        });

    });

});
</script>

@endsection

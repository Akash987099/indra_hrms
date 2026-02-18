@extends('admin.layout.app')

@section('content')
    <div class="main-content">
        <div class="card">

            <div class="card-header">
                <h3>Department Permissions</h3>
            </div>

            <div class="card-body">

                <div class="form-group">
                    <label>Select Department</label>
                    <select id="department_id" class="form-control">
                        <option value="">Select Department</option>
                        @foreach ($department as $item)
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
                        @foreach ($module as $mod)
                            <tr>
                                <td>{{ $mod->name }}</td>

                                <td>
                                    <input type="checkbox" class="perm" data-module="{{ $mod->id }}" data-type="view"
                                        {{ $mod->view ? 'checked' : '' }}>
                                </td>

                                <td>
                                    <input type="checkbox" class="perm" data-module="{{ $mod->id }}" data-type="add"
                                        {{ $mod->update ? 'checked' : '' }}>
                                </td>

                                <td>
                                    <input type="checkbox" class="perm" data-module="{{ $mod->id }}" data-type="edit"
                                        {{ $mod->edit ? 'checked' : '' }}>
                                </td>

                                <td>
                                    <input type="checkbox" class="perm" data-module="{{ $mod->id }}"
                                        data-type="delete" {{ $mod->delete ? 'checked' : '' }}>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

                <button class="btn btn-success mt-3" id="savePermission">
                    Save Permissions
                </button>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#savePermission').click(function() {

                let permissions = [];

                $('.perm').each(function() {

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
                        _token: "{{ csrf_token() }}",
                        permissions: permissions
                    },
                    success: function(res) {
                        alert(res.message);
                    }
                });

            });

        });
    </script>
@endsection

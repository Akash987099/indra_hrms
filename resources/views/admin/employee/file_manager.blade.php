@extends('admin.layout.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="main-content">
    <div class="card">

        <div class="card-header d-flex justify-content-between">
            <h3>Employee Documents ({{ $foldername }})</h3>

            <!-- Upload Button -->
            <button class="btn btn-primary" id="uploadBtn">
                <i class="fas fa-upload"></i> Upload File
            </button>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SR. No</th>
                        <th>File Name</th>
                        <th>View</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $key => $doc)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $doc->file_name }}</td>

                            <td>
                                <a href="{{ asset($doc->file_path) }}" target="_blank" class="btn btn-info btn-sm">
                                    View
                                </a>
                            </td>

                            <td>
                                <button class="btn btn-danger btn-sm deleteBtn"
                                    data-id="{{ $doc->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No files found</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>
</div>


<!-- ================= MODAL ================= -->
<div id="uploadModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:#00000080;">
    <div style="background:#fff; width:400px; margin:10% auto; padding:20px; border-radius:8px;">

        <h4>Upload File</h4>

        <form id="uploadForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="emp_code" value="{{ $foldername }}">

            <input type="file" name="file" class="form-control" required>

            <div style="margin-top:20px;">
                <button type="submit" class="btn btn-success">Upload</button>
                <button type="button" id="closeModal" class="btn btn-danger">Cancel</button>
            </div>
        </form>

    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    // Open Modal
    $('#uploadBtn').click(function(){
        $('#uploadModal').fadeIn();
    });

    // Close Modal
    $('#closeModal').click(function(){
        $('#uploadModal').fadeOut();
    });

    // Upload File
    $('#uploadForm').submit(function(e){
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('admin.employee.upload') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(){
                location.reload();
            }
        });
    });

    // Delete File
    $('.deleteBtn').click(function(){

        let id = $(this).data('id');

        if(!confirm('Delete this file?')) return;

        $.ajax({
            url: `{{ url('admin/employee/document/delete') }}/${id}`,
            type: "DELETE",
            success: function(){
                location.reload();
            }
        });

    });

});
</script>

@endsection

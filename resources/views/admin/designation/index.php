@extends('admin.layout.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Department Master</h3>
    </div>

    <div class="card-body">

        <!-- Add Form -->
        <form action="{{ route('admin.designation.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Enter Department Name" required>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>

        <hr>

        <!-- List -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th width="200">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $key => $dept)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $dept->name }}</td>
                    <td>
                        <a href="{{ route('admin.designation.toggle',$dept->id) }}">
                            {{ $dept->status ? 'Active' : 'Inactive' }}
                        </a>
                    </td>
                    <td>

                        <!-- Edit -->
                        <form action="{{ route('admin.designation.update',$dept->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" value="{{ $dept->name }}" required>
                            <button class="btn btn-warning btn-sm">Update</button>
                        </form>

                        <!-- Delete -->
                        <form action="{{ route('admin.designation.delete',$dept->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete?')">Delete</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection

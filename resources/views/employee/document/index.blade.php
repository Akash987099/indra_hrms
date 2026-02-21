@extends('employee.layout.app')

@section('content')

<div>
    <div class="section-card">
        <h2 class="section-title">Document Center</h2>

        <!-- BUTTON -->
        <div class="mb-3">
            <button class="btn btn-success" onclick="openModal()">
                Upload Document
            </button>
        </div>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Upload Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($documents as $doc)
                        <tr>
                            <td>{{ $doc->file_name }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($doc->created_at)->format('d M Y') }}
                            </td>

                            <td>
                                <a href="{{ asset($doc->file_path) }}" target="_blank" class="btn btn-sm btn-info">
                                    View
                                </a>

                                <button onclick="deleteDoc({{ $doc->id }})" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No Documents</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $documents->links() }}
    </div>
</div>

<!-- MODAL -->
<div class="modal" id="docModal">
    <div class="modal-content">
        <h4>Upload Document</h4>

        <form id="uploadForm">
            @csrf
            <input type="file" name="file" class="form-control mb-2" required>

            <button type="button" class="btn btn-success" onclick="uploadDoc()">Upload</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
        </form>
    </div>
</div>

<style>
.modal {
    display:none;
    position:fixed;
    top:0;left:0;
    width:100%;height:100%;
    background:rgba(0,0,0,0.5);
    justify-content:center;
    align-items:center;
}
.modal.show{display:flex;}
.modal-content{
    background:#fff;
    padding:20px;
    border-radius:10px;
}
</style>

<script>
function openModal(){
    document.getElementById('docModal').classList.add('show');
}

function closeModal(){
    document.getElementById('docModal').classList.remove('show');
}

function uploadDoc(){
    let form = document.getElementById('uploadForm');
    let data = new FormData(form);

    fetch("{{ route('user.document.store') }}", {
        method: "POST",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: data
    })
    .then(res => res.json())
    .then(res => {
        if(res.success){
            alert('Uploaded');
            location.reload();
        }
    });
}

function deleteDoc(id){
    if(confirm('Delete this file?')){
        fetch(`/user/document/delete/${id}`, {
            method: "DELETE",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
        })
        .then(res => res.json())
        .then(res => {
            if(res.success){
                location.reload();
            }
        });
    }
}
</script>

@endsection
@extends('employee.layout.app')

@section('content')

<style>
.modal {
    display: none; /* IMPORTANT */
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

    justify-content: center;
    align-items: center;

    background: rgba(0,0,0,0.5);
}

.modal.show {
    display: flex; /* 👈 ONLY WHEN OPEN */
}

.modal-content {
    background: #fff;
    width: 500px;
    max-width: 90%;
    border-radius: 10px;
    padding: 20px;
    animation: popup 0.3s ease;
}

@keyframes popup {
    from {
        transform: scale(0.7);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}
</style>

<div>
    <div class="section-card">
        <h2 class="section-title">Leave Management</h2>

        <!-- DASHBOARD -->
        <div class="dashboard-cards mb-4">
            <div class="card">
                <h5>Total Applications</h5>
                <h3>{{ $total }}</h3>
            </div>
        </div>

        <!-- BUTTONS -->
        <div class="mb-3 d-flex justify-content-between">
            <button class="btn btn-success" onclick="openModal()">
                New Leave Request
            </button>

            <a href="{{ route('user.leaves.export') }}" class="btn btn-info">
                Export Excel
            </a>
        </div>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Days</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($leaves as $leave)
                        <tr>
                            <td>{{ $leave->id }}</td>
                            <td>{{ ucfirst($leave->leave_type) }}</td>
                            <td>{{ $leave->from_date }}</td>
                            <td>{{ $leave->to_date }}</td>
                            <td>{{ $leave->duration_days }}</td>
                            <td>
                                <span class="badge bg-warning">
                                    {{ $leave->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $leaves->links() }}
    </div>
</div>

<!-- MODAL -->
<div class="modal" id="leaveModal">
    <div class="modal-content">
        <h4>Apply Leave</h4>

        <form id="leaveForm">
            @csrf

            <select name="leave_type" class="form-control mb-2" required>
                <option value="">Select Type</option>
                <option value="casual">Casual</option>
                <option value="sick">Sick</option>
            </select>

            <input type="date" name="from_date" class="form-control mb-2" required>
            <input type="date" name="to_date" class="form-control mb-2" required>

            <input type="number" name="days" class="form-control mb-2" placeholder="Days">

            <textarea name="reason" class="form-control mb-2" placeholder="Reason"></textarea>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-success" onclick="submitLeave()">Submit</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(){
    document.getElementById('leaveModal').classList.add('show'); // ✅ FIX
}

function closeModal(){
    document.getElementById('leaveModal').classList.remove('show');
}

// outside click close
window.onclick = function(e){
    let modal = document.getElementById('leaveModal');
    if(e.target === modal){
        closeModal();
    }
}

function submitLeave(){
    let form = document.getElementById('leaveForm');
    let data = new FormData(form);

    fetch("{{ route('user.leaves.store') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: data
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            alert('Leave Applied Successfully');
            location.reload();
        }
    });
}
</script>

@endsection
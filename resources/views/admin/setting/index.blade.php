@extends('admin.layout.app')

@section('content')
    <div class="main-content">
        <div id="task">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>Change Password</h3>
                </div>

                <div class="card-body">
                    <form id="passwordForm">
                        @csrf

                        <input type="password" name="current_password" class="form-control mb-2"
                            placeholder="Current Password">

                        <input type="password" name="new_password" class="form-control mb-2" placeholder="New Password">

                        <input type="password" name="new_password_confirmation" class="form-control mb-2"
                            placeholder="Confirm Password">

                        <button type="button" class="btn btn-success" onclick="changePassword()">
                            Change Password
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <script>
        // ✅ PASSWORD CHANGE
        function changePassword() {
            let form = document.getElementById('passwordForm');
            let data = new FormData(form);

            fetch("{{ route('admin.setting.update') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: data
                })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        alert('Password Changed');
                        location.reload();
                    } else {
                        alert(res.error);
                    }
                });
        }

    </script>
@endsection

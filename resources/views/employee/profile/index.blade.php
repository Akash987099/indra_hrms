@extends('employee.layout.app')

@section('content')

<div>
    <div class="section-card">
        <h2 class="section-title">My Profile</h2>

        <form id="profileForm">
            @csrf

            <div style="display:flex; gap:30px; margin-bottom:30px;">

                <!-- PHOTO -->
                <div style="text-align:center;">
                    <img 
                        src="{{ $user->profile_photo ? asset($user->profile_photo) : 'https://via.placeholder.com/120' }}"
                        style="width:120px; height:120px; border-radius:50%; object-fit:cover;"
                    >

                    <input type="file" id="photoInput" style="display:none;">

                    <button type="button" class="btn btn-info mt-2" onclick="document.getElementById('photoInput').click()">
                        Change Photo
                    </button>
                </div>

                <!-- FORM -->
                <div style="flex:1;">

                    <div class="form-row">
                        <div class="form-group">
                            <label>Employee ID</label>
                            <input type="text" class="form-control" value="{{ $user->employee_code }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
                        </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Department</label>
                            <input type="text" class="form-control" value="{{ $department->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" class="form-control" value="{{ $designation->name }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control">{{ $user->address }}</textarea>
                    </div>

                </div>
            </div>

            <div style="text-align:right;">
                <button type="button" class="btn btn-success" onclick="saveProfile()">
                    Save Changes
                </button>
            </div>

        </form>
    </div>
</div>

<script>
// ✅ SAVE PROFILE
function saveProfile(){
    let form = document.getElementById('profileForm');
    let data = new FormData(form);

    fetch("{{ route('user.profile.update') }}", {
        method: "POST",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: data
    })
    .then(res => res.json())
    .then(res => {
        if(res.success){
            alert('Profile Updated');
            location.reload();
        }
    });
}

// ✅ PHOTO UPLOAD
document.getElementById('photoInput').addEventListener('change', function(){
    let data = new FormData();
    data.append('photo', this.files[0]);

    fetch("{{ route('user.profile.photo') }}", {
        method: "POST",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: data
    })
    .then(res => res.json())
    .then(res => {
        if(res.success){
            alert('Photo Updated');
            location.reload();
        }
    });
});
</script>

@endsection
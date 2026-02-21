@extends('employee.layout.app')

@section('content')

<div>
    <div class="section-card">
        <h2 class="section-title">Account Settings</h2>

        <!-- PASSWORD -->
        <h4>Change Password</h4>

        <form id="passwordForm">
            @csrf

            <input type="password" name="current_password" class="form-control mb-2" placeholder="Current Password">

            <input type="password" name="new_password" class="form-control mb-2" placeholder="New Password">

            <input type="password" name="new_password_confirmation" class="form-control mb-2" placeholder="Confirm Password">

            <button type="button" class="btn btn-success" onclick="changePassword()">
                Change Password
            </button>
        </form>

        <!-- NOTIFICATION -->
        <h4 class="mt-4">Notification Preferences</h4>

        <form id="settingForm">
            @csrf

            <label>
                <input type="checkbox" name="email_notification" {{ $user->email_notification ? 'checked' : '' }}>
                Email notifications
            </label><br>

            <label>
                <input type="checkbox" name="leave_notification" {{ $user->leave_notification ? 'checked' : '' }}>
                Leave notifications
            </label><br>

            <label>
                <input type="checkbox" name="payroll_notification" {{ $user->payroll_notification ? 'checked' : '' }}>
                Payroll notifications
            </label><br>

            <label>
                <input type="checkbox" name="training_notification" {{ $user->training_notification ? 'checked' : '' }}>
                Training reminders
            </label><br><br>

            <button type="button" class="btn btn-info" onclick="saveSettings()">
                Save Preferences
            </button>
        </form>

    </div>
</div>

<script>
// ✅ PASSWORD CHANGE
function changePassword(){
    let form = document.getElementById('passwordForm');
    let data = new FormData(form);

    fetch("{{ route('user.setting.update') }}", {
        method: "POST",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: data
    })
    .then(res => res.json())
    .then(res => {
        if(res.success){
            alert('Password Changed');
            location.reload();
        }else{
            alert(res.error);
        }
    });
}

// ✅ SAVE SETTINGS
function saveSettings(){
    let form = document.getElementById('settingForm');
    let data = new FormData(form);

    fetch("{{ route('user.setting.store') }}", {
        method: "POST",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: data
    })
    .then(res => res.json())
    .then(res => {
        if(res.success){
            alert('Settings Saved');
        }
    });
}
</script>

@endsection
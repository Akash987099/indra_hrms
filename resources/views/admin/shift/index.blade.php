@extends('admin.layout.app')

@section('content')
    <div class="main-content">
        <div id="roster">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="dashboard-cards">
                <div class="card">
                    <div class="card-header">
                        <h3>Create Shift Roster</h3>
                        <i class="fas fa-calendar-plus"></i>
                    </div>

                    <div class="card-body">
                        <form id="rosterForm" method="POST" action="{{ route('admin.shift.generate') }}">
                            @csrf

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="rosterWeek">Select Week</label>
                                    <input type="week" id="rosterWeek" name="week" class="form-control" required
                                        value="{{ $week }}">
                                </div>

                                <div class="form-group">
                                    <label for="rosterDepartment">Department</label>
                                    <select id="rosterDepartment" name="department" class="form-control" required>
                                        <option value="">Select Department</option>
                                        <option value="Retail" {{ $department == 'Retail' ? 'selected' : '' }}>Retail</option>
                                        <option value="Housekeeping" {{ $department == 'Housekeeping' ? 'selected' : '' }}>
                                            Housekeeping</option>
                                        <option value="Security" {{ $department == 'Security' ? 'selected' : '' }}>Security
                                        </option>
                                        <option value="Management" {{ $department == 'Management' ? 'selected' : '' }}>Management
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>
                                    <input type="checkbox" id="autoAssign" name="auto_assign" value="1" checked>
                                    Auto-assign shifts based on employee preferences
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary">Generate Roster</button>
                            <button type="button" class="btn btn-success" id="publishRosterBtn">Publish Roster</button>
                        </form>

                        {{-- ✅ hidden publish form --}}
                        <form id="publishRosterForm" method="POST" action="{{ route('admin.shift.publish') }}"
                            style="display:none;">
                            @csrf
                            <input type="hidden" name="week" id="publishWeek">
                            <input type="hidden" name="department" id="publishDept">
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Shift Statistics</h3>
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="rosterChart"></canvas>
                        </div>
                        <small class="text-muted">(*Chart optional — data aap baad me bind kar sakte ho)</small>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-top: 20px;">
                <div class="card-header">
                    <h3>Weekly Shift Roster</h3>
                    <div>
                        <input type="week" id="viewRosterWeek" class="form-control"
                            style="width:auto; display:inline-block;" value="{{ $week }}">
                        <button type="button" class="btn btn-primary" id="loadRosterBtn">Load Roster</button>
                        <button type="button" class="btn btn-success" id="printRosterBtn">Print Roster</button>
                    </div>
                </div>

                <div class="card-body">
                    <div id="rosterCalendar">
                        {{-- ✅ optional: show server-side loaded rosters --}}
                        @if (isset($rosters) && $rosters->count())
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Employee</th>
                                        <th>Shift</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rosters as $r)
                                        <tr>
                                            <td>{{ $r->shift_date?->format('Y-m-d') }}</td>
                                            <td>{{ $r->employee?->first_name }} {{ $r->employee?->last_name }}</td>
                                            <td>
                                                {{ $r->shift?->name }}
                                                ({{ $r->shift?->start_time }} - {{ $r->shift?->end_time }})
                                            </td>
                                            <td>{{ $r->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">No roster loaded yet.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        (function() {

            function escapeHtml(str) {
                return String(str ?? '').replace(/[&<>"']/g, function(m) {
                    return ({
                        '&': '&amp;',
                        '<': '&lt;',
                        '>': '&gt;',
                        '"': '&quot;',
                        "'": '&#039;'
                    } [m]);
                });
            }

            function renderRoster(items) {
                const box = document.getElementById('rosterCalendar');
                if (!box) return;

                if (!items || items.length === 0) {
                    box.innerHTML = '<p class="text-muted">No roster found for selected week.</p>';
                    return;
                }

                let html = `
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Employee</th>
                        <th>Shift</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
        `;

                items.forEach(r => {
                    const empName = `${escapeHtml(r.employee?.first_name)} ${escapeHtml(r.employee?.last_name)}`
                        .trim();
                    const shiftName = escapeHtml(r.shift?.name);
                    const shiftTime = `${escapeHtml(r.shift?.start_time)} - ${escapeHtml(r.shift?.end_time)}`;

                    html += `
                <tr>
                    <td>${escapeHtml(r.shift_date)}</td>
                    <td>${empName || '-'}</td>
                    <td>${shiftName ? `${shiftName} (${shiftTime})` : '-'}</td>
                    <td>${escapeHtml(r.status)}</td>
                </tr>
            `;
                });

                html += `</tbody></table>`;
                box.innerHTML = html;
            }

            document.addEventListener('DOMContentLoaded', function() {

                // ✅ Load roster (AJAX)
                document.getElementById('loadRosterBtn')?.addEventListener('click', async function() {
                    const week = document.getElementById('viewRosterWeek').value;
                    const dept = document.getElementById('rosterDepartment')?.value || '';

                    if (!week) return alert('Please select week');

                    const url = new URL("{{ route('admin.shift.load') }}", window.location.origin);
                    url.searchParams.set('week', week);
                    if (dept) url.searchParams.set('department', dept);

                    try {
                        const res = await fetch(url.toString(), {
                            headers: {
                                'Accept': 'application/json'
                            }
                        });
                        const json = await res.json();
                        if (json.status) {
                            renderRoster(json.data || []);
                        } else {
                            alert('Failed to load roster');
                        }
                    } catch (e) {
                        alert('Error loading roster');
                    }
                });

                // ✅ Publish roster (POST)
                document.getElementById('publishRosterBtn')?.addEventListener('click', function() {
                    const week = document.getElementById('rosterWeek').value;
                    const dept = document.getElementById('rosterDepartment').value;

                    if (!week || !dept) return alert('Select week and department first');

                    document.getElementById('publishWeek').value = week;
                    document.getElementById('publishDept').value = dept;

                    document.getElementById('publishRosterForm').submit();
                });

                // ✅ Print
                document.getElementById('printRosterBtn')?.addEventListener('click', function() {
                    window.print();
                });

            });

        })();
    </script>
@endsection

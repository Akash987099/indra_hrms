@extends('admin.layout.app')

@section('content')
    <style>
        .modal {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }
    </style>

    <div class="main-content">
        <div id="employee">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center flex-wrap">

                    <!-- LEFT TITLE -->
                    <h3 class="mb-0">Employee Database</h3>

                    <button type="button" class="btn btn-primary" id="addEmployeeBtn">
                        <i class="fas fa-plus"></i> Add Employee
                    </button>

                    <a href="{{ route('employee.add') }}" class="btn btn-primary">
                        Add Onboarding
                    </a>

                    <a href="{{ route('admin.department.index') }}" class="btn btn-primary">
                        Department
                    </a>

                    <a href="{{ route('admin.designation.index') }}" class="btn btn-primary">
                        Designation
                    </a>

                    <a href="{{ route('admin.module.index') }}" class="btn btn-primary">
                        Modules
                    </a>

                    <a href="{{ route('employee.export') }}" class="btn btn-success">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>

                    <!-- RIGHT BUTTONS -->
                    {{-- <div class="d-flex flex-wrap gap-2">

                        <button type="button" class="btn btn-primary" id="addEmployeeBtn">
                            <i class="fas fa-plus"></i> Add Employee
                        </button>

                        <a href="{{ route('employee.add') }}" class="btn btn-primary">
                            Add Onboarding
                        </a>

                        <a href="{{ route('admin.department.index') }}" class="btn btn-primary">
                            Department
                        </a>

                        <a href="{{ route('admin.designation.index') }}" class="btn btn-primary">
                            Designation
                        </a>

                        <a href="{{ route('admin.module.index') }}" class="btn btn-primary">
                            Modules
                        </a>

                        <a href="{{ route('admin.employee.onboarding') }}" class="btn btn-primary">
                            Employee Onboarding
                        </a>

                    </div> --}}

                </div>

                <div class="card-body">
                    <div class="search-box">
                        <input type="text" id="employeeSearch" placeholder="Search employees by name, ID, department...">
                    </div>

                    <form method="GET" id="filterForm">

                        <div class="filters">

                            <!-- SEARCH -->
                            <div class="filter-group">
                                <label>Search</label>
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control">
                            </div>

                            <!-- DEPARTMENT -->
                            <div class="filter-group">
                                <label>Department</label>
                                <select name="department" class="form-control">
                                    <option value="">All</option>
                                    @foreach ($department as $item)
                                        <option value="{{ $item->id }}"
                                            {{ request('department') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- STATUS -->
                            <div class="filter-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">All</option>
                                    <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                            </div>

                            <!-- SORT -->
                            <div class="filter-group">
                                <label>Sort</label>
                                <select name="sort" class="form-control">
                                    <option value="name">Name A-Z</option>
                                    <option value="name-desc">Name Z-A</option>
                                    <option value="date">Newest</option>
                                    <option value="date-old">Oldest</option>
                                </select>
                            </div>

                            <!-- BUTTON -->
                            <div class="filter-group">
                                <button class="btn btn-primary mt-4">Apply</button>
                            </div>

                        </div>

                    </form>

                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>Employee Code</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>

                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Store Area</th>
                                    <th>Shift</th>

                                    <th>Join Date</th>
                                    <th>Salary</th>
                                    <th>Address</th>

                                    <th>Status</th>
                                    <th>Profile Photo</th>

                                    <th>Created</th>
                                    <th>Updated</th>

                                    <th>Actions</th>

                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($employee as $key => $item)
                                    <tr>

                                        <td>{{ $item->id }}</td>

                                        <td>{{ $item->employee_code }}</td>

                                        <td>{{ $item->first_name }}</td>

                                        <td>{{ $item->last_name }}</td>

                                        <td>{{ $item->email }}</td>

                                        <td>{{ $item->phone }}</td>

                                        <td>{{ $item->department_name }}</td>

                                        <td>{{ $item->role_name }}</td>

                                        <td>{{ $item->store_area }}</td>

                                        <td>{{ $item->shift }}</td>

                                        <td>{{ $item->join_date }}</td>

                                        <td>{{ $item->salary }}</td>

                                        <td>{{ $item->address }}</td>

                                        <td>

                                            @if ($item->status == 'Active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">{{ $item->status }}</span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($item->profile_photo)
                                                <img src="{{ asset('employees/' . $item->profile_photo) }}" width="40">
                                            @endif

                                        </td>

                                        <td>{{ $item->created_at }}</td>

                                        <td>{{ $item->updated_at }}</td>

                                        <td>

                                            {{-- <button class="btn btn-warning btn-sm editEmployeeBtn"
                                                data-id="{{ $item->id }}">
                                                Edit
                                            </button> --}}

                                            <a href="{{route('employee.edit', $item->id)}}" class="btn btn-warning btn-sm editEmployeeBtn"
                                                data-id="{{ $item->id }}">
                                                Edit
                                            </a>

                                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $item->id }}"
                                                data-url="{{ route('admin.employee.delete', $item->id) }}">
                                                Delete
                                            </button>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>

                    <div id="noEmployeesMessage" class="no-data" style="display:none;">
                        <i class="fas fa-user-slash"></i>
                        <h3>No employees found</h3>
                        <p>Try changing your search or filters</p>
                    </div>

                    <div class="pagination" id="employeePagination"></div>
                </div>
            </div>
        </div>

        <!-- ✅ MODAL -->
        <div id="employeeModal" class="modal" style="display:none;">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modalTitle">Add New Employee</h3>
                    <span class="close" id="closeModal">&times;</span>
                </div>

                <form id="employeeForm" autocomplete="off">
                    <input type="hidden" id="employeeId" value="">

                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName">Employee ID *</label>
                            <input type="text" id="employeeid" class="form-control"
                                placeholder="Enter Unique employee id" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName">First Name *</label>
                            <input type="text" id="firstName" class="form-control" placeholder="Enter first name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name *</label>
                            <input type="text" id="lastName" class="form-control" placeholder="Enter last name"
                                required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" class="form-control" placeholder="Enter email"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number *</label>
                            <input type="tel" id="phone" class="form-control" placeholder="Enter phone number"
                                required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="department">Department *</label>
                            <select id="department" class="form-control" required>
                                @foreach ($department as $key => $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="role">Designation *</label>
                            {{-- <input type="text" id="role" class="form-control" required
                                placeholder="e.g., Cashier, Supervisor"> --}}
                            <select id="role" class="form-control" required>
                                @foreach ($designation as $key => $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        {{-- <div class="form-group">
                            <label for="store">Store/Area *</label>
                            <input type="text" id="store" class="form-control" required
                                placeholder="e.g., Store #12, Floor 2">
                        </div> --}}
                        <div class="form-group">
                            <label for="shift">Preferred Shift</label>
                            <select id="shift" class="form-control">
                                <option value="Morning">Morning (9 AM - 6 PM)</option>
                                <option value="Evening">Evening (2 PM - 10 PM)</option>
                                <option value="Night">Night (10 PM - 6 AM)</option>
                                <option value="Flexible">Flexible</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="joinDate">Join Date *</label>
                            <input type="date" id="joinDate" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="salary">Basic Salary (₹)</label>
                            <input type="number" id="salary" class="form-control" placeholder="e.g., 18000">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" class="form-control" rows="3" placeholder="Enter address"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="status">Status *</label>
                        <select id="status" class="form-control" required>
                            <option value="Active">Active</option>
                            <option value="Probation">Probation</option>
                            <option value="On Leave">On Leave</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>

                    <div style="display:flex; gap:10px; margin-top:20px; padding-top:20px; border-top:1px solid #eee;">
                        <button type="submit" class="btn btn-primary" id="submitBtn">Add Employee</button>
                        <button type="button" class="btn btn-warning" id="resetBtn">Reset Form</button>
                        <button type="button" class="btn btn-danger" id="cancelBtn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        window.updateUrl = "{{ route('admin.employee.update', ':id') }}";
        window.storeUrl = "{{ route('admin.employee.store') }}";
    </script>

    <script>
        $(document).ready(function() {


            // ================= OPEN MODAL (ADD) =================
            $('#addEmployeeBtn').click(function() {

                $('#employeeForm')[0].reset();
                $('#employeeId').val('');
                $('#modalTitle').text('Add Employee');
                $('#submitBtn').text('Add Employee');

                $('#employeeModal').fadeIn();

            });


            // ================= CLOSE MODAL =================
            $('#closeModal,#cancelBtn').click(function() {
                $('#employeeModal').fadeOut();
            });


            // ================= EDIT =================
            $(document).on('click', '.editEmployeeBtn', function() {

                let id = $(this).data('id');
                let tr = $(this).closest('tr');

                let joinDate = tr.data('join_date');

                if (joinDate) {
                    $('#joinDate').val(joinDate.split(' ')[0]);
                }

                $('#employeeId').val(id);

                console.log(tr);


                // ✅ FIXED
                $('#employeeid').val(tr.data('employee_code'));

                $('#firstName').val(tr.data('first_name'));
                $('#lastName').val(tr.data('last_name'));
                $('#email').val(tr.data('email'));
                $('#phone').val(tr.data('phone'));

                // ✅ IMPORTANT (ID set karna hai)
                $('#department').val(tr.data('department')).trigger('change');
                $('#role').val(tr.data('role')).trigger('change');

                $('#shift').val(tr.data('shift'));
                // $('#joinDate').val(tr.data('join_date'));
                $('#salary').val(tr.data('salary'));
                $('#address').val(tr.data('address'));
                $('#status').val(tr.data('status'));

                $('#modalTitle').text('Edit Employee');
                $('#submitBtn').text('Update Employee');

                $('#employeeModal').fadeIn();
            });

            // ================= STORE / UPDATE =================
            $('#employeeForm').submit(function(e) {

                e.preventDefault();

                let id = $('#employeeId').val();

                let url = id ?
                    window.updateUrl.replace(':id', id) :
                    window.storeUrl;


                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        firstName: $('#firstName').val(),
                        employeeid: $('#employeeid').val(),
                        lastName: $('#lastName').val(),
                        email: $('#email').val(),
                        phone: $('#phone').val(),
                        department: $('#department').val(),
                        role: $('#role').val(),
                        store: $('#store').val(),
                        shift: $('#shift').val(),
                        joinDate: $('#joinDate').val(),
                        salary: $('#salary').val(),
                        address: $('#address').val(),
                        status: $('#status').val()
                    },
                    success: function(res) {

                        alert(res.message || 'Saved successfully');

                        location.reload(); // simple reload like department

                    }
                });

            });


            // ================= DELETE =================
            $(document).on('click', '.delete-btn', function() {

                if (!confirm('Delete this employee?')) return;

                let url = $(this).data('url');

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        location.reload();
                    }
                });

            });

        });
    </script>

    <script>
        $(document).on('click', '.copy-employee-link', function() {

            let link = $(this).data('link');

            // fallback copy method (works on HTTP also)
            let temp = $("<input>");
            $("body").append(temp);
            temp.val(link).select();
            document.execCommand("copy");
            temp.remove();

            alert('Employee view link copied!');

        });
    </script>
@endsection
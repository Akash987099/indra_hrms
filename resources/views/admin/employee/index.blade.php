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
                <div class="card-header">
                    <h3>Employee Database</h3>
                    <button type="button" class="btn btn-primary" id="addEmployeeBtn">
                        <i class="fas fa-plus"></i> Add Employee
                    </button>

                    <a href="{{ route('admin.employee.onboarding') }}" type="button" class="btn btn-primary" id="">
                        Employee Onboarding data
                    </a>
                </div>

                <div class="card-body">
                    <div class="search-box">
                        <input type="text" id="employeeSearch" placeholder="Search employees by name, ID, department...">
                    </div>

                    <div class="filters">
                        <div class="filter-group">
                            <label for="departmentFilter">Department</label>
                            <select id="departmentFilter" class="form-control">
                                <option value="">All Departments</option>
                                @foreach ($department as $key => $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="statusFilter">Status</label>
                            <select id="statusFilter" class="form-control">
                                <option value="">All Status</option>
                                <option value="Active">Active</option>
                                <option value="On Leave">On Leave</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Probation">Probation</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="sortBy">Sort By</label>
                            <select id="sortBy" class="form-control">
                                <option value="name">Name (A-Z)</option>
                                <option value="name-desc">Name (Z-A)</option>
                                <option value="department">Department</option>
                                <option value="date">Join Date (Newest)</option>
                                <option value="date-old">Join Date (Oldest)</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>SR. No</th>
                                    <th>Employee ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Store/Area</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                    <th>Link Generated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody id="sortable-table">
                                @foreach ($employee as $key => $item)
                                    <tr data-id="{{ $item->id }}" data-employee_code="{{ $item->employee_code }}"
                                        data-first_name="{{ $item->first_name }}" data-last_name="{{ $item->last_name }}"
                                        data-email="{{ $item->email }}" data-phone="{{ $item->phone }}"
                                        data-department="{{ $item->department }}" data-store_area="{{ $item->store_area }}"
                                        data-role="{{ $item->role }}" data-shift="{{ $item->shift }}"
                                        data-join_date="{{ $item->join_date }}" data-salary="{{ $item->salary }}"
                                        data-address="{{ $item->address }}" data-status="{{ $item->status }}">
                                        <td>
                                            {{ $employee->firstItem() + $key }}
                                        </td>

                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->employee_code }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->first_name }}
                                                {{ $item->last_name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->department }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->store_area }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->role }}</p>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.employee.approval') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <input type="hidden" name="status"
                                                    value="{{ $item->is_approved == 1 ? 0 : 1 }}">

                                                <button type="submit" style="background:none;border:none;padding:0;"
                                                    class="text-xs font-weight-bold {{ $item->is_approved == 1 ? 'text-success' : 'text-warning' }}">

                                                    {{ $item->is_approved == 1 ? 'Approved' : 'Pending' }}
                                                </button>
                                            </form>
                                        </td>

                                        <td>
                                            <form action="{{ route('admin.employee.status') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <input type="hidden" name="status"
                                                    value="{{ $item->status == 1 ? 0 : 1 }}">

                                                <button type="submit" style="background:none;border:none;padding:0;"
                                                    class="text-xs font-weight-bold {{ $item->status == 1 ? 'text-success' : 'text-danger' }}">
                                                    {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                                                </button>
                                            </form>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning copy-employee-link"
                                                data-link="{{ route('employee.view', $item->employee_code) }}"
                                                title="Copy employee view link">
                                                <i class="fas fa-eye"></i> Copy Link
                                            </button>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning editEmployeeBtn"
                                                data-id="{{ $item->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <button
                                                class="btn btn-sm btn-danger text-red-600 hover:underline dark:text-red-400 delete-btn"
                                                data-id="{{ $item->id }}"
                                                data-url="{{ route('admin.employee.delete', $item->id) }}">
                                                <i class="fas fa-trash"></i>
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
                            <label for="role">Role/Position *</label>
                            <input type="text" id="role" class="form-control" required
                                placeholder="e.g., Cashier, Supervisor">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="store">Store/Area *</label>
                            <input type="text" id="store" class="form-control" required
                                placeholder="e.g., Store #12, Floor 2">
                        </div>
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

                $('#employeeId').val(id);

                $('#firstName').val(tr.data('first_name'));
                $('#lastName').val(tr.data('last_name'));
                $('#email').val(tr.data('email'));
                $('#phone').val(tr.data('phone'));
                $('#department').val(tr.data('department'));
                $('#role').val(tr.data('role'));
                $('#store').val(tr.data('store_area'));
                $('#shift').val(tr.data('shift'));
                $('#joinDate').val(tr.data('join_date'));
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
                    `/admin/employee/update/${id}` :
                    `/admin/employee/store`;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        firstName: $('#firstName').val(),
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
$(document).on('click','.copy-employee-link',function(){

let link=$(this).data('link');

// fallback copy method (works on HTTP also)
let temp=$("<input>");
$("body").append(temp);
temp.val(link).select();
document.execCommand("copy");
temp.remove();

alert('Employee view link copied!');

});
</script>

@endsection

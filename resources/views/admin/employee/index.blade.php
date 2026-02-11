@extends('admin.layout.app')

@section('content')
<div class="main-content">
    <div id="employee">
        <div class="card">
            <div class="card-header">
                <h3>Employee Database</h3>
                <button type="button" class="btn btn-primary" id="addEmployeeBtn">
                    <i class="fas fa-plus"></i> Add Employee
                </button>
                
                 <a href="{{route('admin.employee.onboarding')}}" type="button" class="btn btn-primary" id="">
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
                            <option value="Retail">Retail</option>
                            <option value="Housekeeping">Housekeeping</option>
                            <option value="Security">Security</option>
                            <option value="Management">Management</option>
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
                                <tr
                                    data-id="{{ $item->id }}"
                                    data-employee_code="{{ $item->employee_code }}"
                                    data-first_name="{{ $item->first_name }}"
                                    data-last_name="{{ $item->last_name }}"
                                    data-email="{{ $item->email }}"
                                    data-phone="{{ $item->phone }}"
                                    data-department="{{ $item->department }}"
                                    data-store_area="{{ $item->store_area }}"
                                    data-role="{{ $item->role }}"
                                    data-shift="{{ $item->shift }}"
                                    data-join_date="{{ $item->join_date }}"
                                    data-salary="{{ $item->salary }}"
                                    data-address="{{ $item->address }}"
                                    data-status="{{ $item->status }}"
                                >
                                    <td>
                                        {{ $employee->firstItem() + $key }}
                                    </td>

                                    <td><p class="text-xs font-weight-bold mb-0">{{ $item->employee_code }}</p></td>
                                    <td><p class="text-xs font-weight-bold mb-0">{{ $item->first_name }} {{ $item->last_name }}</p></td>
                                    <td><p class="text-xs font-weight-bold mb-0">{{ $item->department }}</p></td>
                                    <td><p class="text-xs font-weight-bold mb-0">{{ $item->store_area }}</p></td>
                                    <td><p class="text-xs font-weight-bold mb-0">{{ $item->role }}</p></td>
                                    <td>
                                        <form action="{{ route('admin.employee.approval') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <input type="hidden" name="status" value="{{ $item->is_approved == 1 ? 0 : 1 }}">
                                    
                                            <button type="submit"
                                                style="background:none;border:none;padding:0;"
                                                class="text-xs font-weight-bold {{ $item->is_approved == 1 ? 'text-success' : 'text-warning' }}">
                                                
                                                {{ $item->is_approved == 1 ? 'Approved' : 'Pending' }}
                                            </button>
                                        </form>
                                    </td>
                                    
                                                                       <td>
                                        <form action="{{ route('admin.employee.status') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <input type="hidden" name="status" value="{{ $item->status == 1 ? 0 : 1 }}">
                                    
                                            <button type="submit"
                                                style="background:none;border:none;padding:0;"
                                                class="text-xs font-weight-bold {{ $item->status == 1 ? 'text-success' : 'text-danger' }}">
                                               {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>
                                    </td>
                                    
                                    <td>
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-warning copy-employee-link"
                                            data-link="{{ route('employee.view', $item->employee_code) }}"
                                            title="Copy employee view link"
                                        >
                                            <i class="fas fa-eye"></i> Copy Link
                                        </button>
                                    </td>

                                    <td>
                                        <!--<button type="button" class="btn btn-sm btn-warning editEmployeeBtn" data-id="{{ $item->id }}">-->
                                        <!--    <i class="fas fa-edit"></i>-->
                                        <!--</button>-->

                                        <button class="btn btn-sm btn-danger text-red-600 hover:underline dark:text-red-400 delete-btn"
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
                        <input type="text" id="firstName" class="form-control" placeholder="Enter first name" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name *</label>
                        <input type="text" id="lastName" class="form-control" placeholder="Enter last name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" class="form-control" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" class="form-control" placeholder="Enter phone number" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="department">Department *</label>
                        <select id="department" class="form-control" required>
                            <option value="">Select Department</option>
                            <option value="Retail">Retail</option>
                            <option value="Housekeeping">Housekeeping</option>
                            <option value="Security">Security</option>
                            <option value="Management">Management</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role">Role/Position *</label>
                        <input type="text" id="role" class="form-control" required placeholder="e.g., Cashier, Supervisor">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="store">Store/Area *</label>
                        <input type="text" id="store" class="form-control" required placeholder="e.g., Store #12, Floor 2">
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
document.addEventListener('DOMContentLoaded', function () {

  const modal = document.getElementById('employeeModal');
  const addBtn = document.getElementById('addEmployeeBtn');
  const closeBtn = document.getElementById('closeModal');
  const cancelBtn = document.getElementById('cancelBtn');
  const resetBtn = document.getElementById('resetBtn');

  const form = document.getElementById('employeeForm');
  const submitBtn = document.getElementById('submitBtn');
  const modalTitle = document.getElementById('modalTitle');

  const defaultPlaceholders = {
    firstName: "Enter first name",
    lastName: "Enter last name",
    email: "Enter email",
    phone: "Enter phone number",
    role: "e.g., Cashier, Supervisor",
    store: "e.g., Store #12, Floor 2",
    salary: "e.g., 18000",
    address: "Enter address",
  };

  function openModal() { modal.style.display = 'block'; }
  function closeModal() { modal.style.display = 'none'; }

  function setPlaceholders(mode){
    Object.keys(defaultPlaceholders).forEach(id => {
      const el = document.getElementById(id);
      if (!el) return;
      el.placeholder = (mode === "edit") ? "" : defaultPlaceholders[id];
    });
  }

  function setFormMode(mode) {
    if (mode === "edit") {
      modalTitle.textContent = "Edit Employee";
      submitBtn.textContent = "Update Employee";
      setPlaceholders("edit");
    } else {
      modalTitle.textContent = "Add New Employee";
      submitBtn.textContent = "Add Employee";
      document.getElementById('employeeId').value = "";
      form.reset();
      setPlaceholders("create");
    }
  }

  // Open Add
  addBtn.addEventListener('click', () => {
    setFormMode("create");
    openModal();
  });

  // Reset form (only fields)
  resetBtn.addEventListener('click', () => {
    const employeeId = document.getElementById('employeeId').value;
    if (employeeId) {
      // edit mode reset -> just clear inputs
      form.reset();
    } else {
      form.reset();
    }
  });

  closeBtn.addEventListener('click', closeModal);
  cancelBtn.addEventListener('click', closeModal);
  modal.addEventListener('click', function(e){ if (e.target === modal) closeModal(); });

  // ✅ Edit button click
  document.addEventListener('click', function(e){
    const btn = e.target.closest('.editEmployeeBtn');
    if (!btn) return;

    e.preventDefault();

    const id = btn.getAttribute('data-id');
    const tr = document.querySelector(`tr[data-id="${id}"]`);
    if (!tr) return;

    setFormMode("edit");
    document.getElementById('employeeId').value = id;

    document.getElementById('firstName').value = tr.dataset.first_name || "";
    document.getElementById('lastName').value  = tr.dataset.last_name || "";
    document.getElementById('email').value     = tr.dataset.email || "";
    document.getElementById('phone').value     = tr.dataset.phone || "";
    document.getElementById('department').value= tr.dataset.department || "";
    document.getElementById('role').value      = tr.dataset.role || "";
    document.getElementById('store').value     = tr.dataset.store_area || "";
    document.getElementById('shift').value     = tr.dataset.shift || "Morning";
    document.getElementById('joinDate').value  = (tr.dataset.join_date || "").slice(0,10);
    document.getElementById('salary').value    = tr.dataset.salary || "";
    document.getElementById('address').value   = tr.dataset.address || "";
    document.getElementById('status').value    = tr.dataset.status || "Active";

    openModal();
  });

  // ✅ Save (create/update)
  form.addEventListener('submit', async function(e){
    e.preventDefault();

    const employeeId = document.getElementById('employeeId').value;

    const payload = {
      firstName: document.getElementById('firstName').value,
      lastName: document.getElementById('lastName').value,
      email: document.getElementById('email').value,
      phone: document.getElementById('phone').value,
      department: document.getElementById('department').value,
      role: document.getElementById('role').value,
      store: document.getElementById('store').value,
      shift: document.getElementById('shift').value,
      joinDate: document.getElementById('joinDate').value,
      salary: document.getElementById('salary').value,
      address: document.getElementById('address').value,
      status: document.getElementById('status').value,
    };

    const isEdit = !!employeeId;
    const url = isEdit
      ? `{{ url('admin/employee') }}/${employeeId}`
      : `{{ route('admin.employee.store') }}`;

    const method = isEdit ? "PUT" : "POST";

    try {
      const res = await fetch(url, {
        method,
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(payload)
      });

      const data = await res.json();
      if (!res.ok) throw data;

      const emp = data.employee;

      if (isEdit) {
        const tr = document.querySelector(`tr[data-id="${employeeId}"]`);
        if (tr) {
          tr.dataset.first_name = emp.first_name ?? payload.firstName;
          tr.dataset.last_name  = emp.last_name ?? payload.lastName;
          tr.dataset.email      = emp.email ?? payload.email;
          tr.dataset.phone      = emp.phone ?? payload.phone;
          tr.dataset.department = emp.department ?? payload.department;
          tr.dataset.role       = emp.role ?? payload.role;
          tr.dataset.store_area = emp.store_area ?? payload.store;
          tr.dataset.shift      = emp.shift ?? payload.shift;
          tr.dataset.join_date  = emp.join_date ?? payload.joinDate;
          tr.dataset.salary     = emp.salary ?? payload.salary;
          tr.dataset.address    = emp.address ?? payload.address;
          tr.dataset.status     = emp.status ?? payload.status;

          // update visible columns (SR, code, name, dept, store, role, status, actions)
          const tds = tr.querySelectorAll('td');
          if (tds.length >= 7) {
            tds[1].innerText = tr.dataset.employee_code || tds[1].innerText;
            tds[2].innerText = `${tr.dataset.first_name} ${tr.dataset.last_name}`;
            tds[3].innerText = tr.dataset.department;
            tds[4].innerText = tr.dataset.store_area;
            tds[5].innerText = tr.dataset.role;
            tds[6].innerText = tr.dataset.status;
          }
        }
      } else {
        const tbody = document.getElementById('sortable-table');
        const newId = emp.id;

        const newRow = document.createElement('tr');
        newRow.setAttribute('data-id', newId);

        newRow.dataset.employee_code = emp.employee_code ?? emp.id;
        newRow.dataset.first_name = emp.first_name ?? payload.firstName;
        newRow.dataset.last_name  = emp.last_name ?? payload.lastName;
        newRow.dataset.email      = emp.email ?? payload.email;
        newRow.dataset.phone      = emp.phone ?? payload.phone;
        newRow.dataset.department = emp.department ?? payload.department;
        newRow.dataset.role       = emp.role ?? payload.role;
        newRow.dataset.store_area = emp.store_area ?? payload.store;
        newRow.dataset.shift      = emp.shift ?? payload.shift;
        newRow.dataset.join_date  = emp.join_date ?? payload.joinDate;
        newRow.dataset.salary     = emp.salary ?? payload.salary;
        newRow.dataset.address    = emp.address ?? payload.address;
        newRow.dataset.status     = emp.status ?? payload.status;

        newRow.innerHTML = `
          <td><i class="fas fa-bars text-secondary me-2 drag-handle" style="cursor:move"></i> - </td>
          <td><p class="text-xs font-weight-bold mb-0">${newRow.dataset.employee_code}</p></td>
          <td><p class="text-xs font-weight-bold mb-0">${newRow.dataset.first_name} ${newRow.dataset.last_name}</p></td>
          <td><p class="text-xs font-weight-bold mb-0">${newRow.dataset.department}</p></td>
          <td><p class="text-xs font-weight-bold mb-0">${newRow.dataset.store_area}</p></td>
          <td><p class="text-xs font-weight-bold mb-0">${newRow.dataset.role}</p></td>
          <td><p class="text-xs font-weight-bold mb-0">${newRow.dataset.status}</p></td>
          <td>
            <button type="button" class="btn btn-sm btn-warning editEmployeeBtn" data-id="${newId}">
              <i class="fas fa-edit"></i> Edit
            </button>
          </td>
        `;
        tbody.prepend(newRow);
      }

      form.reset();
      document.getElementById('employeeId').value = "";
      setPlaceholders("create");
      closeModal();

      alert(data.message || (isEdit ? "Employee updated." : "Employee added."));
    }
    catch (err) {
      if (err && err.errors) {
        const firstKey = Object.keys(err.errors)[0];
        alert(err.errors[firstKey][0]);
        return;
      }
      console.error(err);
      alert("Server error, please try again.");
    }
  });

});
</script>

<script>
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.copy-employee-link');
    if (!btn) return;

    const link = btn.getAttribute('data-link');

    navigator.clipboard.writeText(link).then(() => {
        alert('Employee view link copied!');
        // console.log(link); // debug ke liye
    }).catch(() => {
        alert('Copy failed!');
    });
});
</script>

@endsection

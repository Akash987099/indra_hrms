@extends('admin.layout.app')

@section('content')
<div class="main-content">
    <div id="employee">
        <div class="card">
            <div class="card-header">
                <h3>Employee Onboarding Data</h3>
            </div>

            <div class="card-body">
              

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
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody id="sortable-table">
@foreach ($employee as $key => $item)
<tr data-id="{{ $item->id }}">

    <td>{{ $employee->firstItem() + $key }}</td>

    <td>
        <strong>{{ $item->id }}</strong>
    </td>

    <td>{{ $item->full_name }}</td>

    <td>{{ $item->department }}</td>

    <td>{{ $item->work_area }}</td>

    <td>{{ $item->designation }}</td>

    <td>
        <span class="badge badge-success">
            {{ $item->employee_type }}
        </span>
    </td>

    <td>
        {{-- @if($item->employee_id == null)
        <a href="{{ route('admin.employee.transfer', $item->id) }}"
           class="btn btn-sm btn-info">
            <i class="fas fa-random"></i> Transfer
        </a>
        @endif --}}
        
        <a href="{{ route('admin.employee.view', $item->id) }}"
           class="btn btn-sm btn-warning">
            <i class="fas fa-eye"></i>
        </a>
        
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

@endsection

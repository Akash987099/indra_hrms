@extends('admin.layout.app')

@section('content')
<div class="main-content">
    <div id="payroll">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="dashboard-cards">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Payroll Summary -
                        <span id="currentMonth">
                            {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y') }}
                        </span>
                    </h3>
                    <i class="fas fa-chart-bar"></i>
                </div>

                <div class="card-body">
                    <div class="payroll-summary">
                        <h2>₹ <span id="totalPayrollAmount">{{ number_format($total, 2) }}</span></h2>
                        <p>Total Monthly Payroll</p>

                        <div style="display:flex; justify-content:space-around; margin-top:20px;">
                            <div>
                                <h4>₹ <span id="processedAmount">{{ number_format($processed, 2) }}</span></h4>
                                <p>Processed</p>
                            </div>
                            <div>
                                <h4>₹ <span id="pendingAmount">{{ number_format($pending, 2) }}</span></h4>
                                <p>Pending</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Process Payroll</h3>
                    <i class="fas fa-calculator"></i>
                </div>

                <div class="card-body">
                    <form id="processPayrollForm" method="POST" action="{{ route('admin.payroll.process') }}">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label for="payrollMonth">Month</label>
                                <input type="month" id="payrollMonth" name="payroll_month"
                                       class="form-control" required value="{{ $month }}">
                            </div>

                            <div class="form-group">
                                <label for="payrollDepartment">Department (Optional)</label>
                                <select id="payrollDepartment" name="department" class="form-control">
                                    <option value="">All Departments</option>
                                    <option value="Retail" {{ $department=='Retail'?'selected':'' }}>Retail</option>
                                    <option value="Housekeeping" {{ $department=='Housekeeping'?'selected':'' }}>Housekeeping</option>
                                    <option value="Security" {{ $department=='Security'?'selected':'' }}>Security</option>
                                    <option value="Management" {{ $department=='Management'?'selected':'' }}>Management</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bonusPercentage">Bonus Percentage (%)</label>
                            <input type="number" id="bonusPercentage" name="bonus_percentage"
                                   class="form-control" value="10" min="0" max="100">
                        </div>

                        <button type="submit" class="btn btn-primary">Process Payroll</button>

                        <button type="button" class="btn btn-success" id="generatePayslipsBtn">
                            Generate Payslips
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card" style="margin-top: 20px;">
            <div class="card-header">
                <h3>Payroll Details</h3>
                <div>
                    <input type="month" id="payrollFilterMonth" class="form-control"
                           style="width:auto; display:inline-block;" value="{{ $month }}">
                    <button type="button" class="btn btn-primary" id="filterPayrollBtn">Filter</button>
                </div>
            </div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Basic Salary</th>
                            <th>Allowances</th>
                            <th>Deductions</th>
                            <th>Net Salary</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="payrollTableBody"></tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@php
    // ✅ Safe JSON variables (NO bracket mismatch)
    $payrollRecords = $payrolls->map(function($p){
        return [
            'id' => $p->id,
            'employeeId' => $p->employee_id,
            'basicSalary' => (float) $p->basic_salary,
            'allowances' => (float) $p->allowances,
            'deductions' => (float) $p->deductions,
            'netSalary' => (float) $p->net_salary,
            'status' => $p->status,
        ];
    })->values();

    $employeesJS = $payrolls->pluck('employee')
        ->filter()
        ->unique('id')
        ->values()
        ->map(function($e){
            return [
                'id' => $e->id,
                'firstName' => $e->first_name,
                'lastName' => $e->last_name,
            ];
        })->values();
@endphp

<script>
    window.payrollRecords = @json($payrollRecords);
    window.employees = @json($employeesJS);
</script>

<script>
(function () {

    function renderPayrollTable(records) {
        const tbody = document.getElementById('payrollTableBody');
        if (!tbody) return;

        tbody.innerHTML = '';

        (records || []).forEach(record => {
            const employee = (window.employees || []).find(emp => Number(emp.id) === Number(record.employeeId));
            if (!employee) return;

            let statusColor = '#000';
            switch (record.status) {
                case 'Processed': statusColor = '#28a745'; break;
                case 'Pending': statusColor = '#ffc107'; break;
                case 'On Hold': statusColor = '#6c757d'; break;
            }

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${employee.id}</td>
                <td>${employee.firstName ?? ''} ${employee.lastName ?? ''}</td>
                <td>₹${Number(record.basicSalary || 0).toLocaleString('en-IN')}</td>
                <td>₹${Number(record.allowances || 0).toLocaleString('en-IN')}</td>
                <td>₹${Number(record.deductions || 0).toLocaleString('en-IN')}</td>
                <td><strong>₹${Number(record.netSalary || 0).toLocaleString('en-IN')}</strong></td>
                <td><span style="color:${statusColor}; font-weight:bold;">${record.status}</span></td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm view-payslip" data-id="${record.id}">
                        <i class="fas fa-file-invoice"></i>
                    </button>
                    ${
                        record.status === 'Pending'
                        ? `<button type="button" class="btn btn-success btn-sm process-payment" data-id="${record.id}" style="margin-left:5px;">
                                <i class="fas fa-check"></i>
                           </button>`
                        : ''
                    }
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {

        renderPayrollTable(window.payrollRecords || []);

        const filterBtn = document.getElementById('filterPayrollBtn');
        if (filterBtn) {
            filterBtn.addEventListener('click', function () {
                const month = document.getElementById('payrollFilterMonth').value;
                if (!month) return alert('Please select month');

                const url = new URL("{{ route('admin.payroll.index') }}", window.location.origin);
                url.searchParams.set('month', month);
                window.location.href = url.toString();
            });
        }

        const payslipBtn = document.getElementById('generatePayslipsBtn');
        if (payslipBtn) {
            payslipBtn.addEventListener('click', function () {
                const month = document.getElementById('payrollMonth').value;
                const dept = document.getElementById('payrollDepartment').value;

                if (!month) return alert('Please select month');

                const url = new URL("{{ route('admin.payroll.payslips') }}", window.location.origin);
                url.searchParams.set('month', month);
                if (dept) url.searchParams.set('department', dept);

                window.location.href = url.toString();
            });
        }

        const tbody = document.getElementById('payrollTableBody');
        if (tbody) {
            tbody.addEventListener('click', function (e) {
                const viewBtn = e.target.closest('.view-payslip');
                if (viewBtn) {
                    const id = viewBtn.dataset.id;
                    alert('View payslip for payroll id: ' + id);
                    return;
                }

                const processBtn = e.target.closest('.process-payment');
                if (processBtn) {
                    const id = processBtn.dataset.id;
                    alert('Process payment for payroll id: ' + id);
                    return;
                }
            });
        }
    });

})();
</script>

@endsection
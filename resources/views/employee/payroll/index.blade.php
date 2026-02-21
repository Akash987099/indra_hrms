@extends('employee.layout.app')

@section('content')

<div>
    <div class="section-card">
        <h2 class="section-title">Payroll Information</h2>

        <!-- DASHBOARD -->
        <div class="dashboard-cards mb-4">

            <div class="card">
                <h5>Current Salary</h5>
                <h3>₹{{ number_format($currentSalary ?? 0) }}</h3>
                <p>Monthly</p>
            </div>

            <div class="card">
                <h5>YTD Earnings</h5>
                <h3>₹{{ number_format($ytdEarnings) }}</h3>
                <p>Year to Date</p>
            </div>

            <div class="card">
                <h5>Tax Paid</h5>
                <h3>₹{{ number_format($taxPaid) }}</h3>
                <p>YTD</p>
            </div>

            <div class="card">
                <h5>Next Payday</h5>
                <h3>{{ $nextPayday }}</h3>
                <p>Estimated: ₹{{ number_format($currentSalary ?? 0) }}</p>
            </div>

        </div>

        <!-- TABLE -->
        <h4 class="mb-3">Payslip History</h4>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Month</th>
                        <th>Payment Date</th>
                        <th>Basic Salary</th>
                        <th>Allowances</th>
                        <th>Deductions</th>
                        <th>Net Salary</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($payrolls as $payroll)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($payroll->payroll_month)->format('M Y') }}
                            </td>

                            <td>
                                {{ $payroll->processed_at 
                                    ? \Carbon\Carbon::parse($payroll->processed_at)->format('d M Y') 
                                    : '-' }}
                            </td>

                            <td>₹{{ number_format($payroll->basic_salary) }}</td>
                            <td>₹{{ number_format($payroll->allowances) }}</td>
                            <td>₹{{ number_format($payroll->deductions) }}</td>
                            <td><strong>₹{{ number_format($payroll->net_salary) }}</strong></td>

                            <td>
                                <span class="badge 
                                    {{ $payroll->status == 'Paid' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $payroll->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No Payroll Data Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="d-flex justify-content-end">
            {{ $payrolls->links() }}
        </div>

    </div>
</div>

@endsection
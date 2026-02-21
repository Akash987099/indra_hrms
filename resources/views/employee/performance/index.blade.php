@extends('employee.layout.app')

@section('content')

<div>
    <div class="section-card">
        <h2 class="section-title">Performance Management</h2>

        <!-- DASHBOARD -->
        <div class="dashboard-cards mb-4">

            <div class="card">
                <h5>Current Rating</h5>
                <h3>{{ $performance->rating ?? 0 }}</h3>
                <p>Out of 5.0</p>
            </div>

            <div class="card">
                <h5>Goals Completed</h5>
                <h3>{{ $kpis->count() }}/10</h3>
                <p>This Quarter</p>
            </div>

            <div class="card">
                <h5>Next Review</h5>
                <h3>{{ \Carbon\Carbon::now()->addMonth()->format('d M') }}</h3>
                <p>Quarterly Review</p>
            </div>

            <div class="card">
                <h5>Overall Score</h5>
                <h3>{{ $performance->overall_score ?? 0 }}</h3>
                <p>Average</p>
            </div>

        </div>

        <!-- KPI SECTION -->
        <h4 class="mb-3">Key Performance Indicators</h4>

        @foreach($kpis as $kpi)
            <div class="mb-3">
                <label>{{ $kpi->quarter }}</label>

                <div class="progress" style="height:20px;">
                    <div class="progress-bar bg-success"
                        style="width: {{ $kpi->target }}%;">
                        {{ $kpi->target }}%
                    </div>
                </div>

                <small>Deadline: {{ $kpi->deadline }}</small>
            </div>
        @endforeach

        <!-- REVIEWS TABLE -->
        <h4 class="mt-4">Recent Appraisals</h4>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Review Period</th>
                        <th>Rating</th>
                        <th>Score</th>
                        <th>Attendance %</th>
                        <th>Task Completion</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($review->created_at)->format('M Y') }}</td>

                            <td>
                                <span class="badge bg-success">
                                    {{ $review->rating }}
                                </span>
                            </td>

                            <td>{{ $review->overall_score }}</td>
                            <td>{{ $review->attendance_percent }}%</td>
                            <td>{{ $review->task_completion }}%</td>

                            <td>
                                {{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No Performance Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="d-flex justify-content-end">
            {{ $reviews->links() }}
        </div>

    </div>
</div>

@endsection
@extends('employee.layout.app')

@section('content')
    <div>
        <div class="section-card">
            <h2 class="section-title">Training & Development</h2>

            <div class="dashboard-cards" style="margin-bottom: 30px;">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Completed</h3>
                    </div>
                    <div class="card-value">12</div>
                    <p class="card-desc">Trainings</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">In Progress</h3>
                    </div>
                    <div class="card-value">3</div>
                    <p class="card-desc">Trainings</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Certificates</h3>
                    </div>
                    <div class="card-value">8</div>
                    <p class="card-desc">Earned</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Required</h3>
                    </div>
                    <div class="card-value">2</div>
                    <p class="card-desc">Mandatory Trainings</p>
                </div>
            </div>

            <h3 style="margin-bottom: 20px;">Available Trainings</h3>
            <div class="training-cards" style="margin-bottom: 30px;" id="availableTrainings">
                <!-- Filled by JavaScript -->
            </div>

            <h3 style="margin-bottom: 20px;">My Training History</h3>
            <table>
                <thead>
                    <tr>
                        <th>Training Name</th>
                        <th>Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Score</th>
                        <th>Certificate</th>
                    </tr>
                </thead>
                <tbody id="trainingHistoryTable">
                    <!-- Filled by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
@endsection

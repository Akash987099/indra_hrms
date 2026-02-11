@extends('admin.layout.app')

@section('content')
    <div class="main-content">
        <div id="performance" class="">
            <div class="dashboard-cards">
                <div class="card">
                    <div class="card-header">
                        <h3>Performance Dashboard</h3>
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="performanceChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Set KPI Targets</h3>
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <div class="card-body">
                        <form id="kpiForm">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="kpiEmployee">Employee</label>
                                    <select id="kpiEmployee" class="form-control" required>
                                        <option value="">Select Employee</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kpiQuarter">Quarter</label>
                                    <select id="kpiQuarter" class="form-control" required>
                                        <option value="Q1">Q1 (Jan-Mar)</option>
                                        <option value="Q2">Q2 (Apr-Jun)</option>
                                        <option value="Q3">Q3 (Jul-Sep)</option>
                                        <option value="Q4">Q4 (Oct-Dec)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kpiTarget">Target Description</label>
                                <textarea id="kpiTarget" class="form-control" rows="2" placeholder="Describe the KPI target..." required></textarea>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="kpiWeightage">Weightage (%)</label>
                                    <input type="number" id="kpiWeightage" class="form-control" min="1"
                                        max="100" required>
                                </div>
                                <div class="form-group">
                                    <label for="kpiDeadline">Deadline</label>
                                    <input type="date" id="kpiDeadline" class="form-control" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Set KPI</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-top: 20px;">
                <div class="card-header">
                    <h3>Employee Performance</h3>
                    <div>
                        <select id="performanceDepartmentFilter" class="form-control"
                            style="width: auto; display: inline-block;">
                            <option value="">All Departments</option>
                            <option value="Retail">Retail</option>
                            <option value="Housekeeping">Housekeeping</option>
                            <option value="Security">Security</option>
                            <option value="Management">Management</option>
                        </select>
                        <button class="btn btn-primary" id="filterPerformanceBtn">Filter</button>
                    </div>
                </div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Department</th>
                                <th>Attendance %</th>
                                <th>Task Completion</th>
                                <th>Customer Rating</th>
                                <th>Overall Score</th>
                                <th>Rating</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="performanceTableBody">
                            <!-- Performance data will be loaded here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const employees = @json($employees);

            // Employee dropdown
            employees.forEach(emp => {
                document.getElementById('kpiEmployee').innerHTML +=
                    `<option value="${emp.id}">${emp.first_name} (${emp.department})</option>`;
            });

            // KPI submit
            document.getElementById('kpiForm').addEventListener('submit', e => {
                e.preventDefault();

                fetch("{{ route('admin.performance.kpi.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            employee_id: kpiEmployee.value,
                            quarter: kpiQuarter.value,
                            target: kpiTarget.value,
                            weightage: kpiWeightage.value,
                            deadline: kpiDeadline.value
                        })
                    })
                    .then(res => res.json())
                    .then(() => alert('KPI Set Successfully'));
            });

            // Load performance table
            function loadPerformance(dept = '') {
                fetch(`{{ route('admin.performance.data') }}?department=${dept}`)
                    .then(res => res.json())
                    .then(data => {
                        let html = '';
                        data.forEach(p => {
                            html += `
            <tr>
                <td>${p.employee.first_name}</td>
                <td>${p.employee.department}</td>
                <td>${p.attendance_percent}%</td>
                <td>${p.task_completion}%</td>
                <td>${p.customer_rating}</td>
                <td>${p.overall_score}</td>
                <td>${p.rating}</td>
                <td>-</td>
            </tr>`;
                        });
                        performanceTableBody.innerHTML = html;
                        drawChart(data);
                    });
            }

            document.getElementById('filterPerformanceBtn').onclick = () => {
                loadPerformance(performanceDepartmentFilter.value);
            };

            // Chart
            let chart;

            function drawChart(data) {
                const ctx = document.getElementById('performanceChart');
                const labels = data.map(d => d.employee.first_name);
                const scores = data.map(d => d.overall_score);

                if (chart) chart.destroy();

                chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels,
                        datasets: [{
                            label: 'Performance Score',
                            data: scores,
                            backgroundColor: '#4f46e5'
                        }]
                    }
                });
            }

            loadPerformance();
        </script>
    @endsection

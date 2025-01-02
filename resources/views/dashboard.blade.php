@extends('layouts.container')

@section('title', 'Dashboard')

@section('page_js')
    <script src="{!! asset('js/apexcharts.js') !!}"></script>
    <script type="text/javascript" nonce="{{ csp_nonce() }}">
        $(document).ready(function() {
            $('#navbarVerticalMenu').find('#dashboard').addClass('active');

            // Example chart initialization
            const options = {
                chart: {
                    type: 'pie',
                },
                series: [44, 55, 13, 43],
                labels: ['Completed', 'In Progress', 'Pending', 'Overdue']
            };
            const chart = new ApexCharts(document.querySelector("#tasks_overview_chart"), options);
            chart.render();
        });
    </script>
@endsection

@section('page-content')

<div class="container-fluid p-0">
    <div class="pb-3 mb-3 border-bottom">
        <div class="d-flex align-items-center">
            <div class="brd-crms flex-grow-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                    </ol>
                </nav>
                <h4 class="m-0 lh1 mt-1 fs-6 text-uppercase fw-bold text-primary">@yield('title')</h4>
            </div>
        </div>
    </div>

    <div class="welcome-page">
        <!-- Tasks Overview -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header fw-bold">
                        Tasks Overview
                    </div>
                    <div class="card-body">
                        <div id="tasks_overview_chart"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header fw-bold">
                        Quick Stats
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total Tasks
                                <span class="badge bg-primary rounded-pill">120</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Completed Tasks
                                <span class="badge bg-success rounded-pill">80</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Pending Tasks
                                <span class="badge bg-warning rounded-pill">30</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Overdue Tasks
                                <span class="badge bg-danger rounded-pill">10</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Deadlines -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header fw-bold">
                        Upcoming Deadlines
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th>Priority</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Finish Project Report</td>
                                    <td><span class="badge bg-danger">High</span></td>
                                    <td>Jan 10, 2025</td>
                                    <td>In Progress</td>
                                </tr>
                                <tr>
                                    <td>Team Meeting</td>
                                    <td><span class="badge bg-warning">Medium</span></td>
                                    <td>Jan 15, 2025</td>
                                    <td>Pending</td>
                                </tr>
                                <tr>
                                    <td>Submit Tax Documents</td>
                                    <td><span class="badge bg-success">Low</span></td>
                                    <td>Jan 20, 2025</td>
                                    <td>Pending</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Personal Notes -->
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header fw-bold">
                        Personal Notes
                    </div>
                    <div class="card-body">
                        <textarea class="form-control" rows="5" placeholder="Write your notes here..."></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

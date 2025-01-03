@extends('layouts.container')

@section('title', 'Dashboard')

@section('page_js')
    <script src="{!! asset('js/apexcharts.js') !!}"></script>
    <script type="text/javascript" nonce="{{ csp_nonce() }}">
        document.addEventListener('DOMContentLoaded', function(e) {
            $('#navbarVerticalMenu').find('#dashboard-menu').addClass('active');

            const options = {
                chart: {
                    type: 'pie',
                },
                series: [
                    {{ $quickStat->completed_tasks }},
                    {{ $quickStat->in_progress_tasks }},
                    {{ $quickStat->pending_tasks }},
                    {{ $quickStat->overdue_tasks }}
                ],
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
                                    <span class="badge bg-primary rounded-pill">{{ $quickStat->total_tasks }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Completed Tasks
                                    <span class="badge bg-success rounded-pill">{{ $quickStat->completed_tasks }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Pending Tasks
                                    <span class="badge bg-warning rounded-pill">{{ $quickStat->pending_tasks }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    In Progress Tasks
                                    <span class="badge bg-info rounded-pill">{{ $quickStat->in_progress_tasks }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Overdue Tasks
                                    <span class="badge bg-danger rounded-pill">{{ $quickStat->overdue_tasks }}</span>
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
                                    @foreach ($upcomingTasks as $task)
                                    <tr>
                                        <td>{{ $task->title }}</td>
                                        <td>
                                            <span class="badge
                                                {{ $task->priority == 'high' ? 'bg-danger' :
                                                   ($task->priority == 'medium' ? 'bg-warning' : 'bg-success') }}">
                                                {{ ucfirst($task->priority) }}
                                            </span>
                                        </td>
                                        <td>{{ $task->due_date->format('M d, Y') }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $task->status)) }}</td>
                                    </tr>
                                @endforeach
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

@extends('layouts.container')

@section('title', 'Dashboard')

@section('page_js')
    <script src="{!! asset('js/apexcharts.js') !!}"></script>
    <script type="text/javascript" nonce="">
        $(document).ready(function() {
            $('#navbarVerticalMenu').find('#dashboard').addClass('active');
        });
    </script>
@endsection

@section('page-content')

    <div class="container-fluid p-0">
        <div class=" pb-3 mb-3 border-bottom">
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
            {{-- <div class="row" id="dashboard_chart_filter_office_wise">
                <div class="col-12 col-md-6">
                    <div class="dashboard-pie">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header border-0 fw-bold">
                                Approved Budget
                            </div>
                            <div class="card-body">
                                <div class="box">
                                    <div class="box-body">
                                        <div id="approved_budget_pie_chart" class="center-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row" id="dashboard_chart_filter_office_wise">
                <div class="col-12 col-md-6">
                    <div class="dashboard-charts">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header border-0 fw-bold">
                                Office Wise Budget
                            </div>

                            <div class="card-body">
                                <div class="" id="office_wise_budget_bar_chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="dashboard-charts">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header border-0 fw-bold">
                                Office Wise Expense
                            </div>
                            <div class="card-body">
                                <div id="office_wise_budget_expense_chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@stop

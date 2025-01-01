@extends('layouts.container-error')

@section('title', '404 Page not found')

@section('page-content')

    <!-- Main content -->
    <div class="content body">
        <section id="introduction">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <img src="{{ asset('img/404.png') }}" alt="" style="width: 500px;">
                    </div>
                    <div class="col-lg-6">
                        <div class="text-warning display-2 fw-bold">404</div>
                        <div class="h2 fw-bold">Page Not Found</div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="panel-body">
                                            <p><strong> An error has occurred while processing your request.</strong></p>
                                            <p>We could not find the link or the document you are looking for in TODO Application.</p>
                                            <p>It is temporarily unavailable or does not exist. Contact your system administrator for further assistance.</p>
                                            <a class="btn btn-warning rounded-4" href="{!! route('dashboard.index') !!}">Back to home</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

@stop

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">
    <link rel="stylesheet" href="{{ asset('stylesheets/style.css' . '?v=' . time()) }}">
    <style>
        .boolean_display {
            display: none;
        }
    </style>
    @yield('page_css')
</head>
<div class="preloader">
    <div class="cube-wrapper">
        <div class="mb-4"><img src="{{ asset('img/slogo.png') }}" class="w-25" alt=""></div>
        <div class="cube-folding">
            <span class="leaf1"></span>
            <span class="leaf2"></span>
            <span class="leaf3"></span>
            <span class="leaf4"></span>
        </div>
        <span class="loading" data-name="Loading">Loading</span>
    </div>
</div>

<body class="position-relative">
    <div class="pre-laoder d-none">
        <div class="gap-3 -logo d-flex align-items-center justify-content-center flex-column">
            <img src="{{ asset('img/logonp.png') }}" alt="">
            <div class="loader"></div>
            <h6 class="fs-6 text-uppercase text-primary">Loading</h6>

        </div>
    </div>
    @include('layouts.sidebar')
    <main class="pb-4 m-left">
        @include('layouts.header')
        <div class="p-4 m-content">
            @yield('page-content')
        </div>
        @include('layouts.footer')
    </main>

    <div class="modal fade" id="openModal" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="openModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="border-0 modal-content">
            </div>
        </div>
    </div>

    <div class="modal fade" id="openSmallModal" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="openModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="border-0 modal-content">
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>s
    <script type="text/javascript" nonce="{{ csp_nonce() }}">
        const displayTime = document.querySelector(".display-time");
        // Time
        function showTime() {
            let time = new Date();
            displayTime.innerText = time.toLocaleTimeString("en-US", {
                hour12: false
            });
            setTimeout(showTime, 1000);
        }

        showTime();

        // Date
        function updateDate() {
            let today = new Date();

            // return number
            let dayName = today.getDay(),
                dayNum = today.getDate(),
                month = today.getMonth(),
                year = today.getFullYear();

            const months = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ];
            const dayWeek = [
                "Sunday",
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
            ];
            // value -> ID of the html element
            const IDCollection = ["day", "daynum", "month", "year"];
            // return value array with number as a index
            const val = [dayWeek[dayName], dayNum, months[month], year];
            for (let i = 0; i < IDCollection.length; i++) {
                document.getElementById(IDCollection[i]).firstChild.nodeValue = val[i];
            }
        }

        updateDate();
    </script>
    @php

        $message = $title = $colorQuote = '';
        if (session('error_message')) {
            $message = session('error_message');
            $title = 'Error';
            $colorQuote = 'error';
        }
        if (session('warning_message')) {
            $message = session('warning_message');
            $title = 'Warning';
            $colorQuote = 'warning';
        }
        if (session('success_message')) {
            $message = session('success_message');
            $title = 'Success';
            $colorQuote = 'success';
        }
    @endphp
    <script type="text/javascript" nonce="{{ csp_nonce() }}">
        var baseUrl = '{!! url('') !!}';
        const navContainer = ($('.navbar-vertical-content'));
        const vatPercentage = '{!! config('constant.VAT_PERCENTAGE') !!}';
        const tdsPercentage = '{!! config('constant.TDS_PERCENTAGE') !!}';
        const vatTdsPercentage = '{!! config('constant.VAT_TDS_PERCENTAGE') !!}';

        $(".select2").select2({
            width: '100%',
            dropdownAutoWidth: true
        });
        $(document).ready(function() {
            $('[data-toggle="datepicker"]').datepicker({
                language: 'en-GB',
                autoHide: true,
                format: 'yyyy-mm-dd',
            });
        });

        $('.select2').trigger("change");
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            beforeSend: function(xhr) {
                xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
            }
        });

        $(document).on('click', '.open-modal-form', function(e) {
            e.preventDefault();
            console.log(e);
            $('#openModal').modal('show').find('.modal-content').load($(this).attr('href'));
        });

        var showErrorMessageInSweatAlert = function(e) {
            console.log(e);
            var errors = e.responseJSON;
            var errorMessage = 'Something went wrong!<br />';
            if (errors != undefined && Object.keys(errors).length > 0) {
                if (errors.hasOwnProperty("message") && errors.hasOwnProperty('trace')) {
                    errorMessage += 'It seems data error. Please contact your system administrator.';
                } else {
                    if (errors.hasOwnProperty('errors')) {
                        $.each(errors, function(index, error) {
                            if (typeof(error) !== "string") {
                                $.each(error, function(index, val) {
                                    errorMessage += val + "<br />";
                                });
                            }
                        });
                    } else {
                        $.each(errors, function(index, error) {
                            if (typeof(error) === "string") {
                                errorMessage += error == 'error' ? '' : error + "<br />";
                            }
                        });
                    }
                }
            }
            console.log(e);
            Swal.fire("Oops...", errorMessage, "error");
        };

        function ajaxDeleteSweetAlert(url, data = {}, successCallback = '', errorCallback = '', alertText = null) {
            Swal.fire({
                title: 'Are you sure you want to delete?',
                text: alertText ? alertText : "You won't be able to revert this.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: data,
                        dataType: 'json',
                        success: function(response) {
                            if (successCallback) {
                                successCallback(response);
                            }
                            return;
                        },
                        error: function(err) {
                            if (!errorCallback) {
                                showErrorMessageInSweatAlert(err);
                            } else {
                                errorCallback(err);
                            }
                            return;
                        }
                    });
                }
            });
        }

        function ajaxMasterRecordDelete($object, oTable) {
            var $url = $object.attr('data-href');
            var $data = $object.attr('data-object');
            var $alertText = $object.attr('data-description');
            var successCallback = function(response) {
                toastr.success(response.message, 'Success', {
                    timeOut: 5000
                });
                oTable.ajax.reload(null, false);
            }
            ajaxDeleteSweetAlert($url, $data, successCallback, '', $alertText);
        }

        function ajaxBudgetRecordStageForwardBackward($object, oTable = null, successCallback = null) {
            var $url = $object.attr('data-href');
            var $data = $object.attr('data-object');
            var $alertText = $object.attr('data-description');
            if (!successCallback) {
                var successCallback = function(response) {
                    toastr.success(response.message, 'Success', {
                        timeOut: 5000
                    });
                    if (oTable) {
                        oTable.ajax.reload(null, false);
                    } else {
                        location.reload();
                    }
                }
            }
            return ajaxSweetAlert($url, 'POST', $data, $alertText, successCallback);
        }

        function ajaxBudgetRecordStageForwardAll($object, oTable = null) {
            var $url = $object.attr('data-href');
            var $alertText = $object.attr('data-description');
            var successCallback = function(response) {
                toastr.success(response.message, 'Success', {
                    timeOut: 5000
                });
                if (oTable) {
                    oTable.ajax.reload(null, false);
                } else {
                    location.reload();
                }
            }
            ajaxSweetAlert($url, 'POST', {}, $alertText, successCallback);
        }

        function ajaxSubmitSweetAlert(url, successCallback = '', errorCallback = '') {
            Swal.fire({
                title: 'Are you sure to submit?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Submit it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "get",
                        url: url,
                        dataType: 'json',
                        success: function(response) {
                            if (successCallback) {
                                successCallback(response);
                            } else {
                                location.reload(true);
                            }
                        },
                        error: function(err) {
                            if (!errorCallback) {
                                showErrorMessageInSweatAlert(err);
                            } else {
                                errorCallback(err);
                            }
                            return;
                        }
                    });
                }
            });
        }

        function ajaxSweetAlert(url, type = 'POST', data = {}, confirmText = '', successCallback = '', errorCallback = '') {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmText
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: type,
                        url: url,
                        data: data,
                        dataType: 'json',
                        success: function(response) {
                            if (successCallback) {
                                successCallback(response);
                            }
                            return;
                        },
                        error: function(err) {
                            if (!errorCallback) {
                                showErrorMessageInSweatAlert(err);
                            } else {
                                errorCallback(err);
                            }
                            return;
                        }
                    });
                }
            });
        }

        function ajaxSubmit(url, type = 'POST', data = {}, successCallback = '', errorCallback = '') {
            $.ajax({
                type: type,
                url: url,
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (successCallback) {
                        successCallback(response);
                    }
                    return;
                },
                error: function(err) {
                    if (!errorCallback) {
                        showErrorMessageInSweatAlert(err);
                    } else {
                        errorCallback(err);
                    }
                    return;
                }
            });
        }

        function ajaxSubmitFormData(url, type = 'POST', data = {}, successCallback = '', errorCallback = '') {
            $.ajax({
                type: type,
                url: url,
                data: data,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (successCallback) {
                        successCallback(response);
                    }
                    return;
                },
                error: function(err) {
                    if (!errorCallback) {
                        showErrorMessageInSweatAlert(err);
                    } else {
                        errorCallback(err);
                    }
                    return;
                }
            });
        }

        function ajaxNativeSubmit(url, type = 'POST', data = {}, dataType = 'json', successCallback = '', errorCallback =
            '') {
            document.querySelector(".preloader").style.display = "block";
            $.ajax({
                type: type,
                url: url,
                data: data,
                dataType: dataType,
                success: function(response) {
                    document.querySelector(".preloader").style.display = "none";
                    if (successCallback) {
                        successCallback(response);
                    }

                    return;
                },
                error: function(err) {
                    document.querySelector(".preloader").style.display = "none";
                    if (errorCallback) {
                        errorCallback(err);
                    }
                    return;
                }
            });
        }

        function submitSweetAlert($url) {
            Swal.fire({
                icon: 'question',
                text: "Are you sure you want to submit your worklog to your supervisor?",
                type: 'warning',
                buttons: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit it!',
            }).then((result) => {
                if (result.value) {
                    window.location.href = $url;
                }
            });
        }

        toastr.options.closeButton = true;
        toastr.options.closeDuration = 0;
        @if ($message && $title)
            Command: toastr["{{ $colorQuote }}"]("{{ $message }}", "{{ $title }}")

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "3000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        @endif
    </script>


    @yield('page_js')
    @stack('scripts')
    <script type="text/javascript" nonce="{{ csp_nonce() }}">
        $(document).ready(function() {
            $obj = $('#navbarVerticalMenu').find('.active');
            $obj.closest('.nav-item').addClass('active');
            $obj.closest('.nav-item').find('div').first().addClass('show');
            $obj.closest('.nav-item').find('a').first().attr('aria-expanded', 'true');

            activeNavPos = $obj.closest('.nav-item').find('a').first()?.position()?.top;
            navContainer.scrollTop(activeNavPos - 100);
        });

        $('.t-ggle').click(function(e) {
            e.preventDefault();
            $('.navbar-vertical-fixed').toggleClass('sidebar-small');
            $('.m-left').toggleClass('sidebar-small');
            $('.s-logo').toggleClass('d-none');
            $('.l-logo').toggleClass('d-none');
            $('.navbar-vertical-fixed').find('.div').removeClass('show');

        });

        //after window is loaded completely
        window.onload = function() {
            document.querySelector(".preloader").style.display = "none";
        }

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>
</body>

</html>

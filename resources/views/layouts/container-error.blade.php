<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/to-do.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">
    <link rel="stylesheet" href="{{ asset('stylesheets/style.min.css' . '?v=' . time()) }}">
    <style>
        .boolean_display {
            display: none;
        }
    </style>
    @yield('page_css')
</head>

<body class="position-relative">
<aside class="navbar-vertical-fixed border-end bg-white hidden-print">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
            <a href="{{ route('dashboard.index') }}"
               class="branding-section d-flex align-items-center justify-content-center mb-3 p-1">
                <img src="{{ asset('img/to-do.png') }}" class="l-logo " alt="">
                <img src="{{ asset('img/to-do.png') }}" class="s-logo d-none" alt="">
            </a>
        </div>
    </div>

    <div class="position-absolute t-ggle"><i class="bi bi-list"></i></div>
</aside>
<main class="m-left">
    <header
        class="border-bottom d-flex align-items-center justify-content-between w-100 p-3 hidden-print bg-warning position-sticky top-0">
        <div class="date-time ps-5">
            <div class="display-date text-dark">
                <span id="day">day</span>,
                <span id="daynum">00</span>
                <span id="month">month</span>
                <span id="year">0000</span>
                <span class="display-time"></span>
            </div>
        </div>
        <ul class="list-unstyled list-inline m-0">
            {{-- <li class="list-inline-item"><a href="#"><i class="bi-plus"></i></a></li> --}}
            <li class="list-inline-item">
                <div class="dropdown me-3">
                    <span class="dropdown-toggle text-white" type="button" id="dropdownMenuButton1"
                          data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi-person text-dark "></i>
                    </span>
                    <ul class="dropdown-menu dropdown-menu-end p-0 py-2 shadow-sm border-0"
                        aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="nav-link fs-7 fw-bold text-primary px-3" href="#">Welcome!</a>
                        </li>
                        <li><a class="dropdown-item fs-6" href="{{ url('logout') }}"><i class="bi-power me-2"></i>
                                Logout</a>
                        </li>
                    </ul>

                </div>
            </li>
        </ul>
    </header>

    <div class="m-content p-4">
        @yield('page-content')
    </div>
    <footer>
        <div class="d-flex">
            <small class="flex-grow-1">Copyright {!! date('Y') !!}, All Rights Reserved.</small>
            <small>Developed By: Modern Tech</small>
        </div>
    </footer>

</main>


<script src="{{ asset('js/app.js') }}"></script>

<script>
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
</body>
</html>

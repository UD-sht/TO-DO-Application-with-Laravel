@php $authUser = auth()->user() @endphp
<header
    class="top-0 p-3 border-bottom d-flex align-items-center justify-content-between w-100 hidden-print bg-warning position-sticky">
    <div class="date-time ps-5">
        <div class="display-date text-dark">
            <span id="day">day</span>,
            <span id="daynum">00</span>
            <span id="month">month</span>
            <span id="year">0000</span>
            <span class="display-time"></span>
        </div>
    </div>
    <ul class="m-0 list-unstyled list-inline">
        {{-- <li class="list-inline-item"><a href="#"><i class="bi-plus"></i></a></li> --}}
        <li class="list-inline-item i-noftif has-notification">
            <div class="dropdown">
                <span class="dropdown-toggle position-relative" type="button" id="notification"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi-bell"></i>
                    @if ($notificationCount)
                        <span class="text-white bg-danger fs-6 position-absolute n-count">
                            {{ $notificationCount }}
                        </span>
                    @endif
                </span>
                <ul class="p-0 m-0 border-0 shadow-sm dropdown-menu dropdown-menu-end is-notification"
                    aria-labelledby="notification">
                    @foreach ($notifications as $notification)
                        <li class="p-2 is-leave is-new position-relative">
                            <div class="gap-2 d-flex">
                                <div
                                    class="overflow-hidden bg-white not-user-icon d-flex align-items-center justify-content-center rounded-circle">
                                    <i class="bi-person"></i>
                                </div>
                                <div class="not-info">
                                    <span>{{ $notification->data['subject'] }}</span>
                                    <span class="d-block text-black-50">
                                        <strong>{{ $notification->created_at->diffForHumans() }}</strong>
                                    </span>
                                </div>
                            </div>
                            {{--                                <a href="{{ $notification->data['link'] }}" class="stretched-link"></a> --}}
                            <a href="{{ route('notifications.show', $notification->id) }}" class="stretched-link"></a>
                        </li>
                    @endforeach
                    <li class="p-1 text-center"><a class="text-decoration-none fs-7 text-dark"
                            href="{{ route('notifications.index') }}"><i class=""></i> View All</a></li>
                </ul>
            </div>
        </li>

        <li class="list-inline-item">
            <div class="dropdown me-3">
                <span class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi-person text-dark"></i>{!! $authUser ? $authUser->user_code : '' !!}

                </span>
                <ul class="p-0 py-2 border-0 shadow-sm dropdown-menu dropdown-menu-end"
                    aria-labelledby="dropdownMenuButton1">
                    {{-- <li><a class="dropdown-item fs-6" href="#"><i class="bi-person"></i> --}}
                    {{-- Profile</a></li> --}}
                    <li>
                        <a class="px-3 nav-link fs-7 fw-bold text-warning" href="#">Welcome!</a>
                    </li>
                    <li>
                        <a class="dropdown-item fs-6 text-dark" href="#"><i class="bi-gear-fill me-2"></i>
                            {!! $authUser ? $authUser->full_name : '' !!}
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item fs-6 text-dark" href="{!! route('change.password.create') !!}"><i
                                class="bi-lock me-2"></i>
                            Change Password
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item fs-6 text-dark" href="{{ url('logout') }}"><i class="bi-power me-2"></i>
                            Logout
                        </a>
                    </li>
                </ul>

            </div>
        </li>
    </ul>
</header>

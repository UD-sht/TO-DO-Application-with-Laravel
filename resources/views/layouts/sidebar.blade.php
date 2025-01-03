@php $authUser = auth()->user(); @endphp
<aside class="bg-white navbar-vertical-fixed border-end hidden-print">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
            <a href="{{ route('dashboard.index') }}"
                class="p-1 mb-3 branding-section d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/to-do.png') }}" class="l-logo" alt="">
                <img src="{{ asset('img/to-do.png') }}" class="s-logo d-none" alt="">
            </a>
            @if ($authUser)
                <div class="navbar-vertical-content">
                    <div id="navbarVerticalMenu" class="nav nav-vertical card-navbar-nav nav-tabs flex-column d-block">
                        <div class="nav-item">
                            <a href="{{ route('dashboard.index') }}" class="nav-link" id="dashboard-menu">
                                <i class="bi bi-house nav-icon"></i>Home
                            </a>
                        </div>
                        <div class="nav-item border-bottom">
                            <a class="nav-link" href="{{ route('todo.index') }}"
                                    id="task-schedule-menu">
                                    <i class="bi bi-columns-gap nav-icon"></i>Add Task</a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" href="{{ route('profile.index') }}"
                                    id="profile-menu">
                                    <i class="bi bi-person nav-icon"></i>Profile</a>
                        </div>
                        {{-- <div class="nav-item">
                             <a class="nav-link dropdown-toggle" href="#navbarTaskScheduleMenuName" role="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarTaskScheduleMenuName"
                                aria-expanded="false" aria-controls="navbarTaskScheduleMenuName"
                                data-bs-toggle="tooltip" data-bs-placement="right" title="Task Schedule">
                                <i class="bi bi-columns-gap nav-icon"></i>
                                <span class="nav-link-title">Task Schedule</span></span>
                            </a>
                            <div id="navbarTaskScheduleMenuName" class="nav-collapse collapse"
                                data-bs-parent="#navbarTaskScheduleMenu"
                                hs-parent-area="#navbarTaskScheduleMenu">

                                <a class="nav-link" href=""
                                    id="task-schedule-menu">
                                    <i class="bi bi-distribute-vertical nav-icon"></i>Add Task</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="position-absolute t-ggle"><i class="bi bi-list"></i></div>
</aside>

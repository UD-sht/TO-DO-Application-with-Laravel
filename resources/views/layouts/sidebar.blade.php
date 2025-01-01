@php $authUser = auth()->user(); @endphp
<aside class="bg-white navbar-vertical-fixed border-end hidden-print">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
            <a href="{{ route('dashboard.index') }}"
               class="p-1 mb-3 branding-section d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/to-do.png') }}" class="l-logo" alt="">
                <img src="{{ asset('img/to-do.png') }}" class="s-logo d-none" alt="">
            </a>

        </div>
    </div>
    <div class="position-absolute t-ggle"><i class="bi bi-list"></i></div>
</aside>

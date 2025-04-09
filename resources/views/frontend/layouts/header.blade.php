<header>
    <div class="row justify-content-center bg-light py-2 pt-3">
        <div class="col-lg-8">
            <div class="row text-center px-2 px-md-0 d-flex justify-content-between align-items-center">
                <div class="col-3 text-left">
                    @if (!request()->is('/') && !str_contains(request()->path(), 'notifications/'))
                    <i id="btn-back" class="fa-solid fa-chevron-left" style="cursor: pointer"></i>
                    @endif
                </div>
                <div class="col-5 h4">
                    @yield("title")
                </div>
                <div class="col-3 text-right">
                    <a href="{{route('notifications')}}" style="position: relative;"
                        class="text-decoration-none btn-theme position-relative">
                        <i class="fa-solid fa-bell"></i>
                        @if($unreadNotificationsCount > 0)
                        <span class="badge badge-pill badge-secondary noti_badge">{{$unreadNotificationsCount}}</span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
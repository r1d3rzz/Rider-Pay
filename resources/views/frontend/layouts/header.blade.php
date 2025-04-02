<header>
    <div class="row justify-content-center bg-light py-2 pt-3">
        <div class="col-lg-8">
            <div class="row text-center px-2 px-md-0 d-flex justify-content-between align-items-center">
                <div class="col-4 text-left">
                    @if (!request()->is("/"))
                    <i id="btn-back" class="fa-solid fa-chevron-left" style="cursor: pointer"></i>
                    @endif
                </div>
                <div class="col-4 h4">
                    @yield("title")
                </div>
                <div class="col-4 text-right">
                    <a href="#" class="text-decoration-none btn-theme">
                        <i class="fa-solid fa-bell"></i><br>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
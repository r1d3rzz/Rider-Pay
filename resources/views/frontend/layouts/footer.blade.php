<footer>
    <div class="row justify-content-center bg-light py-2 pt-3">
        <div class="col-lg-8">
            <div class="row text-center" style="position: relative">
                <div class="{{auth()->user()->wallet ? 'col-3' : 'col-6'}}">
                    <a href="{{route('home')}}" class="text-decoration-none text-dark">
                        <i class="fa-solid fa-home"></i><br>
                        <span class="d-none d-md-inline-block">HOME</span>
                    </a>
                </div>
                @if (auth()->user()->wallet)
                <div class="col-3">
                    <a href="{{route('wallet')}}" class="text-decoration-none text-dark">
                        <i class="fa-solid fa-wallet"></i><br>
                        <span class="d-none d-md-inline-block">WALLET</span>
                    </a>
                </div>
                <div class="col-3">
                    <a href="{{route('transfer.transactions')}}" class="text-decoration-none text-dark">
                        <i class="fa-solid fa-arrow-right-arrow-left"></i><br>
                        <span class="d-none d-md-inline-block">TRANSACTION</span>
                    </a>
                </div>
                @endif
                <div class="{{auth()->user()->wallet ? 'col-3' : 'col-6'}}">
                    <a href="{{route('profile')}}" class="text-decoration-none text-dark">
                        <i class="fa-solid fa-user"></i><br>
                        <span class="d-none d-md-inline-block">ACCOUNT</span>
                    </a>
                </div>
                @if (auth()->user()->wallet)
                <div id="btn-scan">
                    <a id="btn-scan-tag" href="{{route('transfer.receive_qr')}}" class="text-decoration-none text-dark">
                        <i class="fa-solid fa-qrcode"></i><br>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</footer>
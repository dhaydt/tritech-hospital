@if (session()->get('page-title') == "home")
<nav class="navbar nav-home p-2 nav-mobile navbar-horizontal navbar-expand-md navbar-dark" style="height: 220px;">
    <div class="bg-nav">
        <img src="{{ asset('assets/front-end/img/bg-home.jpeg') }}" alt="">
    </div>
    <div class="container-fluid mx-auto h-100 justify-content-center">
        <div class="row w-100 h-100">
            <div class="col-12 d-flex justify-content-center page-title text-center">
                <div class="row w-100 home-header">
                    <div class="col-12 text-start px-0">
                        <span class="title-welcome d-block">Selamat datang di,</span>
                        <span class="title-app">Bidan Ratna Dewi</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</nav>
@else
<nav class="navbar p-2 nav-mobile navbar-horizontal navbar-expand-md navbar-dark">
    <div class="bg-nav">
        <img src="{{ asset('assets/front-end/img/bg-nav.jpg') }}" alt="">
    </div>
    <div class="container-fluid mx-auto justify-content-center">
        <div class="row w-100">
            <div class="col-12 d-flex justify-content-center page-title text-center">
                <h2>
                    {{ session()->get('page-title') }}
                </h2>
            </div>
        </div>
    </div>
</nav>
@endif

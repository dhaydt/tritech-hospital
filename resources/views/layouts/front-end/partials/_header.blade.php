@if (session()->get('page-title') == "home" )
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
@endif

@if (Route::is('profile.view') || Route::is('profile.edit'))
<nav class="navbar nav-home p-2 nav-mobile navbar-horizontal navbar-expand-md navbar-dark" style="height: 120px; background-color: #bffcc6">
    <div class="container-fluid mx-auto h-100 justify-content-center">
        <div class="row w-100 h-100">
            <div class="col-12 d-flex justify-content-center page-title text-center">
                <div class="row w-100 home-header">
                    <div class="col-12 text-center px-0">
                        <span class="title-welcome profil d-block">{{ session()->get('page-title') }}</span>
                    </div>

                </div>
            </div>
        </div>
        @if (Route::is('profile.view'))
        <div class="config-header">
            <a href="{{ route('profile.edit') }}"><i class="fas fa-cog mr-2"></i></a>
        </div>
        @endif
    </div>
</nav>
@endif

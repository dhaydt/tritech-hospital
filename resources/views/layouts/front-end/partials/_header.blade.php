<nav class="navbar p-2 nav-mobile navbar-horizontal navbar-expand-md navbar-dark">
    <div class="container-fluid mx-auto justify-content-center">
        <div class="row w-100">
            <div class="col-12 d-flex justify-content-center page-title">
                @if (session()->get('page-title') == "home")
                <div class="row">
                    <div class="col-12 text-center title-div d-flex flex-column">
                        <span class="title-name">Praktek Mandiri</span>
                        <span class="title-name">Bidan Ratna Dewi</span>
                    </div>
                </div>
                @else
                <h2>
                    {{ session()->get('page-title') }}
                </h2>
                @endif
            </div>
        </div>
    </div>
</nav>

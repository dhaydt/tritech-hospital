@extends('layouts.front-end.app')
<style>
    .login-card{
        height: 98vh;
        position: relative;
    }
    .card-header.head-login{
        border-bottom: none;
    }
    .app-title h1 {
        text-transform: capitalize;
        font-weight: 700;
    }
    .card-header .avatar-login {
        height: 95px;
        width: 95px;
        border: 3px solid #83B5FF;
    }
    .title-login {
        font-size: 22px;
        font-weight: 600;
        color: #413c3c;
    }
    .text-center .btn-login{
        /* background-color: {{ $web_config['primary_color'] }};
        border-color: {{ $web_config['primary_color'] }}; */
        font-weight: 700;
        font-size: 18px;
        padding: 10px;
        border-radius: 12px;
    }
    .custom-control .label{
        font-size: 20px;
        font-weight: 700;
        line-height: 1;
    }
    .label-forgot {
        font-size: 17px;
        font-weight: 600;
        line-height: 1.3;
        color: #6d6d6d;
        text-decoration: none;
    }
    .login-icon {
        color: #6d6d6d;
    }
    #changePassTarget a {
        text-decoration: none;
    }
    img.clipt-path{
        position: absolute;
        top: 0;
        width: 60%;
        right: 0;
    }

    img.clipt-path2{
        position: absolute;
        bottom: 0;
        width: 75%;
        left: 0;
    }

</style>
@section('content')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card login-card shadow border-0 justify-content-center">
                    <img class="clipt-path" src="{{ asset('assets/img/bg-vector.svg') }}" alt="">
                <div class="row p-4 mt--4">
                    <div class="card-header head-login bg-transparent d-flex flex-column align-items-center">
                        <div class="avatar avatar-login">
                            <img src="{{ asset('storage/company').'/avatar.png' }}" alt="">
                        </div>
                        <div class="app-title text-center mt-2 mb-2 px-4">
                            <h1>Praktek mandiri bidan ratna dewi </h1>
                        </div>
                    </div>
                    <div class="card-body px-lg-5">
                        <div class="title-login mb-3">Silahkan login</div>
                        <form class="js-validate" role="form" method="POST" action="{{ route('customersLogin_submit') }}">
                            @csrf

                            <div class="js-form-message form-group{{ $errors->has('phone') ? ' has-danger' : '' }} mb-4">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"><i class="fas fa-phone login-icon"></i></span>
                                    </div>
                                    <input class="pl-2 form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                        placeholder="Nomor Handphone" type="number" name="phone"
                                        value="{{ old('phone') }}" id="signinSrPhone" required
                                        data-msg="Please enter a valid phone number.">
                                </div>
                                @if ($errors->has('phone'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="js-form-message form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"><i class="ni ni-lock-circle-open login-icon"></i></span>
                                    </div>
                                    <input id="signupSrPassword"
                                        class="pl-2 js-toggle-password form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" placeholder="{{ __('Password') }}" type="password" required
                                        data-hs-toggle-password-options='{
                                        "target": "#changePassTarget",
                                        "defaultClass": "fa-eye-slash",
                                        "showClass": "fa-eye",
                                        "classChangeTarget": "#changePassIcon"
                                    }'>
                                    <div id="changePassTarget" class="input-group-append">
                                        <a class="input-group-text bg-white" href="javascript:">
                                            <i id="changePassIcon" class="fas fa-eye-slash login-icon"></i>
                                        </a>
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                        <label class="form-check-label label-forgot" for="flexSwitchCheckChecked">Simpan Password</label>
                                        </div>
                                </div>
                                    <div class="col-6 text-end">
                                        <div class="forgot-password">
                                            <a href="" class="label-forgot">Lupa Password ?</a>
                                        </div>
                                    </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="col-12 text-center px-0">
                                    <button type="submit" class="btn btn-login btn-primary w-100 btn-login my-4">LOGIN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <img class="clipt-path2" src="{{ asset('assets/img/bg-vector2.svg') }}" alt="">
            </div>
            {{-- <div class="row mt-3">
                <div class="col-6">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-light">
                        <small>{{ __('Forgot password?') }}</small>
                    </a>
                    @endif
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('customersReg') }}" class="text-light">
                        <small>{{ __('Create new account') }}</small>
                    </a>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection


<!-- JS Implementing Plugins -->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="{{asset('assets/back-end')}}/js/vendor.min.js"></script>

<!-- JS Front -->
{{-- <script src="{{asset('assets/back-end')}}/js/theme.min.js"></script> --}}
<script src="{{asset('assets/back-end')}}/js/toastr.js"></script>
{!! Toastr::message() !!}

@if ($errors->any())
<script>
    @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
</script>
@endif

<script>
    $(document).on('ready', function () {
        // INITIALIZATION OF SHOW PASSWORD
        // =======================================================
        $('.js-toggle-password').each(function () {
            new HSTogglePassword(this).init()
        });

        // INITIALIZATION OF FORM VALIDATION
        // =======================================================
        $('.js-validate').each(function () {
            $.HSCore.components.HSValidation.init($(this));
        });
    });
</script>

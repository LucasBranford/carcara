@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php($login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
@php($register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))

@if (config('adminlte.use_route_url', false))
    @php($login_url = $login_url ? route($login_url) : '')
    @php($register_url = $register_url ? route($register_url) : '')
@else
    @php($login_url = $login_url ? url($login_url) : '')
    @php($register_url = $register_url ? url($register_url) : '')
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')

    <form action="{{ $register_url }}" method="post">
        {{ csrf_field() }}
        {{-- Botão SUAP --}}

        {{-- Name field --}}
        <div class="input-group mb-3">
            <input type="text" id="name" name="name"  class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if ($errors->has('name'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
            @endif
        </div>

        {{-- matricula field --}}
        <div class="input-group mb-3">
            <input type="text" name="matricula" id="matricula"
                class="form-control {{ $errors->has('matricula') ? 'is-invalid' : '' }}" value="{{ old('matricula') }}"
                placeholder="Matrícula">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if ($errors->has('matricula'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('matricula') }}</strong>
                </div>
            @endif
        </div>
        <div class="input-group mb-3">
            <input type="text" id="campus"  name="campus" class="form-control {{ $errors->has('campus') ? 'is-invalid' : '' }}"
                value="{{ old('campus') }}" placeholder="Câmpus" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-school {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if ($errors->has('campus'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('campus') }}</strong>
                </div>
            @endif
        </div>
        {{-- telefone field
        <div class="input-group mb-3">
            <input type="text" name="telefone"  class="form-control {{ $errors->has('telefone') ? 'is-invalid' : '' }}"
                value="{{ old('telefone') }}" placeholder="Telefone">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if ($errors->has('telefone'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('telefone') }}</strong>
                </div>
            @endif
        </div> --}}


        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email"  id="email"
                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}"
                placeholder="{{ __('adminlte::adminlte.email') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if ($errors->has('email'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
        </div>


        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password"   name="password"
                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                placeholder="{{ __('adminlte::adminlte.password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if ($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
        </div>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                placeholder="{{ __('adminlte::adminlte.retype_password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if ($errors->has('password_confirmation'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </div>
            @endif
        </div>

        {{-- Register button --}}
        <button type="submit" id="suap-logout-button"  class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>

    </form>

@stop

@section('auth_footer')
    <p class="my-0">
        <a href="{{ $login_url }}">
            {{ __('adminlte::adminlte.i_already_have_a_membership') }}
        </a>
    </p>
    <script type="text/javascript" src="{{ asset('js/suap/client.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/suap/js.cookie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/suap/settings.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        var suap = new SuapClient(SUAP_URL, CLIENT_ID, REDIRECT_URI, SCOPE);
        suap.init();
        $(document).ready(function() {
            //$("#suap-login-button").attr('href', suap.getLoginURL());
            if (suap.isAuthenticated()) {
                var scope = suap.getToken().getScope();
                var callback = function(response) {
                    $("#ident").text(JSON.stringify(response, null, 4)); //aqui vai mostrar todos os dados possíveis.
                    document.getElementById('name').value = response.nome;
                    document.getElementById('matricula').value = response.identificacao;
                    document.getElementById('email').value = response.email_google_classroom;
                    document.getElementById('campus').value = response.campus;

                };


                suap.getResource(scope, callback);
            } else {


                suap.logout();
            }
        });
        $("#suap-logout-button").click(function() {
            suap.logout();
        });
    </script>
@stop

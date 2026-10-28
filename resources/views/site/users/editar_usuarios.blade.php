@extends('adminlte::page')

@section('title', 'Configurações da Entidade')

@section('content_header')
    <h1>Perfil do Usuário</h1>
@stop

@section('content')
    <form action="" method="post">
        {{ csrf_field() }}

        {{-- Name field --}}
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                value="{{ auth()->user()->name }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
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
            <input type="text" name="matricula" class="form-control {{ $errors->has('matricula') ? 'is-invalid' : '' }}"
                value="{{  auth()->user()->matricula  }}" placeholder="Matrícula">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if ($errors->has('matricula'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('matricula') }}</strong>
                </div>
            @endif
        </div>

        {{-- telefone field --}}
        <div class="input-group mb-3">
            <input type="text" name="telefone" class="form-control {{ $errors->has('telefone') ? 'is-invalid' : '' }}"
                value="{{  auth()->user()->telefone }}" placeholder="Telefone">
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
        </div>


        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                value="{{  auth()->user()->email }}" placeholder="{{ __('adminlte::adminlte.email') }}">
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
        {{-- cargo_id field
        <div class="input-group mb-3">
            <input type="number" name="cargo_id" class="form-control {{ $errors->has('cargo_id') ? 'is-invalid' : '' }}"
                value="{{  auth()->user()->cargo_id }}" placeholder="Cargo">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if ($errors->has('cargo_id'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('cargo_id') }}</strong>
                </div>
            @endif
        </div>--}}
        {{-- cargo_sec_id field --}}
        {{-- <div class="input-group mb-3">
            <input type="number" name="cargo_sec_id"
                class="form-control {{ $errors->has('cargo_sec_id') ? 'is-invalid' : '' }}"
                value="{{ old('cargo_sec_id') }}" placeholder="Cargo">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if ($errors->has('cargo_sec_id'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('cargo_sec_id') }}</strong>
                </div>
            @endif
        </div> --}}

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password"
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
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>

    </form>
@stop

@section('css')
 @stop

@section('js')





@stop

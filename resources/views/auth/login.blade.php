@extends('layouts.app')

@section('content')
    <div class=" w3-border w3-display-middle w3-col m4">
        <div class="w3-container w3-brown">
            <h2>Acesso Administrativo</h2>
        </div>
        <form class="w3-container w3-padding-32" role="form" method="POST"
              action="{{ env('ENABLE_LOGIN_LDAP')?'/login/ldap':route('login') }}">
            {{ csrf_field() }}
            <label for="email">E-Mail</label>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="w3-input {{ $errors->has('email') ? ' w3-red' : '' }}" name="email"
                       value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Senha</label>
                <input id="password" type="password" class="w3-input" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <label>
                <input type="checkbox" class="w3-check"
                       name="remember" {{ old('remember') ? 'checked' : '' }}> Lembrar senha
            </label>
            <div class="w3-margin-top">
                <button type="submit" class="w3-btn w3-black w3-round">
                    Entrar
                </button>
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Esqueceu a senha?
                    </a>
            </div>
        </form>
    </div>
@endsection

@section('styles')
    <style>
        #back-login{
            width: 100%;
            height: 100%;
            position: fixed;
            left: 0px;
            top: 0px;
            z-index: -1;
    }
</style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            console.log('ok')
        });
    </script>

@endsection

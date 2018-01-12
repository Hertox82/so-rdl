@extends('master.master')

@section('content')
    <div style="width:800px; margin:0px auto;">
        <img src="/style/img/lastrega.png" id="logo"/>
    </div>
    <style>
        #logo {
            max-block-size: 100px;
            margin-bottom: 10px;

        }
    </style>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="portlet box blue-hoki">
                <div class="portlet-title">
                    <div class="caption">
                        Registrazione
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nome *</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon input-circle-left">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    <input id="name" type="text" class="form-control input-circle-right" name="name" value="{{ old('name') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Cognome *</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon input-circle-left">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <input id="surname" type="text" class="form-control input-circle-right" name="surname" value="{{ old('surname') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('surname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('surname') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Data di Nascita</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <select class="form-control" name="day" id="day">
                                            @for($i=1; $i<32; $i++)
                                                @if($i<10)
                                                    <option value="{{'0'.$i}}">{{'0'.$i}}</option>
                                                @else
                                                <option value="{{$i}}">{{$i}}</option>
                                                @endif
                                            @endfor
                                        </select>
                                        <select class="form-control" name="month" id="month">
                                            @for($i=1; $i<13; $i++)
                                                @if($i<10)
                                                    <option value="{{'0'.$i}}">{{'0'.$i}}</option>
                                                @else
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endif
                                            @endfor
                                        </select>
                                        <select class="form-control" name="year" id="year">
                                            @for($i=2000; $i>1937; $i--)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    @if ($errors->has('birthdate'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('birthdate') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            Comune di Nascita
                            Codice Fiscale (con controllo formale)
                            telefono
                            Comune di Residenza
                            Provincia di Residenza
                            Indirizzo di Residenza
                            CAP
                            Municipio di Residenza
                            Sezione Tessera Elettorale
                            Note

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon input-circle-left">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                        <input id="email" type="email" class="form-control input-circle-right" name="email" value="{{ old('email') }}" required>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control spinner input-circle" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Conferma Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control spinner input-circle" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-circle blue-hoki">
                                            Registrami
                                        </button>

                                        <a class="btn btn-link" href="{{route('login')}}">
                                            Torna al Login
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

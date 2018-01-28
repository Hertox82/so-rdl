@extends('master.master')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <div class="caption-subject font-dark bold uppercase">Info</div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="note note-info">
                        <h4>Benvenuto su RDL M5S LAZIO!</h4>
                        <p>Questa è la Piattaforma Operativa per i Rappresentanti di lista del Movimento 5 Stelle per le prossime elezioni.<br>
                            Iscrivendoti darai la tua disponibilità a rappresentare il MoVimento al seggio, segui le istruzioni e sarai ricontattato dal referente della tua zona.<br>
                            <br>
                            Effettuando la registrazione al sito accetti i <a href="{{route('term')}}" target="_blank">termini di servizio</a> e le disposizioni sulla privacy e proprietà dei dati previste da questa piattaforma: per maggiori informazioni, leggi <a href="{{route('privacy')}}" target="_blank">qui</a>
                        </p>
                    </div>
                    <a class="btn default" href="{{route('register')}}">Vai al Modulo di Registrazione</a>
                </div>
            </div>
        </div>
    </div>
    <div style="width:800px; margin:0px auto;">
        <img src="/style/img/logom5s.png" id="logo"/>
    </div>
    <style>
        #logo {
            max-block-size: 100px;
            margin-bottom: 10px;

        }
    </style>
<div class="">
    <div class="row">
        <div class="col-md-8">
            <div class="portlet box m5s">
                <div class="portlet-title">
                    <div class="caption">
                        Login
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-body">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon input-circle-left">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                        <input id="email" type="email" class="form-control input-circle-right" name="email" value="{{ old('email') }}" required autofocus>
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
                                    <div class="input-group">
                                        <span class="input-group-addon input-circle-left">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <input id="password" type="password" class="form-control input-circle-right" name="password" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Ricordami
                                        </label>

                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            hai dimenticato la password?
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-circle m5s">
                                        Login
                                    </button>

                                    <a class="btn btn-link" href="{{route('register')}}">
                                        Registrami
                                    </a>

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

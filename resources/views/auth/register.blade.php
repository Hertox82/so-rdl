@extends('master.master')

@section('content')
    <div style="width:800px; margin:0px auto;">
        <img src="/style/img/logom5snuovo.jpg" id="logo"/>
    </div>
    <style>
        #logo {
            max-block-size: 100px;
            margin-bottom: 10px;

        }
    </style>
    @push('script')
    <script src="/js/cfCheck.js" type="application/javascript"></script>
    @endpush
    <?php
        print_r($errors);
    ?>
<div class="">
    <div class="row">
        <div class="col-md-8">
            <div class="portlet box m5s">
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
                                <label for="name" class="col-md-4 col-xs-3 control-label">Data di Nascita*</label>

                                <div class="col-md-2 col-xs-3">
                                    <label id="day">Giorno</label>
                                    <select class="form-control input-xsmall" name="day" id="day">
                                        @for($i=1; $i<32; $i++)
                                            @if($i<10)
                                                <option value="{{'0'.$i}}">{{'0'.$i}}</option>
                                            @else
                                            <option value="{{$i}}">{{$i}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-2 col-xs-3">
                                    <label id="month">Mese</label>
                                    <select class="form-control input-xsmall" name="month" id="month">
                                        @for($i=1; $i<13; $i++)
                                            @if($i<10)
                                                <option value="{{'0'.$i}}">{{'0'.$i}}</option>
                                            @else
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-4 col-xs-3">
                                    <label id="year">Anno</label>
                                    <select class="form-control input-xsmall" name="year" id="year">
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
                            <div class="form-group {{ $errors->has('comune_nasc') ? ' has-error' : '' }}">
                                <label for="comune_nasc" class="col-md-4 control-label">Comune di Nascita *</label>

                                <div class="col-md-6">
                                    <input id="comune_nasc" type="text" class="form-control input-circle" name="comune_nasc" value="{{ old('comune_nasc') }}" required>
                                    @if ($errors->has('comune_nasc'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('comune_nasc') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div id= "codF" class="form-group {{ $errors->has('cod_fisc') ? ' has-error' : '' }}">
                                <label for="cod_fisc" class="col-md-4 control-label">Codice Fiscale *</label>

                                <div class="col-md-6">
                                    <input id="cod_fisc" type="text" class="form-control input-circle" name="cod_fisc" value="{{ old('cod_fisc') }}" required>
                                    @if ($errors->has('cod_fisc'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('cod_fisc') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Telefono *</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                            <span class="input-group-addon input-circle-left">
                                                <i class="fa fa-mobile"></i>
                                            </span>
                                        <input id="phone" type="tel" class="form-control input-circle-right" name="phone" value="{{ old('phone') }}" required>
                                    </div>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail *</label>

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
                                <label for="password" class="col-md-4 control-label">Password *</label>

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
                                <label for="password-confirm" class="col-md-4 control-label">Conferma Password *</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control spinner input-circle" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('comune_res') ? ' has-error' : '' }}">
                                <label for="comune_res" class="col-md-4 control-label">Comune di Residenza *</label>

                                <div class="col-md-6">
                                    <input id="comune_res" type="text" class="form-control input-circle" name="comune_res" value="{{ old('comune_res') }}" required>
                                    @if ($errors->has('comune_res'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('comune_res') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('prov_res') ? ' has-error' : '' }}">
                                <label for="prov_res" class="col-md-4 control-label">Prov. di Residenza *</label>

                                <div class="col-md-6">
                                    <input id="prov_res" type="text" class="form-control input-circle" name="prov_res" value="{{ old('prov_res') }}" maxlength="2" required>
                                    @if ($errors->has('prov_res'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('prov_res') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('ind_res') ? ' has-error' : '' }}">
                                <label for="ind_res" class="col-md-4 control-label">Indirizzo di Residenza *</label>

                                <div class="col-md-6">
                                    <input id="ind_res" type="text" class="form-control input-circle" name="ind_res" value="{{ old('ind_res') }}"  required>
                                    @if ($errors->has('ind_res'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ind_res') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('cap') ? ' has-error' : '' }}">
                                <label for="cap" class="col-md-4 control-label">CAP *</label>

                                <div class="col-md-6">
                                    <input id="cap" type="text" class="form-control input-circle" name="cap" value="{{ old('cap') }}" maxlength="5" required>
                                    @if ($errors->has('cap'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cap') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('mun_res') ? ' has-error' : '' }}">
                                <label for="cap" class="col-md-4 control-label">Municipio di Residenza</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="mun_res">
                                        <option value="">Nessuno</option>
                                        <option value="1">Municipio I</option>
                                        <option value="2">Municipio II</option>
                                        <option value="3">Municipio III</option>
                                        <option value="4">Municipio IV</option>
                                        <option value="5">Municipio V</option>
                                        <option value="6">Municipio VI</option>
                                        <option value="7">Municipio VII</option>
                                        <option value="8">Municipio VIII</option>
                                        <option value="9">Municipio IX</option>
                                        <option value="10">Municipio X</option>
                                        <option value="11">Municipio XI</option>
                                        <option value="12">Municipio XII</option>
                                        <option value="13">Municipio XIII</option>
                                        <option value="14">Municipio XIV</option>
                                        <option value="15">Municipio XV</option>
                                    </select>
                                    <span class="help-block">
                                            <strong>da compilare solo se di Roma</strong>
                                        </span>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('livello') ? ' has-error' : '' }}">
                                <label for="livello" class="col-md-4 control-label">Esperienza</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="livello">
                                        <option value="1">Nessuna Esperienza</option>
                                        <option value="2">Con Esperienza</option>
                                        <option value="3">Molto Esperto</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('sez') ? ' has-error' : '' }}">
                                <label for="sez" class="col-md-4 control-label">Sezione Tessera Elettorale *</label>

                                <div class="col-md-6">
                                    <input id="sez" type="text" class="form-control input-circle" name="sez" value="{{ old('sez') }}"  required>
                                    @if ($errors->has('sez'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('sez') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('note') ? ' has-error' : '' }}">
                                <label for="cap" class="col-md-4 control-label">Note</label>

                                <div class="col-md-6">
                                    <textarea id="note" type="text" class="form-control" name="note" value="{{ old('note') }}" style="height: 154px;"></textarea>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('note') ? ' has-error' : '' }}">
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <label class="mt-checkbox">
                                        <input type="checkbox" id="privacy"> Ho letto l'Informativa sulla <a href="#">Privacy</a> e acconsento.
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" id="regist" class="btn btn-circle m5s" disabled>
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

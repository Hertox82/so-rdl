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
    <div class="row">
        <div class="col-md-8">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <div class="caption-subject font-dark bold uppercase">AVVISO</div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="alert alert-info">
                        Email verificata! ora puoi accedere al Sistema Operativo per gli RDL.
                    </div>
                    <a class="btn default" href="{{route('login')}}">Vai al Login</a>
                </div>
            </div>
        </div>
    </div>
@endsection
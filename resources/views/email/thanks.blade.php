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
    <p>
        Email verificata! ora puoi accedere al Sistema Operativo per gli RDL.<br>
        vai alla <a href="{{route('login')}}">login</a>
    </p>
@endsection
@extends('hardel::master.template')


@section('title', @$title)

@section('h1', @$title)
@section('h2', @$subTitle)

@section('breadcrumb')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-edit font-dark"></i>
                        <span class="caption-subject font-dark bold">
                            Note
                        </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="note note-warning">
                        <h4 class="block">Attenzione!</h4>
                        <p>Tutte le sezioni sono momentaneamente disabilitate, presto verranno rese attive</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
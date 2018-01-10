@extends('hardel::master.template')

@section('title', 'error')

@section('h1', $generalInfo['title'])
@section('h2', $generalInfo['subTitle'])

@section('breadcrumb')
    <li>
        <span class="active">{{ $generalInfo['title'] }}</span>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-edit font-dark">
                            <span class="caption-subject font-dark bold uppercase">Error</span>
                        </i>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="note note-danger">
                        <h4 class="block">{{$generalInfo['title-message']}}</h4>
                        <p>{{$generalInfo['message']}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
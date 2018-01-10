@extends($generalInfo['extends'])

@section('title', $generalInfo['title'])

@section('h1', $generalInfo['title'])
@section('h2', $generalInfo['subTitle'])

@section('breadcrumb')
    <li>
        <a href="{{ $listUrl }}">{{ $generalInfo['title'] }}</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">@if($method == 'POST')
                Inserimento
            @elseif($method == 'PUT')
                Modifica
            @endif
        </span>
    </li>
@endsection

@section('content')

    <?php
    /**
     * Definizioni di layout
     */
    $col1 = 'col-md-9'; $col2 = 'col-md-3';

    // Se c'è una sola label imposta una colonna unica
    if(count($label) <= 1) {
        $col1 = 'col-md-12'; $col2 = '';
    }
    ?>

    <div class="row">
        @if (count($errors) > 0)
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <strong>Errore!</strong> Il salvataggio non è stato eseguito per le seguenti ragioni:<br>
                    <br>
                    <ul>
                        <?php
                        $errorKeys = array_keys($errors->all());
                        ?>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="{{ $col1 }}">
            <form action="{{ $submitUrl }}" method="post" class="form-horizontal" id="standardEditV1">

                {{ csrf_field() }}
                {{ method_field($method) }}
                <input type="hidden" name="_return" value="0">

                @if(isset($label[$activeLabel]))
                    @foreach($label[$activeLabel]['blocks'] as $Block)

                        @include($Block->getProperty('view'))

                    @endforeach
                @endif

                @if(count($actions) == 0)
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn green">Salva</button>
                            <button type="button" class="btn green submitAndReturn">Salva e torna</button>
                            <button type="button" class="btn default" onclick="document.location.href='{{ $listUrl }}'">Annulla</button>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn green">Salva</button>
                            <button type="button" class="btn green submitAndReturn">Salva e torna</button>
                            <button type="button" class="btn default" onclick="document.location.href='{{ $listUrl }}'">Annulla</button>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                            @foreach($actions as $action)
                                <a type="button" class="{{$action['style']}}" id="{{$action['id']}}">
                                    {{$action['label']}}

                                    @if(strlen($action['icon'])>0)
                                        <i class="{{ $action['icon'] }}"></i>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </form>

        </div>

        @if($col2 != '')
            <div class="{{ $col2 }}">

                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">Menu</span>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <div class="todo-project-list">
                            <ul class="nav nav-stacked">
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge badge-info"> 6 </span> AirAsia Ads </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge badge-success"> 2 </span> HSBC Promo </a>
                                </li>
                                <li class="active">
                                    <a href="javascript:;">
                                        <span class="badge badge-success"> 3 </span> GlobalEx</a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge badge-default"> 14 </span> Empire City </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge badge-info"> 6 </span> AirAsia Ads </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge badge-danger"> 2 </span> Loop Inc Promo </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

    </div>
    @endif

    </div>

@endsection

@push('script')

<script>
    var StandardEditV1 = function () {

        var handleButton = function() {

            $(".submitAndReturn").click(function() {

                $("#standardEditV1 input[name='_return']").val(1);
                $("#standardEditV1").submit();

                return false;

            });

        }

        return {

            init: function () {
                handleButton();
            }

        };

    }();

    jQuery(document).ready(function() {
        StandardEditV1.init();
    });
</script>

@endpush

@foreach($jsList as $sV)
    @include($sV)
@endforeach
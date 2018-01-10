@extends($generalInfo['extends'])

@section('title', $generalInfo['title'])

@section('h1', $generalInfo['title'])
@section('h2', $generalInfo['subTitle'])

@section('breadcrumb')
    <li>
        <span class="active">{{ $generalInfo['title'] }}</span>
    </li>
@endsection

@section('content')

    <div class="tabbable-custom ">
        <ul class="nav nav-tabs ">
            <li class="active">
                <a href="#tab_1" data-toggle="tab"> Lista </a>
            </li>
            @if(count($listInfo['search']) != 0)
                <li>
                    <a href="#tab_2" data-toggle="tab"> Ricerca </a>
                </li>
            @endif
        </ul>
        <div class="tab-content">

            <div class="tab-pane active" id="tab_1">

                @if(count($listInfo['filter']) != 0)
                    <div class="alert alert-info">
                        <button type="button" class="close" onclick="document.location.href='{{ route($activeRoute) }}?reset'"></button>
                        Ricerca - @foreach($listInfo['filter'] as $item)
                            @if($item['type'] == 'text')
                                <strong>{{ strtolower($item['label']) }}</strong>: {{ $item['value'] }};
                            @elseif($item['type'] == 'date')
                                <strong>{{ strtolower($item['label']) }}</strong>: dal {{ $item['value'] }} al {{ $item['value2'] }};
                            @elseif($item['type'] == 'numeric')
                                <strong>{{ strtolower($item['label']) }}</strong>: {{ $item['value'] }};
                            @elseif($item['type'] == 'preset')
                                <strong>{{ strtolower($item['label']) }}</strong>: {{ $item['valuePreset'] }};
                            @endif
                        @endforeach
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-10">
                        <form method="get" action="{{ route($activeRoute) }}">
                            <div class="col-md-12 col-sm-12 dataTables">
                                <div class="dataTables_paginate">
                                    <div class="pagination-panel"> Pagina
                                        @if($listInfo['activePage'] != 1)
                                            <a href="{{ route($activeRoute) }}?page={{ $listInfo['activePage']-1 }}" class="btn btn-sm default prev"><i class="fa fa-angle-left"></i></a>
                                        @endif
                                        <input type="text"
                                               class="pagination-panel-input form-control input-sm input-inline input-mini"
                                               maxlenght="5"
                                               style="text-align:center; margin: 0 5px;"
                                               name="page" value="{{ $listInfo['activePage'] }}">
                                        @if($listInfo['pagesTotal'] != $listInfo['activePage'])
                                            <a href="{{ route($activeRoute) }}?page={{ $listInfo['activePage']+1 }}" class="btn btn-sm default next"><i class="fa fa-angle-right"></i></a>
                                        @endif

                                        di <span class="pagination-panel-total">{{ $listInfo['pagesTotal'] }}</span>
                                    </div>
                                </div>
                                <div class="dataTables_length"><label><span class="seperator">|</span>Visualizza <select
                                                name="nep" aria-controls="datatable_orders"
                                                class="form-control input-xs input-sm input-inline">
                                            <option value="10" @if($listInfo['rowsForPage'] == 10)
                                            selected="selected"
                                                    @endif>10</option>
                                            <option value="25" @if($listInfo['rowsForPage'] == 25)
                                            selected="selected"
                                                    @endif>25</option>
                                            <option value="50" @if($listInfo['rowsForPage'] == 50)
                                            selected="selected"
                                                    @endif>50</option>
                                            <option value="100" @if($listInfo['rowsForPage'] == 100)
                                            selected="selected"
                                                    @endif>100</option>
                                        </select> righe</label></div>
                                <div class="dataTables_info"><span class="seperator">|</span>{{ ($listInfo['rowsTotal'] == 1 ? 'Trovata' : 'Trovate') }} <strong>{{ $listInfo['rowsTotal'] }} {{ ($listInfo['rowsTotal'] == 1 ? 'riga' : 'righe') }}</strong></div>
                                <div class="dataTables_button">
                                    <button type="submit" class="btn btn-sm green">Vai</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2" style="text-align: right;">
                        @if($actionNew)
                            <button type="submit" class="btn btn-sm blue" onclick="document.location.href='{{ $createUrl }}'"><i class="fa fa-file-o"></i> Nuovo</button>
                        @endif
                            @foreach($modalAction as $action)
                                <a type="button" class="{{$action['style']}}" data-modalid="ListActionModal-{{$action['id']}}" id="btnModal-{{$action['id']}}">
                                    @if(strlen($action['icon'])>0)
                                        <i class="{{ $action['icon'] }}"></i>
                                    @endif
                                    {{$action['label']}}
                                </a>
                            @endforeach
                    </div>
                </div>
                <style>
                    .dataTables { overflow: hidden; }
                    .dataTables .dataTables_paginate { float: left; }
                    .dataTables .dataTables_length { float: left; }
                    .dataTables .dataTables_info { float: left; padding-top: 4px; }
                    .dataTables .dataTables_button { float: left; padding: 0px 0 0 5px; }
                    .table-responsive tr.lastrow td { border-bottom-color: #fff ;border-left-color: #fff; border-right-color: #fff; }
                    .table-responsive tr.lastrow td:hover { background: #fff; }
                    .table-responsive tr.lastrow td a { color: #000; text-decoration: none; }
                </style>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            @if($massAction)
                                <th style="width: 30px;"></th>
                            @endif
                            @foreach($listInfo['coloumns'] as $item)
                                <?php
                                $orderActive = $listInfo['orderField'];
                                $exp = explode(" ", $orderActive);
                                $direzione = 'asc';

                                if(@$exp[1] == 'asc') $direzione = 'desc';
                                ?>
                                <th style="
                                @if($item['width'] != null)
                                        width: {{ $item['width'] }};
                                @endif
                                        ">
                                    <a href="{{ route($activeRoute) }}?ord={{ $item['id'] }} {{$direzione}}">{{ $item['label'] }}
                                        @if($exp[0] == $item['id'])
                                            @if(@$exp[1] == 'asc')
                                                <i class="fa fa-angle-up"></i>
                                            @elseif(@$exp[1] == 'desc')
                                                <i class="fa fa-angle-down"></i>
                                            @endif
                                        @endif
                                    </a>
                                </th>
                            @endforeach
                            <td style="width: <?php
                            $tot = 50 + (25*count($listInfo['action']));
                            echo $tot;
                            ?>px;">  </td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listInfo['list'] as $row)
                            <tr>
                                @if($massAction)
                                    <td><input type="checkbox" name="row_{{ $row->id }}" value="{{ $row->id }}" class="massActionCheck"></td>
                                @endif
                                @foreach($listInfo['coloumns'] as $item)
                                    <?php
                                    $fieldId = $item['id'];
                                    $output = $row->$fieldId;

                                    if(strlen($item['modelAttribute']) != 0) {
                                        $fieldId = $item['modelAttribute'];
                                        $output = $row->$fieldId;
                                    }
                                        if(strlen($item['alias']) != 0) {
                                            $fieldId = $item['alias'];
                                            $output = $row->$fieldId;
                                        }
                                    ?>
                                    <td>
                                        @if($item['type'] == 'text')
                                        {{ stripslashes($output) }}
                                        @elseif($item['type'] == 'date')
                                                @if($output != null)
                                        {{ date("d-m-Y", strtotime($output)) }}
                                               @endif
                                        @elseif($item['type'] == 'preset')
                                        <?php
                                                /* $text = $row->gValBack($fieldId,$output); */
                                        if($listInfo['objName'] === $item['objName'])
                                          $text = $listInfo['objName']::gValBack($fieldId, $output);
                                        else
                                          $text = $item['objName']::gValBack($fieldId, $output);
                                        echo $text;
                                        ?>
                                        @elseif($item['type'] == 'price')
                                        {{ number_format($output,2,",","") }} &euro;
                                        @endif
                                    </td>
                                @endforeach
                                <td style="text-align: center;">
                                    @include('hardel::list.include.action-v1',['listInfo' => $listInfo, 'row' => $row])
                                    <a href="{{ route($routePrefix . '.edit', $row->id) }}" class="tooltips" data-original-title="Modifica"><i class="fa fa-edit fa-2x"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        @if($massAction)
                            <tr class="lastrow">
                                <td colspan="10">
                                    <i class="fa fa-arrow-up"></i>
                                    <a style="cursor: pointer;" class="massActionDelete">Elimina selezionati</a>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>

            @if(count($listInfo['search']) != 0)
                <div class="tab-pane" id="tab_2">

                    <div class="portlet box ">

                        <div class="portlet-body form">
                            <form action="{{ route($activeRoute) }}" method="get" class="form-horizontal form-bordered form-row-stripped">
                                <div class="form-body">
                                    @foreach($listInfo['search'] as $item)
                                        <?php
                                        // Cerca il valore
                                        $value = null;
                                        $value2 = null;
                                        foreach($listInfo['filter'] as $filter) {
                                            if($filter['id'] == $item['id']) {
                                                $value = $filter['value'];
                                                $value2 = $filter['value2'];
                                            }
                                        }
                                        ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">{{ $item['label'] }}</label>
                                            <div class="col-md-9">
                                                @if($item['type'] == 'text')
                                                    <input type="text" placeholder="{{ $item['label'] }}" class="form-control" name="T_{{ $item['id'] }}" value="{{ $value }}" />
                                                @elseif($item['type'] == 'date')
                                                    <input type="text" placeholder="Dal" class="form-control date-picker" name="D0_{{ $item['id'] }}" value="{{ $value }}" style="margin-bottom: 2px;" />
                                                    <input type="text" placeholder="Al" class="form-control date-picker" name="D1_{{ $item['id'] }}" value="{{ $value2 }}" />
                                                @elseif($item['type'] == 'preset')
                                                    <select class="form-control" name="PR_{{ $item['id'] }}" style="margin-bottom: 2px;">
                                                        <option value="">-</option>
                                                        @foreach($item['list'] as $row)
                                                            <option value="{{ $row['value'] }}">{{ $row['label'] }}</option>
                                                        @endforeach
                                                    </select>
                                                @elseif($item['type'] == 'numeric')
                                                    <input type="text" placeholder="{{ $item['label'] }}" class="form-control" name="N_{{ $item['id'] }}" value="{{ $value }}" />
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green">
                                                <i class="fa fa-check"></i> Cerca</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            @endif

            @foreach($modalAction as $action)
                <div id="modalView-Inject-{{$action['id']}}">

                </div>
            @endforeach

            @foreach ($listInfo['action'] as $ac)
              @if ($ac['type'] === 'modalAjax')
                <div id="modalView-Action-Inject-{{$ac['id']}}">

                </div>
              @endif
            @endforeach

        </div>
    </div>
    <!-- END SAMPLE TABLE PORTLET-->
@endsection

@push('script')
<script>
    var listStandard = function() {

        var handleMass = function() {

            var shift = new ShiftCheck();

            shift.handleCheckBox('.massActionCheck');

            $(".massActionDelete").click(function(e) {

                var listId = '';
                var url = '{{ $massUrl }}';
                var csrf = '{{ csrf_token() }}';
                var objName = '{{ str_replace('\\', '\\\\', $listInfo['objName']) }}';



                $(".massActionCheck:checked").each(function() {
                    listId = listId + $(this).val() + '-';
                });

                if(listId.length == 0) {
                    alert("E' necessario selezionare almeno una riga");
                    return false;
                }

                confirmation = confirm('Sicuri di voler eliminare definitivamente gli oggetti selezionati?');
                if(confirmation) {

                    $.ajax({
                        method: "POST",
                        url: url,
                        data: 'id=' + listId + '&_token=' + csrf + '&objName=' + objName
                    })
                        .done(function (response) {
                            console.log(response);
                            if (response == 1) {
                                location.reload();
                            }
                        });
                }

                return false;
            });

        }

        return{
            init: function()
            {

                handleMass();
            }
        }
    }();

    $(function() {
        listStandard.init();
    });

</script>
@endpush

@foreach($jsList as $sV)
    @include($sV)
@endforeach

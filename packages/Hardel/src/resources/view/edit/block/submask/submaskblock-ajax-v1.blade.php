<div class="portlet light bordered SubmaskBlock" id="block_{{ $Block->id }}"
     data-blockid="{{ $Block->id }}"
     data-objid="{{ $Block->Obj->id }}"
     data-urlModalSubmit="{{ $Block->urlModalSubmit }}"
     data-rowCount="0"
>
    <div class="portlet-title">
        <div class="caption">
            @if($Block->icon != null)
                <i class="{{ $Block->icon }} font-red-sunglo"></i>
            @endif
            <span class="caption-subject font-red-sunglo bold uppercase">{{ $Block->label }}</span>
        </div>
        <div class="actions">
            @if(strlen($Block->viewModal) != 0)
                <a data-modalid="SubmaskBlockModal-{{ $Block->id }}" class="btn btn-circle btn-default insertButton">
                    <i class="fa fa-plus"></i> Aggiungi </a>
            @endif
            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
        </div>
    </div>
    <div class="portlet-body form">
        @include($Block->getProperty('viewList'), $Block->getProperty('share'))
    </div>

    @if(strlen($Block->viewModal) != 0)
        <div class="modal fade SubmaskBlockModalContainer" id="SubmaskBlockModal-{{ $Block->id }}" tabindex="-1" role="basic" aria-hidden="true"
             data-row="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Inserimento Dati</h4>
                    </div>
                    <div class="modal-body">
                        @include($Block->getProperty('viewModal'), $Block->getProperty('share'))
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Annulla</button>
                        <button type="button" class="btn green saveChange">Salva</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endif
</div>
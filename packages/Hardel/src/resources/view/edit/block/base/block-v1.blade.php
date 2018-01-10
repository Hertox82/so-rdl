<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            @if($Block->getProperty('icon') != null)
                <i class="{{ $Block->getProperty('icon') }} font-red-sunglo"></i>
            @endif
            <span class="caption-subject font-red-sunglo bold uppercase">{{ $Block->getProperty('label') }}</span>
        </div>

        <div class="actions">
            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
        </div>
    </div>
    <div class="portlet-body form">

        <!-- BEGIN FORM-->
        <div class="form-body">

            @foreach($Block->getFields() as $FieldObj)
                @include($FieldObj->getProperty('view'),['Field' => $FieldObj])
            @endforeach

        </div>
        <!-- END FORM-->

    </div>
</div>
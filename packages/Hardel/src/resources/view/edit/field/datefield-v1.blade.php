<div class="form-group @if($errors->has($Field->getProperty("field")))
        has-error
    @endif" id="{{$Field->getProperty("id")}}_content">
    <label class="col-md-3 control-label">{{ $Field->getProperty("label") }}@if($Field->getProperty("required"))*@endif</label>
    <div class="col-md-4">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
            <input type="text" class="form-control @if(!$Field->getProperty("disabled")) date-picker  @endif " placeholder="{{ $Field->getProperty("label") }}"  name="{{ $Field->getProperty("id") }}"
                   <?php
                   $value = $Field->getProperty("value");
                   if(strtotime($value) !== false) $value = date("d-m-Y", strtotime($Field->getProperty("value")));
                   ?>
                   value="{{ old($Field->getProperty("id"), $value) }}" @if($Field->getProperty("disabled")) readonly @endif>
        </div>
        @if($Field->getProperty('help'))
            <span class="help-block">{{$Field->getProperty('help')}}</span>
        @endif
    </div>
</div>
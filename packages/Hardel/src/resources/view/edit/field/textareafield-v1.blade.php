<div class="form-group @if($errors->has($Field->getProperty('field')))
        has-error
    @endif">
    <label class="col-md-3 control-label">{{ $Field->getProperty('label') }}@if($Field->getProperty('required'))*@endif</label>
    <div class="col-md-9">
        <textarea class="form-control"
               @if($Field->getProperty('disabled'))
                   disabled="disabled"
               @else
                    name="{{ $Field->getProperty('id') }}"
               @endif
               style="height: 100px; {{ $Field->getProperty('style') }}">{{ old($Field->getProperty('id'), $Field->getProperty('value')) }}</textarea>
        @if(strlen($Field->getProperty('help')) > 0)
            <span class="help-block"> {{$Field->getProperty('help')}} </span>
        @endif
    </div>
</div>
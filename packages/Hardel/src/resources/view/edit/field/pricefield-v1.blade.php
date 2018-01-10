<div class="form-group @if($errors->has($Field->getProperty('field')))
        has-error
    @endif">
    <label class="col-md-3 control-label">{{ $Field->getProperty('label') }}@if($Field->getProperty('required'))*@endif</label>
    <div class="col-md-4">
        <input type="text" class="form-control"
               placeholder="{{ $Field->getProperty('label') }}"
               maxlength="{{$Field->getProperty('maxLength')}}"
               @if($Field->getProperty('disabled'))
                   disabled="disabled"
               @else
               name="{{ $Field->getProperty('id') }}"
               @endif
               value="{{ old($Field->getProperty('id'), number_format($Field->getProperty('value'), 2,",","")) }}"
               style="{{ $Field->getProperty('style') }}">
        @if(strlen($Field->getProperty('help')) > 0)
            <span class="help-block"> {{$Field->getProperty('help')}} </span>
        @endif
    </div>
</div>
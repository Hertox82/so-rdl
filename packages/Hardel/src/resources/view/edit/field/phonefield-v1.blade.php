<div class="form-group @if($errors->has($Field->getProperty('field')))
        has-error
    @endif">
    <label class="col-md-3 control-label">{{ $Field->getProperty('label') }}@if($Field->getProperty('required'))*@endif</label>
    <div class="col-md-4">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-mobile"></i>
            </span>
            <input type="tel" class="form-control" placeholder="{{ $Field->getProperty('label') }}"
                   maxlength="{{$Field->getProperty('maxLength')}}"
                   name="{{ $Field->getProperty('id') }}"
                   value="{{ old($Field->getProperty('id'), $Field->getProperty('value')) }}" @if($Field->getProperty('disabled')) readonly @endif>
        </div>
        @if($Field->getProperty('help'))
            <span class="help-block">{{$Field->getProperty('help')}}</span>
        @endif
    </div>
</div>
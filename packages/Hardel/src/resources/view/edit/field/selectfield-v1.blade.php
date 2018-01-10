<div class="form-group @if($errors->has($Field->getProperty("field")))
        has-error
    @endif" id="{{$Field->getProperty("id")}}_content">
    <label class="col-md-3 control-label">{{ $Field->getProperty("label") }}@if($Field->getProperty("required"))*@endif</label>
    <div class="col-md-4">
        <select class="form-control" @if($Field->getProperty("disabled")) disabled @else name="{{ $Field->getProperty("id") }}" @endif @if($Field->getProperty("size")) size="{{$Field->getProperty("size")}}" @endif>
            <option value="">-</option>
            @foreach($Field->getProperty("list") as $option)
                <option value="{{$option['value']}}" @if($option['value'] == old($Field->getProperty("id"), $Field->getProperty("value"))) selected @endif>{{$option['label']}}</option>
            @endforeach
        </select>
            @if(strlen($Field->getProperty("help"))>0)
            <span class="help-block"> {{$Field->getProperty("help")}} </span>
            @endif
    </div>
</div>
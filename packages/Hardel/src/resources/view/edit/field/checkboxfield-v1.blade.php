<div class="form-group @if($errors->has($Field->getProperty("field")))
        has-error
    @endif" id="{{$Field->getProperty("id")}}_content">
    <label class="col-md-3 control-label">{{ $Field->getProperty("label") }}@if($Field->getProperty("required"))*@endif</label>
    <div class="col-md-9">
        <div class="checkbox-list" style="padding-top: 8px;">
            <?php
            $count = 0;
            $value = $Field->getProperty('multiValue');
            ?>
            @foreach($Field->getProperty('list') as $item)
                <label><input type="checkbox" name="{{ $Field->getProperty("field") }}_{{ $count }}" value="{{ $item['value'] }}"
                              @if(in_array($item['value'],$value))
                              checked="checked"
                            @endif
                    > {{ $item['label'] }}</label>
                <?php
                $count++;
                ?>
            @endforeach
        </div>
    </div>
</div>
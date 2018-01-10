@if($action['boolean'] === null)
  <a type="button" class="{{$action['style']}} btnModalRow-{{$action['id']}}" data-modalid="ListActionModalRow-{{$action['id']}}" data-Obj = "{{$row->id}}">
      @if(strlen($action['icon'])>0)
          <i class="{{ $action['icon'] }}"></i>
      @endif
  </a>
@else
  <?php
  $function = $action['boolean'];
  ?>
  @if ($objName::$function($row))
    <a type="button" class="{{$action['style']}} btnModalRow-{{$action['id']}}" data-modalid="ListActionModalRow-{{$action['id']}}" data-Obj = "{{$row->id}}">
        @if(strlen($action['icon'])>0)
            <i class="{{ $action['icon'] }}"></i>
        @endif
    </a>
  @endif
@endif

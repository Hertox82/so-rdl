<?php
$routeAlias = $action['routeAlias'];
$target = $action['target'];
$href = route($routeAlias,['id'=>$row->id]);//$row->$functName();
?>
@if($action['boolean'] === null)
    @if($href !== null)
    <a href="{{ $href }}" class="tooltips" data-original-title="{{ $action['label'] }}" style="{{ $action['style'] }}"
       @if($target !== null)
         target="{{ $target }}"
       @endif
    ><i class="{{ $action['icon'] }}"></i></a>&nbsp;
  @endif

@else
    <?php
    $function = $action['boolean'];
    ?>
    @if($objName::$function($row))
        @if($href !== null)
          <a href="{{ $href }}" class="tooltips" data-original-title="{{ $action['label'] }}" style="{{ $action['style'] }}"
             @if($target !== null)
               target="{{ $target }}"
             @endif
          ><i class="{{ $action['icon'] }}"></i></a>&nbsp;
        @endif
    @endif
  @endif

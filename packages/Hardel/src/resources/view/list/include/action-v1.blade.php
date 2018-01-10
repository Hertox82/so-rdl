@foreach($listInfo['action'] as $action)
  @if ($action['type'] === 'standard')
    @include('hardel::list.include.action-standard',['action' => $action, 'row' => $row,'objName'=>$listInfo['objName']])
  @else
    @include('hardel::list.include.action-modalAjax',['action' => $action, 'row' => $row,'objName'=>$listInfo['objName']])
  @endif
@endforeach

Grazie {{$user->name}},
Per verificare la tua mail copia ed incolla questo link:
{{route('verification',['token'=>$user->verifyToken])}}
<html>
<body>
    Grazie {{$user->name}},
<br>
    Per verificare la tua mail clicca <a href="{{route('verification',['token'=>$user->verifyToken])}}">qui</a>
</body>
</html>
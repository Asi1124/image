<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="app.css">
    <title>Document</title>
</head>
<body>
<form action="{{route('images.findJson')}}">
    <p>Поиск по id</p>
    <input type="number" name="id" id="id" placeholder="id" value="">
    <input type="submit" value="Send Request">
</form>
<a href="/json">JSON</a>
<a href="{{route('images.create')}}">Добавить изображение</a>
</br>
</br>
</br>
<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Сортировать по
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="{{ route('images.sort', ['order_by' => 'name', 'order_direction' => 'asc']) }}">Названию (A-z)</a>
        <a class="dropdown-item" href="{{ route('images.sort', ['order_by' => 'name', 'order_direction' => 'desc']) }}">Названию (Z-a)</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('images.sort', ['order_by' => 'created_at', 'order_direction' => 'asc']) }}">Дате загрузки (по возрастанию)</a>
        <a class="dropdown-item" href="{{ route('images.sort', ['order_by' => 'created_at', 'order_direction' => 'desc']) }}">Дате загрузки (по убыванию)</a>
    </div>
</div>


@foreach($images as $image)
    @php
    $name  = $image->name;
    @endphp
    <div>
        {{$name}}
        {{$image->created_at}}
        <a href="{{ asset('/uploads/' . $name) }}"><img src="{{ asset('/uploads/' . $name) }}" width="250" height="250" style="cursor:pointer;" data-toggle="modal" data-target="#imageModal{{ $image->id }}"></a>
        <form action="{{route('images.zip')}}">
            <input class="hidden" type="text" name="name" id="name" value="{{$name}}">
            <button type="submit">ZIP</button>
        </form>
    </div>
@endforeach
<a href="{{route('images.create')}}">Добавить изображение</a>

</body>
</html>

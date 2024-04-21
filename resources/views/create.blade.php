<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="/">Все изображения</a>
<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{route('images.save')}}">
    @csrf
    До 5 файлов
    <input type="file" name="imageName[]" class="custom-file-input" id="images" multiple="multiple">
    <input type="submit" value="Send Request">
</form>

</body>
</html>

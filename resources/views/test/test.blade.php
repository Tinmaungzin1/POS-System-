<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Hello world</h1>
    <p>Lorem ipsum dolor sit amet.</p>
    <p>{{$string}}</p>
    <p>{{$array['name']}}</p>
    <p>{{$array['age']}}</p>
    @foreach ($shift as $value)
    <div style="border: 1px solid red;">
        <p>{{ $value['id'] }}</p>
        <p>{{ $value['start_date_time'] }}</p>
        <p>{{ $value['end_date_time'] }}</p>
    </div>
@endforeach

    <p>{{$shift_start->start_date_time}}</p>
</body>
</html>

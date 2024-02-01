
<!DOCTYPE html>
<html>
<head>
<title>Contact form</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<style>
html, body {
min-height: 100%;
padding: 0;
margin: 0;
font-family: Roboto, Arial, sans-serif;
font-size: 14px;
color: #666;
}
h1 {
margin: 0 0 20px;
font-weight: 400;
color: #1c87c9;
}
p {
margin: 0 0 5px;
}
.main-block {
display: flex;
flex-direction: column;
justify-content: center;
align-items: center;
min-height: 100vh;
background: #1c87c9;
}
form {
padding: 25px;
margin: 25px;
box-shadow: 0 2px 5px #f5f5f5;
background: #f5f5f5;
}
.fas {
margin: 25px 10px 0;
font-size: 72px;
color: #fff;
}
.fa-envelope {
transform: rotate(-20deg);
}
.fa-at , .fa-mail-bulk{
transform: rotate(10deg);
}
input, textarea {
width: calc(100% - 18px);
padding: 8px;
margin-top: 20px;
margin-bottom: 5px;
border: 1px solid #1c87c9;
outline: none;
}
input::placeholder {
color: #666;
}
button {
width: 100%;
padding: 10px;
border: none;
background: #1c87c9;
font-size: 16px;
font-weight: 400;
color: #fff;
}
button:hover {
background: #2371a0;
}
@media (min-width: 568px) {
.main-block {
flex-direction: row;
}
.left-part, form {
width: 50%;
}
.fa-envelope {
margin-top: 0;
margin-left: 20%;
}
.fa-at {
margin-top: -10%;
margin-left: 65%;
}
.fa-mail-bulk {
margin-top: 2%;
margin-left: 28%;
}
}
</style>
</head>
<body>
<div class="main-block">
<div class="left-part">
<i class="fas fa-envelope"></i>
<i class="fas fa-at"></i>
<i class="fas fa-mail-bulk"></i>
</div>
@if(isset($setting))
    <form action="{{ route('updateForm') }}" method="POST">
        <input type="hidden" name="id" value="{{$setting->id}}">
@else
    <form action="{{ route('storeForm') }}" method="POST">
@endif

    @csrf
<h1>Setting</h1>
<div class="info">

<input class="fname" type="company_name" value="{{ old('company_name', isset($setting) ? $setting->company_name : '')}}" name="company_name" placeholder="Company name">
@if($errors->has('company_name'))
<span style="color:red">{{ $errors->first('company_name')}}</span>
@endif
<input type="text" name="company_phone" value="{{old('company_phone', isset($setting) ? $setting->company_phone : '')}}" placeholder="Company Phone">
@if($errors->has('company_phone'))
<span style="color:red">{{ $errors->first('company_phone')}}</span>
@endif
<input type="text" name="company_email" value="{{old('company_email', isset($setting) ? $setting->company_email : '')}}" placeholder="Company Email">
@if($errors->has('company_email'))
<span style="color:red">{{ $errors->first('company_email')}}</span>
@endif
<br/> <br/>
</div>
<p>Company Address</p>
<div>
@if($errors->has('company_address'))
<span style="color:red">{{ $errors->first('company_address')}}</span>
@endif
<textarea rows="4"  name="company_address">{{old('company_address', isset($setting) ? $setting->company_address : '')}}</textarea>
</div>
<button type="submit" href="/">Submit</button>

</form>
</div>
</body>
</html>


<!DOCTYPE html>
<html>
<head>
<style>

#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}

</style>
</head>
<body>
<div class="container">
<h1 style="text-align:center;color:green">Setting</h1>

<table id="customers">
  <tr>
    <th>Company Name</th>
    <th>Company Phone</th>
    <th>Company Email</th>
    <th>Company Address</th>
    <th>Action</th>
  </tr>
  @foreach ($settings as $value)
  <tr>
      <td>{{$value->company_name}}</td>
      <td>{{$value->company_phone}}</td>
      <td>{{$value->company_email}}</td>
      <td>{{$value->company_address}}</td>
      <td>
          <a href="{{ URL::to('test/edit/' . $value->id)}}">edit</a>
          <a href="{{ URL::to('test/delete/' . $value->id)}}">delete</a>
      </td>
  </tr>
  @endforeach

</table>
</div>
</body>
</html>



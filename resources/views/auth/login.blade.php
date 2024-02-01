<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
  font-family: "Poppins", sans-serif;
  margin: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background: #f5f5f5;
  color: #333;
}

.container {
  width: 100%;
  max-width: 400px;
}

.card {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  color: #333;
}

form {
  display: flex;
  flex-direction: column;
}

input {
  padding: 10px;
  margin-bottom: 12px;
  border: 1px solid #ddd;
  border-radius: 4px;
  transition: border-color 0.3s ease-in-out;
  outline: none;
  color: #333;
}

input:focus {
  border-color: #555;
}

button {
  background-color: #3498db;
  color: #fff;
  padding: 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease-in-out;
}

button:hover {
  background-color: #2980b9;
}


    </style>
</head>
<body>
    <div class="container">
    <div class="card">
    <h2>Login</h2>
    @if($errors->has('login-error'))
        <p style="color:red">{{ $errors->first('login-error')}}</p>
    @endif
    <form action="{{ route('login')}}" method="POST">
        @csrf
      <input type="text" id="username" name="username" placeholder="Username" value="{{old('username')}}" required>
                            <input type="password" id="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
                                                </form>
                </section>
            </div>
        </div>
    </div>
</body>

<script>

</script>



</html>

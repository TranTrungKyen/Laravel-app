<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <h1>Home page</h1>
    @if(Session::has('msg'))
        <div class="alert alert-success">
            <strong>{{ Session::get('msg') }}</strong>
        </div>
    @endif
    <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link active" href="#">Home page</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/user/login">Login user</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/user/register">Register user</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/login">Login admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/register">Register admin</a>
          </li>
      </ul>
</body>
</html>
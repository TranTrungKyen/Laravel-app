<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List user</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <h1>List user</h1>
    @if(Session::has('msg'))
        <div class="alert alert-success">
            <strong>{{ Session::get('msg') }}</strong>
        </div>
    @endif
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout-admin') }}">Logout</a>
        </li>
    </ul>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>DASHBOARD</h1>
    @auth
        <p>Bienvenido, {{ auth()->user()->name }}</p>
    @endauth
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">
            Cerrar Sesión
    </button>
    <br><br>
    <a href="{{ route('category.index')}}"> Ver Categoria </a>
    <br>
    <a href="{{ route('post.index') }}">Ver Post</a>
    <br>
    <a href="{{ route('role.index') }}">Ver Roles</a>
    <br>
    <a href="{{ route('permission.index') }}">Ver Permisos</a>  
    <br>
        <a href="{{ route('user.index') }}">Ver Usuarios</a>
        <br>
        

    <a href="/">INICIO</a>
</form>
</body>
</html>
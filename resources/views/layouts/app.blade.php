<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MySkills')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    @include('layouts.components.header')

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    @include('layouts.components.footer')

</body>
</html>

<style>
/* Reset básico */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    background-color: #F8F9FA;
    color: #333;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* Header / Navbar */
header {
    width: 100%;
    background-color: #e61616;
}

.navbar {
    max-width: 1300px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px;
}

.navbar-brand a {
    color: #fff;
    font-size: 20px;
    font-weight: bold;
    text-decoration: none;
    display: flex;
    gap: 14px;
}

.navbar-brand img {
    width: 90px;
    height: auto;
}

.navbar-brand h1 {
    margin-top: 30px;
    font-size: 20px;
    font-family: 'Inter', sans-serif; 
}

.navbar-links {
    list-style: none;
    display: flex;
    gap: 15px;
}

.navbar-links li {
    display: flex;
    align-items: center;
}

.navbar-links a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    padding: 5px 10px;
    transition: background 0.3s, border-radius 0.3s;
}

.navbar-links a:hover {
    background-color: rgba(255,255,255,0.2);
    border-radius: 5px;
}

.btn-logout {
    background: none;
    border: none;
    color: #fff;
    font-weight: 500;
    cursor: pointer;
    padding: 5px 10px;
}

.btn-logout:hover {
    background-color: rgba(255,255,255,0.2);
    border-radius: 5px;
}

/* Main content centralizado */
main {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 30px 20px;
}

.container {
    width: 100%;
    max-width: 1200px;
}

/* Footer */
footer {
    width: 100%;
    background-color: #ce1010;
    color: white;
    text-align: center;
    padding: 14px;
}

/* Responsividade */
@media (max-width: 600px) {
    .navbar-links {
        flex-direction: column;
        gap: 8px;
    }
    main {
        padding: 20px 10px;
    }
}
</style>

</body>
</html>
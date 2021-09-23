<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- Ion Icon -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        
    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="/img/logo.png" alt="MyExpenses"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="/login"><ion-icon name="log-in-outline"></ion-icon> Log In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Cadastre-se</a>
                </li>
                @endguest
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="/"><ion-icon name="home-outline"></ion-icon> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard"><ion-icon name="stats-chart-outline"></ion-icon> Dashboard</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" type="button" id="dropMenu" data-bs-toggle="dropdown" aria-expanded="false"><ion-icon name="person-outline"></ion-icon> {{$userName}}</a>
                        <ul class="dropdown-menu" aria-labelledby="dropMenu" id="ul-drop-menu">
                            <li><a href="/expenses/profile" class="nav-link"><ion-icon name="settings-outline"></ion-icon> Conta</a></li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <a class="nav-link" href="/logout" onclick="event.preventDefault(); this.closest('form').submit();"><ion-icon name="log-out-outline" ></ion-icon> Log Out</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
  
@yield('content')

<div class="footer container-fluid bg-dark text-light" id="footer">
    <div class="row">
        <div class="col-md-6">
            <p class="mt-3 mb-3">My Expenses &copy; @php echo date('Y') @endphp</p>
        </div>
        <div class="col-md-6">
            <p class="mt-3 mb-3">Desenvolvido por: <strong>Douglas Vulcano</strong></p>
            @auth
            <div>
                <a href="https://github.com/DouglasVulcano" target="blank" style="font-size: 20pt;"><ion-icon name="logo-github"></ion-icon></a>
            </div>
            @endauth
        </div>
    </div>
</div>

<!-- Bootstrap Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>
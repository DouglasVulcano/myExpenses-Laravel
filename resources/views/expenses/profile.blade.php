@extends('layouts.main')
@section('title', 'Conta')
@section('content')
<div class="container col-md-8 edit-dashboard"> <!-- Profile -->
    <div class="dashboard-div"><h1 class="dashboard-title"><ion-icon name="document-lock-outline"></ion-icon> Dados da conta</h1></div>
    @if (session('success'))
    <div class="alert alert-success text-center">{{session('success')}}</div>
    @elseif (session('fail'))
    <div class="alert alert-danger text-center">{{session('fail')}}</div>
    @endif
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Nome:</label>
                        <input type="text" id="name" class="form-control" placeholder="{{$userName}}" disabled>
                    </div>
                    <div class="col-md-6">
                        <form action="/expenses/nameUpdate" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name">Novo Nome:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <input type="submit" value="Alterar Nome" class="form-control btn btn-success">
                            </div>  
                        </form> 
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="email">E-mail:</label>
                <input type="text" id="email" class="form-control" placeholder="{{$email}}" disabled>
            </div>
            <div class="mb-3">
                <label for="created">O cadastro foi realizado em:</label>
                <input type="text" id="created" class="form-control" placeholder="{{date('d/m/Y', strtotime($createdAt))}}" disabled> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="bg-dark">
                <h3 class="dashboard-title"> <ion-icon name="swap-horizontal-outline"></ion-icon> Alterar Senha</h3>
            </div>  
            <form action="/expenses/passwordUpdate" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="email">Senha Atual:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    <input type="checkbox" onclick="showPass('password')"> Mostrar
                </div>
                <div class="mb-3">
                    <label for="email">Nova senha</label>
                    <input type="password" name="passwordNew" id="passwordNew" class="form-control" required>
                    <input type="checkbox" onclick="showPass('passwordNew')"> Mostrar
                </div>
                <div class="mb-3">
                    <label for="email">Confirmar nova senha</label>
                    <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control" required>
                </div>
                <div class="mb-3">
                   <input type="submit" value="Alterar senha" class="form-control btn btn-success">
                </div>
            </form> 
        </div>
    </div>
</div> <!-- Profile -->

<script>
    function showPass(id) {
        var x = document.getElementById(id);
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endsection
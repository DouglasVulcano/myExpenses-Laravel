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
                <div class="bg-dark">
                    <h3 class="dashboard-title"> <ion-icon name="person-circle-outline"></ion-icon> Alterar Nome</h3>
                </div> 
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Nome:</label>
                        <input type="text" id="name" class="form-control mb-2" placeholder="{{$userName}}" disabled>
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
            <form action="/expenses/updatePassword" method="post">
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
            <div>
                <h3 class="bg-danger p-1 text-light"><ion-icon name="trash-outline"></ion-icon> Excluir Conta</h3>
                <!--Delete User Btn  -->
                <div class="row">
                    <div class="col-md-8">
                        <p>Lembre-se, que não poderá reativar a conta ou recuperar o as informações adicionadas.</p>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-danger form-control" data-bs-toggle="modal" data-bs-target="#deleteProfile">
                            Excluir Conta
                        </button>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div> <!-- Profile -->



<!-- Delete User Model -->
<div class="modal fade" id="deleteProfile" tabindex="-1" aria-labelledby="deleteProfileLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteProfileLabel"><ion-icon name="trash-outline"></ion-icon> Excluir conta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="/expenses/delete-user" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <p>Para prosseguir confirme sua senha.</p>
                    <label for="email">Senha:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    <input type="checkbox" onclick="showPass('password')"> Mostrar
                </div>
                <div class="mb-3">
                   <input type="submit" value="Excluir" class="form-control btn btn-danger">
                </div>
            </form>
      </div>
    </div>
  </div>
</div>

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
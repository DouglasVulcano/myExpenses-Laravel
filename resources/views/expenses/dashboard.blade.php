@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid banner-dashboard"> <!-- Dashboard -->
    <div class="row">


        <div class="col-md-2 text-light aside-dashboard"> <!-- Aside -->
            <h5 class="aside-title"><ion-icon name="person-outline"></ion-icon> {{$userName}}</h5>
            <a href="/expenses/create" class="btn btn-outline-light form-control mb-1" data-bs-toggle="modal" data-bs-target="#modalAddExpense"><ion-icon name="add-outline"></ion-icon> Adicionar despesa</a>
        </div> <!-- Aside -->

        <div class="col-md-10"> <!-- Menu Principal -->
            <h1>Dashboard!</h1>
        </div> <!-- Menu Principal -->
    </div>
</div> <!-- Dashboard -->


<!-- Modal -->
<div class="modal fade" id="modalAddExpense" tabindex="-1" aria-labelledby="modalAdd" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAdd"><ion-icon name="add-outline"></ion-icon> Adicionar despesa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="/expenses" method="post">
                @csrf
                <div class="mb-3">
                    <label for="expenseTitle" class="form-label">Titulo da despesa</label>
                    <input type="text" class="form-control" id="expenseTitle" name="expenseTitle" required>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Tipo</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="Alimentação">Alimentação</option>
                        <option value="Aluguel">Aluguel</option>
                        <option value="Conta de água">Conta de água</option>
                        <option value="Conta de luz">Conta de luz</option>
                        <option value="Combustível">Combustível</option>
                        <option value="Internet">Internet</option>
                        <option value="Transporte">Transporte</option>
                        <option value="Insumos Gerais/ Outros">Insumos Gerais/ Outros</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Preço</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Data</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Cadastrar despesa" class="btn btn-outline-dark form-control">
                </div>
            </form>
      </div>
    </div>
  </div>
</div>
@endsection
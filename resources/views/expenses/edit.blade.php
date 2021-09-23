@extends('layouts.main')
@section('title', 'Editando Despesa')

@section('content')
<div class="container col-md-6 edit-dashboard"> <!-- Edit -->
    <div class="dashboard-div">
        <h1 class="dashboard-title"><ion-icon name="create-outline"></ion-icon> Editando: {{$expense->expenseTitle}}</h1>
    </div>
    <form action="/expenses/update/{{$expense->id}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="expenseTitle" class="form-label">Titulo da despesa</label>
            <input type="text" class="form-control" id="expenseTitle" name="expenseTitle" value="{{$expense->expenseTitle}}">
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tipo</label>
            <select class="form-select" id="type" name="type">
                <option value="{{$expense->type}}" >Valor atual: {{$expense->type}}</option>
                <option value="Alimentação">Alimentação</option>
                <option value="Aluguel">Aluguel</option>
                <option value="Condomínio">Condomínio</option>
                <option value="Contas">Contas</option>
                <option value="Conta de água">Conta de água/luz</option>
                <option value="Combustível">Combustível</option>
                <option value="Internet">Internet</option>
                <option value="Transporte">Transporte</option>
                <option value="Insumos Gerais/ Outros">Insumos Gerais/ Outros</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Preço</label>
            <input type="number" class="form-control" id="price" name="price" step=".01" value="{{$expense->price}}">
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Data</label>
            <input type="date" class="form-control" id="date" name="date" value="{{$expense->date->format('Y-m-d')}}">
        </div>
        <div class="modal-footer">
            <input type="submit" value="Editar despesa" class="btn btn-outline-dark form-control">
        </div>
    </form>
</div> <!-- Edit -->
@endsection
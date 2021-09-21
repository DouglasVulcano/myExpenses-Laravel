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
            <div class="row">

                <div class="col-md-8">
                   <h1 class="dashboard-title"><ion-icon name="bar-chart-outline"></ion-icon> Análise</h1>
                   <h1>{{$totalExpenses}}</h1>
                   <h1>{{$qtdTotal}}</h1>
                </div>

                <div class="col-md-4">
                    <h1 class="dashboard-title"><ion-icon name="list-circle-outline"></ion-icon> Meus Gastos</h1>
                    @foreach($expenses as $expense)
                    <div class="expense mb-2">
                        <h1 class="expense-title"><ion-icon name="chevron-forward-outline"></ion-icon>{{$expense->expenseTitle}}</h1>
                        <div class="row">
                            <div class="col-lg-8">
                                <ul>    
                                    <li class="expense-info"><ion-icon name="keypad-outline"></ion-icon> {{$expense->type}}</li>
                                    <li class="expense-info"><ion-icon name="cash-outline"></ion-icon> R$ {{$expense->price}}</li>
                                    <li class="expense-info"><ion-icon name="calendar-outline"></ion-icon> {{date('d/m/Y', strtotime($expense->date))}}</li>
                                </ul>
                            </div>
                            <div class="col-lg-4" id="actions">
                                <div class="col-md-12 mb-1">
                                    <a href="/expenses/edit/{{$expense->id}}" class="btn btn-outline-primary btn-sm form-control">Editar</a>
                                </div>
                                <div class="col-md-12">
                                    <form action="/expenses/{{$expense->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm form-control">Excluir</button>
                                    </form>
                                </div>
                            </div> 
                        </div>
                    </div>
                    @endforeach
                    @if(count($expenses) == 0)
                    <p>Não há despesas cadastradas.</p>
                    @endif
                </div>
            </div>
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
                        <option selected><strong>Escolha o tipo de despesa</strong></option>
                        <option value="Alimentação">Alimentação</option>
                        <option value="Aluguel">Aluguel</option>
                        <option value="Condomínio">Condomínio</option>
                        <option value="Contas">Contas</option>
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
                    <input type="number" class="form-control" id="price" name="price" step=".01" required>
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
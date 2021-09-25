@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')

<div class="container-fluid banner-dashboard"> <!-- Dashboard -->
    <div class="row">
        <div class="col-lg-2 div-menu">
            <div class="text-light">
                <h5 class="dashboard-title"><ion-icon name="grid-outline"></ion-icon> Menu</h5>

                <a href="/expenses/create" class="btn btn-outline-light form-control mb-1" data-bs-toggle="modal" data-bs-target="#modalAddExpense"><ion-icon name="add-outline"></ion-icon> Adicionar despesa</a>

                <a href="/expenses/list" class="btn btn-outline-light form-control"><ion-icon name="list-circle-outline"></ion-icon> Ver todas</a>
            </div> 
            <div class="col-md mt-3 text-light"> <!-- Último registro -->
                <div>
                    <h1 class="dashboard-title"><ion-icon name="list-circle-outline"></ion-icon> Última Despesa</h1>
                </div>
                                    
                @foreach($lastExpenses as $expense)
                <div class="expense-div mb-2">
                    <h1 class="expense-title"><ion-icon name="chevron-forward-outline"></ion-icon>{{$expense->expenseTitle}}</h1>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul>    
                                <li class="expense-info"><ion-icon name="keypad-outline"></ion-icon> {{$expense->type}}</li>
                                <li class="expense-info"><ion-icon name="cash-outline"></ion-icon> R$ {{$expense->price}}</li>
                                <li class="expense-info"><ion-icon name="calendar-outline"></ion-icon> {{date('d/m/Y', strtotime($expense->date))}}</li>
                            </ul>
                        </div>
                        <div class="col-lg-12" id="actions">
                            <div class="col-lg-12 mb-1">
                                <a href="/expenses/edit/{{$expense->id}}" class="btn btn-outline-primary btn-sm form-control">Editar</a>
                            </div>
                            <div class="col-lg-12">
                                <form action="/expenses/{{$expense->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm form-control">Excluir</button>
                                </form>
                            </div>
                        </div> 
                    </div>
                </div>
                <hr>
                @endforeach
                
                @if(count($lastExpenses) == 0)
                <div class="nothing">
                    <img src="/img/search-icon.png" alt="Search Icon" class="img-fluid  img-empty">
                    <p>Não há despesas cadastradas.</p>
                </div>
                <hr>
                @endif

            </div> <!-- Último registro -->
        </div>

        <div class="col-lg-10 dashboard-side">
            <div class="row">
                <div class="col-lg-12"> <!-- Análise -->
                    <div class="dashboard-div mt-2">
                        <h1 class="dashboard-title"><ion-icon name="analytics-outline"></ion-icon> Análise</h1>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4 mb-2">
                            <div class="card">
                                <div class="card-body graphic-card">
                                    <h3 class="card-expenses-green"><ion-icon name="wallet-outline"></ion-icon> Nº Despesas</h3>
                                    <p class="card-expenses-p">{{$totalExpenses}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="card">
                                <div class="card-body graphic-card">
                                    <h3 class="card-expenses-orange"><ion-icon name="cash-outline"></ion-icon> Gasto Total</h3>
                                    <p class="card-expenses-p">R$ {{$qtdTotal}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body graphic-card">
                                    <h3 class="card-expenses-red"><ion-icon name="chevron-up-outline"></ion-icon> Maior Gasto</h3>
                                    <p class="card-expenses-p">R$ {{$maxPrice}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">   <!-- Gráfico -->
                    <div class="dashboard-div">
                        <h1 class="dashboard-title"><ion-icon name="bar-chart-outline"></ion-icon> Gráficos</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 mt-2">
                            <div class="card">
                                <div class="card-body graphic-card">
                                    <h1 class="graphic-title">Quantidades</h1>
                                    <canvas id="graphic-bar"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-2">
                            <div class="card pb-4 graphic-card">
                                <div class="card-body">
                                    <h1 class="graphic-title">Valores (R$)</h1>
                                    <canvas id="graphic-pizza"></canvas>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Gráfico -->
                </div> <!-- Análise -->
            </div>
        </div> 
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
                        <option value="Conta de água/luz">Conta de água/luz</option>
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
                    <label for="date" class="form-label">Data de vencimento</label>
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


<script>
    /** graphic-bar  */
    let graphicBar = document.getElementById('graphic-bar').getContext('2d');
    let myChart = new Chart(graphicBar, {
        type: 'bar',
        data: {
            labels: ['Alimentação', 'Aluguel', 'Condomínio', 'Contas', 'Conta de água/luz', 'Combustível', 'Internet', 'Transporte', 'Gerais'],
            datasets: [{
                label: '- Quantidade',
                data: [{{implode(',', $expenseTypes)}}],
                backgroundColor: [
                    'rgba(70, 130, 180)',
                    'rgba(139, 0, 0)',
                    'rgba(75, 192, 192)',
                    'rgba(60, 179, 113)',
                    'rgba(218, 165, 32)',
                    'rgba(255, 140, 0)',
                    'rgba(210, 105, 30)',
                    'rgba(107, 142, 35)',
                    'rgba(255, 215, 0)'
                ],
                borderColor: [
                    'rgba(70, 130, 180)',
                    'rgba(139, 0, 0)',
                    'rgba(75, 192, 192)',
                    'rgba(60, 179, 113)',
                    'rgba(218, 165, 32)',
                    'rgba(255, 140, 0)',
                    'rgba(210, 105, 30)',
                    'rgba(107, 142, 35)',
                    'rgba(255, 215, 0)'
                ],
                borderWidth: 2
            }]
        },
        options: {
        
           y: {
                beginAtZero: true,
                steps: 10,
                stepValue: 5,      
                max: 10
           }
      
        }
    });

   /** graphic-pizza */

   new Chart(document.getElementById("graphic-pizza"), {
        type: 'pie',
        data: {
            labels: ['Alimentação (R$)', 'Aluguel (R$)', 'Condomínio (R$)', 'Contas (R$)', 'Conta de água/luz (R$)', 'Combustível (R$)', 'Internet (R$)', 'Transporte (R$)', 'Gerais (R$)'],
            datasets: [{
                backgroundColor: [
                    'rgba(70, 130, 180)',
                    'rgba(139, 0, 0)',
                    'rgba(75, 192, 192)',
                    'rgba(60, 179, 113)',
                    'rgba(218, 165, 32)',
                    'rgba(255, 140, 0)',
                    'rgba(210, 105, 30)',
                    'rgba(107, 142, 35)',
                    'rgba(255, 215, 0)'
                ],   
                data: [{{implode(',', $expenseValues)}}]
            }]
        }
    });


</script>
@endsection
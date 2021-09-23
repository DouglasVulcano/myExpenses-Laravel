@extends('layouts.main')
@section('title', 'Minhas despesas')
@section('content')


<div class="container-fluid col-md-8 edit-dashboard"> <!-- List -->
    <div class="dashboard-div"><h1 class="dashboard-title"><ion-icon name="document-text-outline"></ion-icon> Minhas despesas</h1></div>
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
    <div class="nothing">
        <img src="/img/search-icon.png" alt="Search Icon" class="img-fluid  img-empty">
        <p>Não há despesas cadastradas.</p>
    </div>
    @endif
</div> <!-- List -->


@endsection
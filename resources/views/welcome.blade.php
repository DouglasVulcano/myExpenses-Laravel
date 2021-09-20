@extends('layouts.main')
@section('title', 'My Expenses: Monitore seus gastos como nunca!')
@section('content')

<div class="container-fluid banner-app"> <!-- Banner -->
    <h1>Monitore seus gastos como nunca!</h1>
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="row">
                <div class="col-md-6">
                    <a href="#info" class="btn btn-outline-dark form-control mt-1 mb-1">Saiba mais</a>
                </div>
                <div class="col-md-6">
                    <a href="" class="btn btn-outline-dark form-control mt-1 mb-1">Comece já!</a>
                </div>
            </div>
        </div>
    </div>
</div> <!-- Banner -->

<div class="container-fluid info-app"> <!-- Informações -->
    <div class="container" id="info">
        <div class="row">
            <div class="col-md-5 info-app-card">
                <h1 class="info-app-title"><ion-icon name="flash-outline"></ion-icon> Ágil</h1>
                <p class="info-app-p">Em poucos toques a despesa está registrada em sua dashboard.</p>
            </div>
            <div class="col-md-5 info-app-card">
                <h1 class="info-app-title"><ion-icon name="bar-chart-outline"></ion-icon> Organizado</h1>
                <p class="info-app-p">Categorias pré-definidas para que você possa ter total controle dos dados.</p>
            </div>
        </div>
    </div>
</div> <!-- Informações -->

<div class="container-fluid tip-app"> <!-- Tips -->
    <div class="container" id="info">
        <h1 class="tip-app-title"><ion-icon name="chatbubbles-outline"></ion-icon> Dicas para economizar dinheiro.</h1>
        <p class="tip-app-p">Economizar é uma tarefa importante e que precisa ser cumprida da melhor maneira possível. Mas como fazer isso sem prejudicar o seu padrão de vida? Confira algumas dicas!</p>

        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <strong>1. Faça uma avaliação das suas finanças</strong>
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p class="tip-app-p">O primeiro passo é fazer uma análise das suas finanças. Afinal, é muito comum que as pessoas não saibam quanto ganham e gastam mensalmente.</p>
                        <p class="tip-app-p">A tarefa inicial será colocar, em um papel, quanto que você recebe e o quanto gasta todos os meses — além de anotar possíveis dívidas.</p>
                        <p class="tip-app-p">Isso permitirá enxergar, de forma clara, onde você está agora para que possa traçar um plano de ação e evitar gastos desnecessários ou além do previsto.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <strong>2. Controle as contas</strong>
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p class="tip-app-p">Ter o controle das contas é necessário porque ajuda a reduzir os custos mês a mês..</p>
                        <p class="tip-app-p">A dica principal sobre isso é anotar quanto você gasta com o essencial todos os meses: aluguel, água, luz, telefone, internet, supermercado. Nesse momento é importante anotar outros gastos extras que você talvez tenha como escola dos filhos, plano de saúde, lazer, etc.</p>
                    </div>  
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <strong>3. Pense antes de consumir</strong>
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p class="tip-app-p">Essa é uma dica simples, que você certamente já ouviu, mas que poucas pessoas executam. Antes de consumir qualquer item, é importante refletir: eu realmente preciso disso?</p>
                        <p class="tip-app-p">Além dessa pergunta, é importante se questionar: tenho condições financeiras para realizar essa compra ou isso pode me prejudicar financeiramente? Muitas das compras que fazemos diariamente ocorrem por impulso, no calor do momento.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- Tips -->

@endsection
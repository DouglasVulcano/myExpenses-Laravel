<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\User;

class ExpenseController extends Controller
{   
    public function index() {
        $user = auth()->user();
        if ($user){
            $userName = $user->name;
        } else {
            $userName = 'guest';
        }

        return view('index', [
                            'userName' => $userName
                            ]);
    }



    public function dashboard() {

        $user = auth()->user();
        $userName = $user->name;

        /** Todas as Despesas */
        $expenses = $user->expenses;
        
        /** Pegando a última despesa */
        if (count($expenses) > 1) {
            $lastExpenses = [
                             $expenses[count($expenses) - 1]
                            ];
        } else {

            $lastExpenses = [];

            for ($i = 1; $i <= count($expenses); $i++) {
                array_push($lastExpenses, $expenses[$i-1]);     
            }
        }
        
        /** Quantidade de Despesas */
        $totalExpenses = count($expenses);

        /** Todos os prices */
        $prices = [];

        /** Gasto total */
        $qtdTotal = 0;
        foreach ($expenses as $values) {
            $qtdTotal += $values->price;
            array_push($prices, $values->price);
        }
        
        /** Maior preço */
        if (count($prices) == 0){
            $maxPrice = 0;
        } else {
            $maxPrice = max($prices);
        }


        /** Captura de todos os tipos de despesas */
        $expenseTypes = array( 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $expenseValues = array( 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($expenses as $types) {

            switch ($types->type) {

                case 'Alimentação':
                    $expenseTypes[0]++;
                    $expenseValues[0] += $types->price;
                    break;

                case 'Aluguel':
                    $expenseTypes[1]++;
                    $expenseValues[1] += $types->price;
                    break;

                case 'Condomínio':
                    $expenseTypes[2]++;
                    $expenseValues[2] += $types->price;
                    break;

                case 'Contas':
                    $expenseTypes[3]++;
                    $expenseValues[3] += $types->price;
                    break;

                case 'Conta de água/luz':
                    $expenseTypes[4]++;
                    $expenseValues[4] += $types->price;
                    break;

                case 'Combustível':
                    $expenseTypes[5]++;
                    $expenseValues[5] += $types->price;
                    break;

                case 'Internet':
                    $expenseTypes[6]++;
                    $expenseValues[6] += $types->price;
                    break;

                case 'Transporte':
                    $expenseTypes[7]++;
                    $expenseValues[7] += $types->price;
                    break;

                case 'Insumos Gerais/ Outros':
                    $expenseTypes[8]++;
                    $expenseValues[8] += $types->price;
                    break;
            }
        }

        
        return view('expenses.dashboard', [
                                            'userName' => $userName,
                                            'lastExpenses' => $lastExpenses,
                                            'totalExpenses' => $totalExpenses,
                                            'qtdTotal' => $qtdTotal,
                                            'maxPrice' => $maxPrice,
                                            'expenseTypes' => $expenseTypes,
                                            'expenseValues' => $expenseValues
                                         ]);
    }





    public function store(Request $request) {
        $expense = new Expense;

        /** Validação dos campos */
        $request->validate([
                            'expenseTitle' => 'required',
                            'price' => 'required',
                            'date' => 'required',
                            'type' => 'required'
                        ]);


        $user = auth()->user();


        $expense->user_id = $user->id;

        $expense->expenseTitle = $request->expenseTitle;
        $expense->price = $request->price;
        $expense->date = $request->date;
        $expense->type = $request->type;

        $expense->save();

        return redirect('/dashboard');
    }



    public function update(Request $request) {

        Expense::findOrFail($request->id)->update($request->all());

        return redirect('/dashboard')->with('msg','Evento editado com sucesso!');
    }



    public function edit($id) {

        $user = auth()->user();
        if ($user){
            $userName = $user->name;
        } else {
            $userName = '';
        }

        $expense = Expense::findOrFail($id);
        return view('expenses.edit', [ 
                                        'expense' => $expense,
                                        'userName' => $userName
                                    ]);
    }


    public function destroy($id) {
        Expense::findOrFail($id)->delete();
        return redirect('/dashboard');
    }


    public function list() {
        $user = auth()->user();

        $userName = $user->name;
        $expenses = $user->expenses;

        return view('expenses.list', [ 
                                        'expenses' => $expenses,
                                        'userName' => $userName
                                    ]);
    }
}

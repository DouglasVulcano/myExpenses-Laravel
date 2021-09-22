<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\User;

class ExpenseController extends Controller
{
    public function index() {
        return view('index');
    }

    public function dashboard() {
        $user = auth()->user();

        $userName = $user->name;

        /** Todas as Despesas */
        $expenses = $user->expenses;
        
        /** Pegando as últimas 3 despesas */
        if (count($expenses) > 3) {

            $lastExpenses = [$expenses[count($expenses) - 1], $expenses[count($expenses) - 2], $expenses[count($expenses) -3]];

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

        return view('expenses.dashboard', [
                                            'userName' => $userName,
                                            'lastExpenses' => $lastExpenses,
                                            'totalExpenses' => $totalExpenses,
                                            'qtdTotal' => $qtdTotal,
                                            'maxPrice' => $maxPrice
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
        $expense = Expense::findOrFail($id);
        return view('expenses.edit', ['expense' => $expense]);
    }

    public function destroy($id) {
        Expense::findOrFail($id)->delete();
        return redirect('/dashboard');
    }
}

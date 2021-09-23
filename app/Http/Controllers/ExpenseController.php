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
            $userName = '';
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


        /** Captura de todos os tipos de despesas */

        $food = 0;
        $rent = 0;
        $cond = 0;
        $bills = 0;
        $waterlight = 0;
        $fuel = 0;
        $internet = 0;
        $transp = 0;
        $all = 0;

        foreach ($expenses as $types) {

            switch ($types->type) {
                
                case 'Alimentação':
                    $food++;
                    break;
                case 'Aluguel':
                    $rent++;
                    break;
                case 'Condomínio':
                    $cond++;
                    break;
                case 'Contas':
                    $bills++;
                    break;
                case 'Conta de água/luz':
                    $waterlight++;
                    break;
                case 'Combustível':
                    $fuel++;
                    break;
                case 'Internet':
                    $internet++;
                    break;
                case 'Transporte':
                    $transp++;
                    break;
                case 'Insumos Gerais/ Outros':
                    $all++;
                    break;
            }
        }

        $expenseTypes = array(
                                'food' => $food,
                                'rent' => $rent,
                                'cond' => $cond,
                                'bills' => $bills,
                                'waterlight' => $waterlight,
                                'fuel' => $fuel,
                                'internet' => $internet,
                                'transp' => $transp,
                                'all' => $all
        );

        

        return view('expenses.dashboard', [
                                            'userName' => $userName,
                                            'lastExpenses' => $lastExpenses,
                                            'totalExpenses' => $totalExpenses,
                                            'qtdTotal' => $qtdTotal,
                                            'maxPrice' => $maxPrice,
                                            'expenseTypes' => $expenseTypes
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

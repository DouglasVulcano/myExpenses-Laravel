<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function index() {
        return view('index');
    }

    public function dashboard() {
        $user = auth()->user();

        $expenses = Expense::all();

        $userName = $user->name;

        return view('expenses.dashboard', [
                                            'userName' => $userName,
                                            'expenses' => $expenses
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
}

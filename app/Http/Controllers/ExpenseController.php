<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseReport;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ExpenseReport $expenseReport
     * @return void
     */
    public function create(ExpenseReport $expenseReport)
    {
        return view('expense.create',[
            'report' =>$expenseReport
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ExpenseReport $expenseReport
     * @return void
     */
    public function store(Request $request, ExpenseReport $expenseReport)
    {
       $expense = new Expense();
        $validDescription = $request->validate([
            'description'=>'required|min:3'
        ]);
        $validAmount = $request->validate([
            'amount'=>'required|gt:0'
        ]);
       $expense->description = $validDescription[ 'description'];
       $expense->amount = $validAmount['amount'];
       $expense->expense_report_id = $expenseReport->id;

       $expense->save();
       return redirect('/expense_reports/'.$expenseReport->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ExpenseReport $expenseReport
     * @param Expense $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseReport $expenseReport, Expense $expense )
    {
//       dd($expenseReport, $expense);

//        $report = ExpenseReport::find($id1);
//        $expense = Expense::find($id2);
        $expense->delete();

        return redirect('/expense_reports/'.$expenseReport->id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseReport;
use App\Mail\SummaryReport;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ExpenseReportController extends Controller
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
        //return ExpenseReport::all();

        return view('expenseReport.index', [
            'expenseReports' => ExpenseReport::where('user_id',Auth::user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenseReport.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd(Auth::user()->name);

        $validData = $request->validate([
           'title'=>'required|min:3'
        ]);
        $report = new ExpenseReport();
        $report->title =$validData['title'];
        $report->user_id= Auth::user()->id;
        $report->save();

        return redirect('/expense_reports');
    }

    /**
     * Display the specified resource.
     *
     * @param ExpenseReport $expenseReport
     * @param Expense $expense
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseReport $expenseReport)
    {
        return view('expenseReport.show',
            ['report'=>$expenseReport
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = ExpenseReport::findOrFail($id);

        return view('expenseReport.edit',
            ['report'=>$report
        ]);
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
        $report = ExpenseReport::find($id);
        $validData = $request->validate([
            'title'=>'required|min:3'
        ]);
        $report->title = $validData['title'];
        $report->save();

        return redirect('/expense_reports');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = ExpenseReport::find($id);
        $report->delete();

        return redirect('/expense_reports');

    }

    public function confirmDelete($id){
        $report = ExpenseReport::find($id);
       return view('/expenseReport.confirmDelete',[
           'report'=> $report
       ]);
    }

    public function confirmSendEmail($id){
        $report = ExpenseReport::find($id);
        return view('/expenseReport.confirmSendEmail',[
            'report'=> $report
        ]);
    }

    public function sendEmail(Request $request, $id){
        $report = ExpenseReport::find($id);
        var_dump($request->get('email'));
        Mail::to($request->get('email'))->send(new SummaryReport($report));
        return redirect('/expense_reports/'.$id);
    }
}

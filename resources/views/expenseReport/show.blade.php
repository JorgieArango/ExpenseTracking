@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h1> Report: {{$report->title}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="/expense_reports">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-primary" href="/expense_reports/{{$report->id}}/confirmSendEmail">Send email</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h3>Details</h3>

            <table class="table">
                @foreach($report->expenses as $expense)
                    <tr>
                        <td>{{$expense->id}}</td>
                        <td>{{$expense->description}}</td>
                        <td>{{$expense->created_at}}</td>
                        <td>{{$expense->amount}}</td>

                        <td>
                            <form action="/expense_reports/{{$report->id}}/expenses/{{$expense->id}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn ">Delete</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </table>

        </div>
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-primary" href="/expense_reports/{{$report-> id}}/expenses/create">New expense</a>
        </div>
    </div>
@endsection

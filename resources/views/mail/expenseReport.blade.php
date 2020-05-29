<div class="row">
    <div class="col">
        <h1>Expense Report {{ $report->id }}: {{ $report->title }}</h1>
    </div>
</div>
<div class="row">
    <div class="col">
        <h2>Expenses</h2>
        <table class="table">
            @foreach($report->expenses as $expenses)
                <tr>
                    <td>{{$expenses->description}}</td>
                    <td>{{$expenses->created_at}}</td>
                    <td>{{$expenses->amount}}</td>

                </tr>
            @endforeach
        </table>
    </div>
</div>

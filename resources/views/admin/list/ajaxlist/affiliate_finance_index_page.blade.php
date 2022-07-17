<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Affiliate Name</th>
                <th>For the month</th>
                <th>Closing Balance</th>
                <th>Pay Out</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($statements as $key => $statement)
            <tr>
                <td>
                    {{$key+1}}
                </td>
                <td>
                    {{ucwords($statement->affiliate_name)}}
                </td>
                <td>
                    {{ date("M", mktime(0, 0, 0, $statement->month, 1)) }}, {{$statement->year}}
                </td>
                <td>
                    {{$statement->closing_balance}}
                </td>
                <td>
                    {{$statement->payout}}
                </td>
                <td>
                    <a href="{{route('admin.view.affiliate.monthly.statement',$statement->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye font-14"></i></a>
                    <!-- <a href="#" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a> -->
                </td>
            </tr>
            @empty
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>No data available in table</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
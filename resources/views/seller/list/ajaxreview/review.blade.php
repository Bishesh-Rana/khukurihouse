<div class="table-responsive hatauney">
    <table class="table">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Product Name</th>
                <th>Customer Name</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products_review as $key => $row)
            <tr>
            <td>{{ ++$key  }}</td>
            <td>{{ $row->product_name }}</td>   
            <td>{{ $row->customer_name }}</td> 
            <td>{{ $row->rating }}</td> 
            <td>{!! $row->review !!}</td>
            <td>
            <a href="{{ route('seller.review.reply.page', $row->review_id) }}" class="btn btn-primary">Reply</a>
            </td>
              
            </tr>
            @endforeach
          
        </tbody>
    </table>
    {{$products_review->links()}}

</div>
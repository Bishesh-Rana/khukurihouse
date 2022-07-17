<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Parent Category</th>
                <th>Total Products</th>
                <th>Category Image</th>
                <th>Active Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody  id="tablecontents">
            @foreach($categories as $key => $category)
            <tr class="row1" data-id="{{ $category->id }}">
                <td>
                    {{$key+1}}
                </td>
                <td>
                    {{ucwords($category->category_name)}}
                </td>
                <td>
                    <span class="label label-warning">{{$category->parent_category}}</span>
                </td>
                <td>
                    {{$category->products()->count()}}
                </td>
                <td>
                    <img src="{{asset('')}}uploads/categories/{{$category->image}}" height="50" width="50" alt="{{$category->category_name}}">
                </td>
                <td>
                    @if($category->publish_status == 1)
                    <span class="badge badge-success m-r-5 m-b-5">Active</span>
                    @else
                    <span class="badge badge-danger m-r-5 m-b-5">Banned</span>
                    @endif
                </td>
                <td>
                    <a href="{{url('/ns-admin/categories/view/'.$category->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye font-14"></i></a>
                    <a href="{{url('/ns-admin/categories/edit/'.$category->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                    <a href="{{url('/ns-admin/categories/delete/'.$category->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$categories->onEachSide(1)->links()}}

</div>
@push('scripts')

  <!-- jQuery UI -->
  <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>

  <!-- Datatables Js-->
  <script type="text/javascript" src="//cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

  <script type="text/javascript">
  $(function () {
    // $("#table").DataTable();

    $( "#tablecontents" ).sortable({
      items: "tr",
      cursor: 'move',
      opacity: 0.6,
      update: function() {
          sendOrderToServer();
      }
    });

    function sendOrderToServer() {

      var position = [];
      $('tr.row1').each(function(index,element) {
        position.push({
          id: $(this).attr('data-id'),
          position: index+1
        });
      });

      $.ajax({
        type: "POST",
        dataType: "json",
        url: "{{ route('updateOrderCategory') }}",
        data: {
          position:position,
          _token: '{{csrf_token()}}'
        },
        success: function(response) {
            console.log(response);
            location.reload();
            Lobibox.notify('success', {
                        size: 'mini',
                        soundPath: '{{ asset('') }}admincast/assets/lobibox/sounds/',
                        sound: 'sound4',
                        icon: 'fa fa-check',
                        iconSource: "fontAwesome",
                        showClass: 'fadeInDown',
                        hideClass: 'fadeUpDown',
                        width: 400,
                        rounded: true,
                        msg: 'Position changed',
                        delay: 3000,
                        delayIndicator: false,
                    });
            
        }
      });

    }
  });

</script>

@endpush
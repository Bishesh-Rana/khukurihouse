@section('title')

Contents | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Contents</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <a class="btn btn-outline-primary" href="{{url('/ns-admin/contents/create')}}"><i class="fa fa-plus"></i> Add Content</a>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Contents</div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')

            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Content Title</th>
                        <th>Content Image</th>
                        <th>Content Type</th>
                        <th>Show On</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tablecontents">
                    @php $i = 1 @endphp
                    @foreach($contents as $row)
                    <tr  class="row1" data-id="{{ $row->id }}">
                        <td>
                            {{$i}}
                        </td>
                        <td>{{ucwords($row->content_title)}}</td>
                        <td>
                            @if(isset($row->featured_img))
                            <img src="{{asset('')}}uploads/contents/{{$row->featured_img}}" alt="{{$row->content_title}} Image" height="50" width="50">
                            @endif
                        </td>
                        <td>
                        <span class="badge badge-info m-r-5 m-b-5">{{$row->content_type}}</span>
                        </td>
                        <td>
                            @if($row->show_on_menu == "N")
                            <span class="badge badge-danger m-r-5 m-b-5">None</span>
                            @elseif($row->show_on_menu == "H")
                            <span class="badge badge-warning m-r-5 m-b-5">Header</span>
                            @elseif($row->show_on_menu == "F")
                            <span class="badge badge-warning m-r-5 m-b-5">Footer</span>
                            @else
                            <span class="badge badge-success m-r-5 m-b-5">Both</span>
                            @endif
                        </td>
                        <td>
                            @if($row->publish_status == 1)
                            <span class="badge badge-success m-r-5 m-b-5">Active</span>
                            @else
                            <span class="badge badge-danger m-r-5 m-b-5">Banned</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('/ns-admin/contents/edit/'.$row->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                            <a href="{{url('/ns-admin/contents/delete/'.$row->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a>
                        </td>
                    </tr>
                    @php $i++ @endphp
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->
{{-- <button class="btn btn-primary" onclick="window.location.reload()"><b>UPDATE POSITION</b></button> --}}
@stop
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
        url: "{{ route('updateOrderContents') }}",
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

@extends('layout.master')
@section('order-open', 'menu-open')
@section('order-list', 'active')
@section('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('title')
    order-list
@endsection
@section('content_header_name')
    Danh sách đơn hàng
@endsection
@section('redirect_to_list')
    <a href="{{route('admin.order.list')}}">
        Danh sách đơn hàng
    </a>
@endsection
@section('content')
    <div class="card-body" style="width: 100%; overflow: scroll">
        <table id="personnel" class="table table-bordered table-striped" style="margin-top: 0">
            <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá tiền</th>
                <th>Khách hàng</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $item)
                @foreach($item['orderProduct'] as $product)
                    <tr>
                        <td>{{$product['product']['name']}}</td>
                        <td>{{$product['count']}}</td>
                        <td>{{$product['product_price']}}</td>
                        <td>
                            {{$item['customer']['name']}}
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('js')
    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

    <script>
        $(function () {
            $('#personnel').DataTable();
        });

        $('#district').on('change', function (e) {
            var cat_id = e.target.value;

            $.get('/ajax-get-commune?cat_id=' + cat_id, function (data) {
                $('#commune').empty();
                $('#commune').append('<option value="">Lựa chọn quận huyện</option>');
                $.each(data, function (index, commune) {
                    $('#commune').append('<option value="'+commune.id+'">'+commune.name+'</option>');
                })
            })
        });
    </script>
@endsection

@extends('layout.master')
@section('customer-open', 'menu-open')
@section('customer-list', 'active')
@section('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('title')
    customer-list
@endsection
@section('content_header_name')
    Danh sách khách hàng
@endsection
@section('redirect_to_list')
    <a href="{{route('admin.customer.list')}}">
        Danh sách khách hàng
    </a>
@endsection
@section('content')
    <div class="card-body" style="width: 100%; overflow: scroll">
        <table id="customer" class="table table-bordered table-striped" style="margin-top: 0">
            <thead>
            <tr>
                <th>Tên khách hàng</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Note</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->address}}</td>
                    <td>{{$item->note}}</td>
                </tr>
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
            $('#customer').DataTable();
        });
    </script>
@endsection

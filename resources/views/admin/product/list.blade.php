@extends('layout.master')
@section('product-open', 'menu-open')
@section('product-list', 'active')
@section('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('title')
    product-list
@endsection
@section('content_header_name')
    Danh sách sản phẩm
@endsection
@section('redirect_to_list')
    <a href="{{route('admin.product.list')}}">
        Danh sách sản phẩm
    </a>
@endsection
@section('content')
    <div class="col-md-12">
        <a class="btn btn-primary float-right" href="{{route('admin.product.form.get')}}">
            Tạo mới sản phẩm
        </a>
        {{--        <a class="btn btn-primary float-right" href="{{route('admin.personnel.category.export-excel')}}" style="margin-right: 5px">--}}
        {{--            Tải xuống Excel--}}
        {{--        </a>--}}
    </div>
    <div class="card-body" style="width: 100%; overflow: scroll">
        <table id="product" class="table table-bordered table-striped" style="margin-top: 0;width: 2000px">
            <thead>
            <tr>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Đơn giá</th>
                <th>Giá khuyến mãi</th>
                <th>Số lượng</th>
                <th>Trạng thái</th>
                <th>Loại giá</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $item)
                <tr>
                    <td>{{$item->code}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->category->name}}</td>
                    <td>{{$item->unit_price}}</td>
                    <td>{{$item->promotion_price}}</td>
                    <td>{{$item->count}}</td>
                    <td><input type="checkbox" data-toggle="toggle" id="status" data-on="Hoạt động" data-off="Không"
                            {{$item->status == 1 ? 'checked' : ''}}></td>
                    <td><input type="checkbox" data-toggle="toggle" id="price_applied" data-on="Đơn giá" data-off="Khuyến mại"
                            {{$item->price_applied == 1 ? 'checked' : ''}}></td>
                    <td><input type="checkbox" data-toggle="toggle" id="is_new" data-on="Mới" data-off="Cũ"
                            {{$item->is_new == 1 ? 'checked' : ''}}></td>
                    <td class="text-center">
                        <a href="{{route('admin.product.form.edit', $item->id)}}"><i class="fa fa-edit"></i></a>
                        <a href="{{route('admin.product.delete', $item->id)}}"><i class="fa fa-trash"></i></a>
                    </td>
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
            $('#product').DataTable();
        });
    </script>
@endsection

@extends('layout.master')
@section('statistical-open', 'menu-open')
@section('statistical-list', 'active')
@section('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('title')
    statistical-list
@endsection
@section('content_header_name')
    Thống kê
@endsection
@section('redirect_to_list')
    <a href="{{route('admin.statistical.list')}}">
        Thống kê
    </a>
@endsection
@section('content')
    <div class="col-md-12">
        <a class="btn btn-primary float-right" href="{{route('admin.category.form.get')}}">
            Tạo mới danh mục
        </a>
        {{--        <a class="btn btn-primary float-right" href="{{route('admin.personnel.category.export-excel')}}" style="margin-right: 5px">--}}
        {{--            Tải xuống Excel--}}
        {{--        </a>--}}
    </div>
    <div class="card-body" style="width: 100%; overflow: scroll">
        <table id="personnel" class="table table-bordered table-striped" style="margin-top: 0;width: 2000px">
            <thead>
            <tr>
                <th>Mã danh mục</th>
                <th>Tên danh mục</th>
                <th>Danh mục cha</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $item)
                <tr>
                    <td>{{$item->code}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item['parent']['name']}}</td>
                    <td class="text-center">
                        <a href="{{route('admin.category.form.edit', $item->id)}}"><i class="fa fa-edit"></i></a>
                        <a href="{{route('admin.category.delete', $item->id)}}"><i class="fa fa-trash"></i></a>
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

@extends('layout.master')
@section('category-open', 'menu-open')
@section('category-list', 'active')
@section('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('title')
    category-list
@endsection
@section('content_header_name')
    Danh sách danh mục
@endsection
@section('redirect_to_list')
    <a href="{{route('admin.category.list')}}">
        Danh sách danh mục
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
    <div class="card-body">
        <table id="category" class="table table-bordered table-striped" style="margin-top: 0">
            <thead>
            <tr>
                <th>Mã danh mục</th>
                <th>Tên danh mục</th>
                <th>Hạng mục cha 1</th>
                <th>Hạng mục cha 2</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $item)
                <tr>
                    <td>{{$item->code}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item['parent1']['name']}}</td>
                    <td>{{$item['parent2']['name']}}</td>
                    <td class="text-center">
                        <a href="{{route('admin.category.form.edit', $item->id)}}"><i class="fa fa-edit"></i></a>
                        <a href="{{route('admin.category.delete', $item->id)}}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @foreach($item['child1'] as $child1)
                    <tr>
                        <td>{{$child1->code}} ---</td>
                        <td>{{$child1->name}}</td>
                        <td>{{$child1['parent1']['name']}}</td>
                        <td>{{$child1['parent2']['name']}}</td>
                        <td class="text-center">
                            <a href="{{route('admin.category.form.edit', $child1->id)}}"><i class="fa fa-edit"></i></a>
                            <a href="{{route('admin.category.delete', $child1->id)}}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @foreach($child1['child2'] as $child2)
                        <tr>
                            <td>{{$child2->code}} ------</td>
                            <td>{{$child2->name}}</td>
                            <td>{{$child2['parent1']['name']}}</td>
                            <td>{{$child2['parent2']['name']}}</td>
                            <td class="text-center">
                                <a href="{{route('admin.category.form.edit', $child2->id)}}"><i class="fa fa-edit"></i></a>
                                <a href="{{route('admin.category.delete', $child2->id)}}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
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
            $('#category').DataTable();
        });
    </script>
@endsection

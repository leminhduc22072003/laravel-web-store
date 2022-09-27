@extends('layout.master')
@section('category-open', 'menu-open')
@section('category-list', 'active')
@section('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('title')
    category
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
        <form method="get" action="{{route('admin.personnel.product.filter')}}">
            <div class="col-md-2 float-left">
                <div class="form-group">
                    <select class="form-control select2" name="district_id" id="district" style="width: 100%;">
                        <option value="">Lựa chọn quận/ huyện</option>
                        @foreach($districts as $k => $item)
                            <option value="{{$k}}">{{$item}}</option>
                        @endforeach
                    </select>
                    @error('district_id')
                    <p class="danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="col-md-2 float-left">
                <div class="form-group">
                    <select class="form-control select2" name="commune_id" id="commune" style="width: 100%;">
                        <option value="">Lựa chọn phường/ xã</option>
                    </select>
                    @error('commune_id')
                    <p class="danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="col-md-2 float-left">
                <button type="submit" class="btn btn-primary">Bộ lọc</button>
            </div>
        </form>
        <a class="btn btn-primary float-right" href="{{route('admin.personnel.product.form.get')}}">
            Tạo mới cán bộ quản lý
        </a>
        <a class="btn btn-primary float-right" href="{{route('admin.personnel.product.export-excel')}}" style="margin-right: 5px">
            Tải xuống Excel
        </a>
    </div>
    <div class="card-body" style="width: 100%; overflow: scroll">
        <table id="personnel" class="table table-bordered table-striped" style="margin-top: 0;width: 2000px">
            <thead>
            <tr>
                <th>Mã cán bộ quản lý</th>
                <th>Họ và tên</th>
                <th>Ảnh đại diện</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Số điện thoại</th>
                <th>Thư điện tử</th>
                <th>Quận/huyện</th>
                <th>Phường/xã</th>
                <th>Địa chỉ</th>
                <th>Trường</th>
                <th>Ngày vào làm việc</th>
                <th>Trình độ học vấn</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($managers as $item)
                <tr>
                    <td>{{$item->code}}</td>
                    <td>{{$item->name}}</td>
                    <td>
                        @if(!empty($item->avatar))
                            <a href="{{asset('storage/'.$item->avatar)}}" class="fancybox" rel="group" >
                                <img id="avatar" style="max-width: 100px; height: 50px" src="{{asset('storage/'.$item->avatar)}}" alt="avatar"/>
                            </a>
                        @endif
                    </td>
                    <td>{{$item->birthday}}</td>
                    <td>{{config('base.gender')[$item->gender]}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item['district']['name']}}</td>
                    <td>{{$item['commune']['name']}}</td>
                    <td>{{$item->address}}</td>
                    <td>{{$item['school']['name']}}</td>
                    <td>{{$item->year}}</td>
                    <td>{{config('base.level_of_personnel')[$item->level]}}</td>
                    <td class="text-center">
                        <a href="{{route('admin.personnel.product.form.edit', $item->id)}}"><i class="fa fa-edit"></i></a>
                        <a href="{{route('admin.personnel.product.delete', $item->id)}}"><i class="fa fa-trash"></i></a>
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

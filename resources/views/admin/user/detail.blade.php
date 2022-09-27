@extends('layout.master')
@section('title')
    hospital
@endsection
@section('content_header_name')
    Chi tiết trung tâm y tế
@endsection
@section('redirect_to_list')
    <a href="{{route('admin.user.list')}}">
        Danh sách người dùng
    </a>
@endsection
@section('user', 'active')
@section('content_header_active')
    Chi tiết trung tâm y tế
@endsection
@section('content')
@endsection

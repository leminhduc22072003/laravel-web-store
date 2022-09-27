@extends('layout.master')
@section('title')
    Trang chủ
@endsection
@section('content_header_name')
    Trang chủ
@endsection
@section('content_header_active')
    Trang chủ
@endsection
@section('css')
    <script src="{{asset('highchart/code/highcharts.js')}}"></script>
    <script src="{{asset('highchart/code/modules/exporting.js')}}"></script>
    <script src="{{asset('highchart/code/modules/export-data.js')}}"></script>
@endsection
@section('content')
{{--    <input type="hidden" id="district" value="{{$data}}">--}}
    <div class="row">
    </div>
@endsection
@section('js')
    <script>
        Highcharts.setOptions( {
            lang: {
                downloadCSV:"Tải xuống CSV",
                downloadJPEG:"Tải xuống JPEG",
                downloadPDF:"Tải xuống PDF",
                downloadPNG:"Tải xuống PNG",
                downloadSVG:"Tải xuống SVG",
                downloadXLS:"Tải xuống XLS",
                viewData:"Xem bảng dữ liệu",
                viewFullscreen:"Xem toàn cảnh",
                printChart:"In biểu đồ",
                openInCloud:"Xem trên Highchart đám mây",
            }
        });
    </script>
@endsection

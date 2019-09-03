@extends('layout.template')

@section('title','صفحة الأدمن')
@section('title_content','الشركات')
@section('sidebar')
    <ul class="nav" id="side-menu">
        <li>
            <a href="{{ route('company.index') }}"><i class="fa fa-dashboard fa-fw"></i> الشركات</a>
        </li>
    </ul>
@endsection
@section('content')
@endsection
@section('jsFooter')
    <script>
        $('#dataTables-example').dataTable();
    </script>
@endsection


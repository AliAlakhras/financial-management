@extends('layout.template')

@section('title','صفحة الشركة')

@section('title_content','المحفظة')

@section('sidebar')
    <ul class="nav" id="side-menu">
        <li>
            <a href="{{ route('user.index') }}"><i class="fa fa-dashboard fa-fw"></i> الشركة</a>
        </li>
        <li>
            <a href="{{ route('user.employees') }}"><i class="fa fa-dashboard fa-fw"></i> الموظفين</a>
        </li>
        <li>
            <a href="{{ route('user.vendors') }}"><i class="fa fa-dashboard fa-fw"></i> الموردين</a>
        </li>
        <li>
            <a href="{{ route('wallet.index') }}"><i class="fa fa-dashboard fa-fw"></i> المحفظة</a>
        </li>
        <li>
            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> عمليات البيع</a>
        </li>
        <li>
            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> عمليات الشراء</a>
        </li>
        <li>
            <a href="{{ route('product.index') }}"><i class="fa fa-dashboard fa-fw"></i> المخزن</a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="col-md-8">
    <form class="form-signin" action="{{ route('product.update', $product->id) }}" method="post">
        @csrf
        {{ method_field('put') }}
        <h1 class="h3 mb-3 font-weight-normal">الرجاء تعديل البيانات</h1>

        <input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="الاسم" required>

        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">تعديل</button>
        </div>
    </form>
    </div>
@endsection
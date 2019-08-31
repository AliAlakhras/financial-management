@extends('layout.template')

@section('title','صفحة المستخدم')

@section('title_content','المصروفات')

@section('sidebar')
    <ul class="nav" id="side-menu">
        <li>
            <a href="{{ route('user.employeePage') }}"><i class="fa fa-dashboard fa-fw"></i> صفحة المستخدم</a>
        </li>
        <li>
            <a href="{{ route('expense.getExpensesForEmployee') }}"><i class="fa fa-dashboard fa-fw"></i> المصروفات</a>
        </li>
        <li>
            <a href="{{ route('purchase.getPurchasesForEmployee') }}"><i class="fa fa-dashboard fa-fw"></i> عمليات الشراء</a>
        </li>
        <li>
            <a href="{{ route('sale.getSalesForEmployee') }}"><i class="fa fa-dashboard fa-fw"></i> عمليات البيع</a>
        </li>
        <li>
            <a href="{{ route('product.getProductsForEmployee') }}"><i class="fa fa-dashboard fa-fw"></i> المخزن</a>
        </li>
        <li>
            <a href="{{ route('debt.getDebtsForEmployee') }}"><i class="fa fa-dashboard fa-fw"></i> الديون</a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="col-md-8">
    <form class="form-signin" action="{{ route('expense.store') }}" method="post">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal">الرجاء إدخال البيانات</h1>

        <input type="text" class="form-control" name="name" placeholder="الاسم" required>
        <input type="text" class="form-control" name="price" placeholder="المبلغ" required>

        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">إضافة</button>
        </div>
    </form>
    </div>
@endsection

@extends('layout.template')

@section('title','صفحة الشركة')

@section('title_content','إعدادات الشركة')

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
            <a href="{{ route('expense.index') }}"><i class="fa fa-dashboard fa-fw"></i> المصروفات</a>
        </li>
        <li>
            <a href="{{ route('sale.index') }}"><i class="fa fa-dashboard fa-fw"></i> عمليات البيع</a>
        </li>
        <li>
            <a href="{{ route('purchase.index') }}"><i class="fa fa-dashboard fa-fw"></i> عمليات الشراء</a>
        </li>
        <li>
            <a href="{{ route('product.index') }}"><i class="fa fa-dashboard fa-fw"></i> المخزن</a>
        </li>
        <li>
            <a href="{{ route('debt.index') }}"><i class="fa fa-dashboard fa-fw"></i> الديون</a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading"> معلومات المستخدم</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>الاسم</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>الايميل</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>صلاحيات المستخدم</th>
                            <td>
                                @foreach($role_company as $role)
                                    @if($role->type == 'admin')
                                        مسؤول
                                    @else
                                        موظف
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading"> المصروفات</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>الاسم</th>
                            <th>السعر</th>
                        </tr>
                        @foreach($expenses as $expense)
                            <tr>
                                <td>{{ $expense->name }}</td>
                                <td>{{ $expense->price }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="panel-heading"><b>
                    إجمالي المصروفات: {{ $expenses->sum('price') }}
                </b>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">عمليات الشراء</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>اسم المنتج</th>
                            <th>الكمية</th>
                            <th>التكلفة</th>
                            <th>الإجمالي</th>
                            <th>المورد</th>
                            <th>بتاريخ</th>
                        </tr>
                        @foreach($purchases as $purchase)
                            <tr>
                                @foreach($products as $product)
                                    @foreach($purchase->purchasedetailes as $purch)
                                        @if($product->id == $purch->product_id)
                                            <td>{{ $product->name }}</td>
                                        @endif
                                    @endforeach
                                @endforeach
                                @foreach($purchase->purchasedetailes as $purch)
                                    <td>{{ $purch->quantity }}</td>
                                @endforeach
                                @foreach($purchase->purchasedetailes as $purch)
                                    <td>{{ $purch->cost }}</td>
                                @endforeach
                                <td>{{ $purchase->total }}</td>
                                @foreach($users as $user)
                                    @if($user->id == $purchase->vendor_id)
                                        <td>{{ $user->name  }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $purchase->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="panel-heading"><b>
                    إجمالي المشتريات: {{ $purchases->sum('total') }}
                </b>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">عمليات البيع</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>اسم المنتج</th>
                            <th>الكمية</th>
                            <th>التكلفة</th>
                            <th>الإجمالي</th>
                            <th>بتاريخ</th>
                        </tr>
                        @foreach($sales as $sale)
                            <tr>
                                @foreach($products as $product)
                                    @if($product->id == $sale->product_id)
                                        <td>{{ $product->name }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $sale->quantity }}</td>
                                <td>{{ $sale->cost }}</td>
                                <td>{{ $sale->total }}</td>
                                <td>{{ $sale->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="panel-heading"><b>
                    إجمالي المبيعات: {{ $sales->sum('total') }}
                </b>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">الديون</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>اسم المورد</th>
                            <th>الإجمالي</th>
                            <th>تم دفعه</th>
                            <th>الباقي</th>
                        </tr>
                        @foreach($purchases_debts as $purchase_debt)
                            @foreach($purchase_debt->debts as $debt)
                                <tr>
                                    @foreach($users as $user)
                                        @if($user->id == $purchase_debt->vendor_id)
                                            <td>{{ $user->name }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ $debt->paid + $debt->due }}</td>
                                    <td>{{ $debt->paid }}</td>
                                    <td>{{ $debt->due }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

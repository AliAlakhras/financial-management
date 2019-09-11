@extends('layout.template')

@section('title','صفحة الشركة')

@section('title_content','إعدادات الشركة')

@section('sidebar')
    <ul class="nav in" id="side-menu">
        <li>
            <a href="{{ route('user.index') }}"><i class="fa fa-dashboard fa-fw"></i> الشركة</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-files-o fa-fw"></i> الموظفين<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('user.employees') }}">عرض الموظفين</a>
                </li>
                <li>
                    <a href="{{ route('user.create') }}">إضافة موظف</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-files-o fa-fw"></i> الموردين<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('user.vendors') }}">عرض الموردين</a>
                </li>
                <li>
                    <a href="{{ route('user.createVendorFromCompanyAdmin') }}">إضافة مورد</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-files-o fa-fw"></i> المحفظة<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('wallet.index') }}">عرض </a>
                </li>
                <li>
                    <a href="{{ route('wallet.create') }}">إضافة رصيد</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-files-o fa-fw"></i> المصروفات<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('expense.index') }}">عرض المصروفات</a>
                </li>
                <li>
                    <a href="{{ route('expense.create') }}">إضافة مصروف</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-files-o fa-fw"></i>عمليات البيع<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('sale.index') }}">عرض المبيعات</a>
                </li>
                <li>
                    <a href="{{ route('sale.create') }}">إضافة عملية بيع</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-files-o fa-fw"></i>عمليات الشراء<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('purchase.index') }}">عرض المشتريات</a>
                </li>
                <li>
                    <a href="{{ route('purchase.create') }}">إضافة عملية شراء</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-files-o fa-fw"></i>المخزن<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('product.index') }}">عرض</a>
                </li>
                <li>
                    <a href="{{ route('product.create') }}">إضافة منتج</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('debt.index') }}"><i class="fa fa-dashboard fa-fw"></i> الديون</a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <div class="huge">{{ $users }}</div>
                            <div>الموظفين</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('user.employees') }}">
                    <div class="panel-footer">
                        <span class="pull-left"><i class="fa fa-arrow-circle-right"></i></span>
                        <span class="pull-right">عرض</span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <div class="huge">{{ $vendors }}</div>
                            <div>الموردين</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('user.vendors') }}">
                    <div class="panel-footer">
                        <span class="pull-left"><i class="fa fa-arrow-circle-right"></i></span>
                        <span class="pull-right">عرض</span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <div class="huge">{{ $purchases }}</div>
                            <div>عمليات الشراء</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('purchase.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left"><i class="fa fa-arrow-circle-right"></i></span>
                        <span class="pull-right">عرض</span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <div class="huge">{{ $sales }}</div>
                            <div>عمليات البيع</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('sale.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left"><i class="fa fa-arrow-circle-right"></i></span>
                        <span class="pull-right">عرض</span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div align="center">
        <div style="width: 33.33%; height: 300px; display: inline-block">
            {!! $walletChart->container() !!}
        </div>
        <div style="width: 33.33%; height: 300px; display: inline-block">
            {!! $productChart->container() !!}
        </div>
    </div>


@endsection

@section('jsFooter')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $walletChart->script() !!}
    {!! $productChart->script() !!}
@endsection

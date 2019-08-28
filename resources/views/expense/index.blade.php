@extends('layout.template')

@section('title','صفحة الشركة')

@section('title_content','المصروفات')

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
            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> عمليات البيع</a>
        </li>
        <li>
            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> عمليات الشراء</a>
        </li>
        <li>
            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> المخزن</a>
        </li>
    </ul>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('fail'))
        <div class="alert alert-danger">
            {{ session('fail') }}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr style="text-align: center;">
                        <th scope="col" style="text-align: center;">م</th>
                        <th scope="col" style="text-align: center;">الاسم</th>
                        <th scope="col" style="text-align: center;">السعر</th>
                        <th scope="col" style="text-align: center;">بواسطة</th>
                        <th scope="col" style="text-align: center;">بتاريخ</th>
                        <th scope="col" style="text-align: center;">العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($expenses)
                        @foreach($expenses as $expense)
                            <th scope="row" style="text-align: center;">{{ $expense->id }}</th>
                            <td>{{ $expense->name }}</td>
                            <td>{{ $expense->price }}</td>
                            @foreach($users as $user)
                                @if($user->id == $expense->user_id)
                                    <td>{{ $user->name  }}</td>
                                @endif
                            @endforeach
                            <td>{{ $expense->created_at }}</td>
                            <td>
                                <a href="{{ route('expense.edit', $expense->id) }}" class="btn btn-primary"
                                   role="button">@lang('company.edit')</a>
                                <form action="{{ route('expense.destroy', $expense->id) }}" method="post"
                                      style="display: inline">
                                    @csrf
                                    {{ method_field('delete') }}
                                    <button class="btn btn-danger" type="submit">
                                        @lang('company.delete')
                                    </button>
                                </form>
                            </td>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">No data</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

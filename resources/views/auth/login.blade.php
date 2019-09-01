<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>مصاريفي</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

    <!-- not use this in ltr -->
<!--<link href="{{ asset('template/css/bootstrap.rtl.css ') }}" rel="stylesheet" type="text/css">-->

    <!-- MetisMenu CSS -->
    <link href="{{ asset('template/css/plugins/metisMenu/metisMenu.min.css ') }}" rel="stylesheet" type="text/css">

    <!-- Timeline CSS -->
    <link href="{{ asset('template/css/plugins/timeline.css ') }}" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="{{ asset('template/css/sb-admin-2.css ') }}" rel="stylesheet" type="text/css">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('template/css/plugins/morris.css ') }}" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="{{ asset('template/css/font-awesome/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">@lang('auth.login')</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('login') }}" role="form">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-primary">
                                @lang('auth.login')
                            </button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery Version 1.11.0 -->
<script src="{{ asset('template/js/jquery-1.11.0.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('template/js/bootstrap.min.js') }}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{ asset('template/js/metisMenu/metisMenu.min.js') }}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{ asset('template/js/sb-admin-2.js') }}"></script>

</body>

</html>

@extends('layout.template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('auth.login')</div>
                    <div class="card-body ">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md">
                                        @lang('auth.email')
                                    </label>

                                    <div class="col-md-6">
                                        <input type="email" name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md">
                                    @lang('auth.password')
                                </label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">
                                        @lang('auth.login')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

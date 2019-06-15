@extends('layouts.styleAndScript')

@section('content')

<body class="app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-body mx-4">
                    <h1>Register</h1>
                    <p class="text-muted">Create your account</p>
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <label for="name" class="col-md-4 control-label">用户名</label>
                        <div class="input-group mb-3 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-user"></i>
                                </span>
                            </div>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                required autofocus placeholder="Username">
                        </div>
                        <label for="email" class="col-md-4 control-label">邮箱地址</label>
                        <div class="input-group mb-3 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                required placeholder="Email">
                        </div>
                        <label for="password" class="col-md-4 control-label">密码</label>
                        <div class="input-group mb-3 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-lock"></i>
                                </span>
                            </div>
                            <input id="password" type="password" class="form-control" name="password" required
                                placeholder="Password">
                        </div>
                        <label for="password-confirm" class="col-md-4 control-label">确认密码</label>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-lock"></i>
                                </span>
                            </div>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required placeholder="Repeat password">
                        </div>
                        <button class="btn btn-block btn-success" type="submit">创建用户</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        function modal(error) {
                return `
                <div class="w-100 alert alert-danger position-relative" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="alert-heading">错误!</h4>
                    <p>${error}</p>
                    
                </div>`
            }
    </script>
    @if ($errors->has('name'))
    <script>
        (function() {
                        $('.card-body').prepend(modal(`{!!$errors->first('name')!!}`))
                        
                    })()
    </script>
    @endif
    @if ($errors->has('password'))
    <script>
        (function() {
                        $('.card-body').prepend(modal(`{!!$errors->first('password')!!}`))
                        
                    })()
    </script>
    @endif
    @if ($errors->has('email'))
    <script>
        (function() {
                        $('.card-body').prepend(modal("{!!$errors->first('email')!!}"))
                        
                    })()
    </script>
    @endif
</body>
@endsection
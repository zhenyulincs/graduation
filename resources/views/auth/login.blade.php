@extends('layouts.styleAndScript')
@section('content')

<body class="app flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group">
          <div class="card p-4">
            <div class="card-body">
              <h1>登陆</h1>
              <p class="text-muted">登陆进去你的账号</p>
              <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <label for="email" class="control-label">邮箱地址</label>
                <div class="input-group mb-3 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-user"></i>
                    </span>
                  </div>
                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required
                    autofocus placeholder="Email">
                </div>
                <label for="password" class="control-label">密码</label>
                <div class="input-group mb-4 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-lock"></i>
                    </span>
                  </div>
                  <input id="password" type="password" class="form-control" name="password" required
                    placeholder="Password">
                </div>
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 记住我
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">登陆</button>
                  </div>
                  <div class="col-6 text-right">
                    <a href="{{ route('password.request') }}" class="btn btn-link px-0">忘记密码？</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center d-flex flex-column justify-content-center">
              <div>
                <h2>注册</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                  et dolore magna aliqua.</p>
                <button onclick="window.location.href = '{{asset('/register')}}'" class="btn btn-primary active mt-3" type="button">现在注册！</button>
              </div>
            </div>
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
      @if ($errors->has('password'))
      <script>
          (function() {
                  $($('.card-body')[0]).prepend(modal(`{!!$errors->first('password')!!}`))
                  
              })()
      </script>
      @endif
      @if ($errors->has('email'))
      <script>
          (function() {
                  $($('.card-body')[0]).prepend(modal("{!!$errors->first('email')!!}"))
                  
              })()
      </script>
      @endif
</body>

@endsection
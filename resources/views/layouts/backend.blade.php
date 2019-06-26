{{-- init model --}}
@php
$messages = \App\Message::where('receiverId',Auth::user()->id)->paginate(5);
$notification = \App\Message::where('receiverId',Auth::user()->id)->where('ifReady',false)->get();
@endphp



<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <base href="{{asset('/')}}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Icons-->
    <link href="css/coreui-icons.min.css" rel="stylesheet">
    <link href="css/flag-icon.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- Main styles for this application-->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/pace.min.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/dataTransfer.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
    
          function gtag() {
            dataLayer.push(arguments);
          }
          gtag('js', new Date());
          // Shared ID
          gtag('config', 'UA-118965717-3');
          // Bootstrap ID
          gtag('config', 'UA-118965717-5');
    </script>
    <style>
        .modal-backdrop {
            z-index: 1019;
        }
    </style>
</head>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Styles -->

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar position-relative">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="{{asset('admin')}}" class="navbar-brand">
            <img class="navbar-brand-full" src="img/logo.png" style="width:76%" alt="Logo">
        </a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <a class="nav-link" href="{{route('home')}}">home</a>
            </li>
            @if (Auth::User()->premission >= 1)
            <li class="nav-item px-3">
                <a class="nav-link" href="{{route('admin')}}">admin</a>
            </li>
            @endif
        </ul>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#exampleModal" data-toggle="modal">
                    <i class="icon-bell"></i>
                    @if (count($notification) > 0)
                    <span class="badge badge-pill badge-danger">
                        {{count($notification)}}
                    </span>
                    @endif
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <img class="img-avatar" src="img/avatars/6.jpg" alt="{{ Auth::user()->name }}">
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>{{ Auth::user()->name }}</strong>
                        <br>
                        @if (Auth::user()->premission >= 1)
                        <strong>管理员用户</strong>
                        @endif
                    </div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="fa fa-lock"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        </ul>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">收件箱</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>标题</th>
                                            <th>发送时间</th>
                                            <th>发送人</th>
                                            <th>是否已读</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($messages as $message)
                                        <tr class="message" style="cursor: pointer;">
                                            <td>{{$message->id}}</td>
                                            <td>{{$message->title}}</td>
                                            <td>{{$message->created_at}}</td>
                                            <td>{{Auth::user()->where('id',$message->senderId)->first()->email}}
                                            </td>
                                            @if ($message->ifReady == True)
                                            <td>
                                                <button class="message-static badge badge-secondary">已读</button>
                                            </td>
                                            @else
                                            <td>
                                                <button class="message-static badge badge-success">未读</button>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                                {{$messages->links()}}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </header>
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">
                        <i class="nav-icon icon-speedometer"></i> Dashboard
                        <span class="badge badge-primary">NEW</span>
                    </a>
                </li>
                <br>
                @if (Auth::User()->premission>=1)
                <li class="nav-item">
                    <a class="nav-link" href="{{asset('admin')}}">
                        <img class="nav-icon" src="img/usermanagement.png" alt="用户管理">
                        用户管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{asset('admin/message')}}">
                        <img src="img/message.png" class="nav-icon">信息发送</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{asset('admin/producesmanagement')}}">
                        <img class="nav-icon" src="img/producemanagement.png"> 商品管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{asset('admin/personalinfo')}}">
                        <img class="nav-icon" src="img/personalinfo.png"> 个人信息</a>
                </li>
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>
    <div class="main">
        @yield('content')
    </div>
    <!-- Scripts -->
    <script>
        $('.message').click(function() {
            var id = $(this).children().first().html()
            window.open('messagecheckout'+'/'+id)
        })
        $('.message .message-static').click(function(e) {
            var id = $(this).parents('td').siblings().first().html()
            e.stopPropagation()
            $.get('admin/message'+'?id='+id)
            $(this).toggleClass('badge-success')
            $(this).toggleClass('badge-secondary')
            if ($(this).html() == '已读') {
                $(this).html('未读')
            }
            else {
                $(this).html('已读')
            }
        })
    </script>
    <!-- CoreUI and necessary plugins-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/pace.min.js"></script>
    <script src="js/perfect-scrollbar.min.js"></script>
    <script src="js/coreui.min.js"></script>
</body>

</html>
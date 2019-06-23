@extends('layouts.backend')
@section('content')
<div class="col-11">
    <table class="produces-management ml-5 table table-hover text-center">
        <thead class="text-center">
            <tr>
                <label class="lable" for="id"></label>
                <th scope="col">id</th>
                <label class="lable" for="title"></label>
                <th scope="col">商品名字</th>
                <label class="lable" for="description"></label>
                <th scope="col">商品描述</th>
                <label class="lable" for="cover"></label>
                <th scope="col">封面链接</th>
                <label class="lable" for="left"></label>
                <th scope="col">货品剩余</th>
                <label class="lable" for="prices"></label>
                <th scope="col">价格</th>
                @if (Auth::User()->premission >= 1)
                <th scope="col">用户id</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($produces as $produce)
            <tr>
                <th class="id" scope="row">{{$produce->id}}</th>
                <td><input type="text" class="input form-control" value="{{$produce->title}}"></td>
                <td><input type="text" class="input form-control" value="{{$produce->description}}"></td>
                <td><input type="text" class="input form-control" value="{{$produce->cover}}"></td>
                <td><input type="number" class="input form-control" value="{{$produce->left}}"></td>
                <td><input type="number" class="input form-control" value="{{$produce->prices}}"></td>
                @if (Auth::User()->premission >= 1)
                <td>{{$produce->userid}}</td>
                @endif
                <td><button type="button" class="delete btn btn-outline-danger">删除商品</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if (count($produces)==0)
    <div class="text-center">数据库没有产品</div>
    @endif
    <div class="mr-5 float-right">
        {{$produces->links()}}
    </div>
</div>

<script>
    var currentUrl = window.location.pathname
    // for example: http://google.com/admin/test, this variable will return test
    var currentPath = currentUrl.split("/")[-1]
    $(".delete").click(function() {
        var id = $($('.id')[$(this).parent().parent().index()]).html()
        remove(id)
    })
    $(".input").change(function() {
    // get data value
        var data = $(this).val()
    // get the description of data
        var field = $($(".lable")[$(this).parent().index()]).attr("for")
    // get the id
        var id = parseInt($($('.id')[$(this).parent().parent().index()]).html())
        update(data,field,id)
    })

</script>
@endsection
@extends('layouts.app')

@section('content')
<div class="row">
    <div id="admin-menu" class="ml-5 list-group col-1">
        <a href="{{Request::root()}}/admin" class="text-center list-group-item list-group-item-action @if(isset($users))active @endif">用户管理</a>
        <a href="{{Request::root()}}/admin/producesmanagement" class="text-center list-group-item list-group-item-action @if(isset($produces))active @endif">商品管理</a>
    </div>
    <script>
        // swap active class
        $("#admin-menu .list-group-item").click(function() {
        $('#admin-menu .active').removeClass('active')
        $(this).addClass("active")
    })
    </script>
    {{-- display all users --}}
    @if (Request::is('admin'))
        @include('admin.userManagement',[
            "users"=>$users
        ])
    @endif
    {{-- display all the produces --}}
    @if (Request::is('admin/producesmanagement'))
        @include('admin.producesManagement',[
            "produces"=>$produces
        ])
    @endif
    <div class="col-10 container d-flex justify-content-center align-items-center">
        <p>Please add 
        @if (isset($users))
            users
        @else
            produces
        @endif
        </p>
    </div>
</div>
<script>
    $(".input").change(function() {
        // get data value
        var data = $(this).val()
        // get the description of data
        var field = $($(".lable")[$(this).parent().index()]).attr("for")
        // get the id
        var id = parseInt($($('.id')[$(this).parent().parent().index()]).html())
        update(data,field,id)
    })
    // Sending data that already changed to backend
    function update(data,field,id) {
        var currentUrl = window.location.pathname
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post(currentUrl,
        {
            "data":data,
            "id":id,
            "field":field
        })
    }
    // Checking if the table has no data
    if ($("table tbody").children().length == 0) {
        $("table").hide()
    }
</script>
@endsection
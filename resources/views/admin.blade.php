@extends('layouts.app')

@section('content')
<div class="d-flex">
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
    
</div>
<script>
    var currentUrl = window.location.pathname
    // Sending data that already changed to backend
    
    function update(data,field,id) {
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
    
    function create(data) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post(currentUrl,
        {
            "data":data
        }).done(function() {
            location.reload()
        })
    }

    function remove(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post(currentUrl,
        {
            "deleteId":id
        }).done(function() {
            location.reload()
        })
    }
    
</script>
@endsection
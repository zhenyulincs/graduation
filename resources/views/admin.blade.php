@extends('layouts.app')

@section('content')
<div id="admin-menu" class="ml-5 list-group col-1">
    <a href="#" class="text-center list-group-item list-group-item-action active">用户管理</a>
    <a href="#" class="text-center list-group-item list-group-item-action">商品管理</a>
  </div>
<script>
    $("list-group-item").click(function() {
        this.toggleClass("active")
        console.log(1)
    })
</script>
@endsection
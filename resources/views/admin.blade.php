@extends('layouts.backend')

@section('content')
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
        }).done(function() {
            alert('成功了')
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
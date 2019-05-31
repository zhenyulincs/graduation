<table class="user-management ml-5 table table-hover col-10 text-center">
    <thead class="text-center">
        <tr>
            <label class="lable" for="id"></label>
            <th scope="col">id</th>
            <label class="lable" for="name"></label>
            <th scope="col">名字</th>
            <label class="lable" for="premission"></label>
            <th scope="col">权限</th>
            <label class="lable" for="email"></label>
            <th scope="col">邮箱</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <th class= "id" scope="row">{{$user->id}}</th>
            <td><input type="text" class="input form-control" value="{{$user->name}}"></td>
            <td>
                <select @if(Auth::User()->premission > 1 || $user->name == Auth::User()->name) disabled @endif class="input form-control form-control-lg">
                    <option value="{{$user->premission}}">
                        @if ($user->premission == 1)
                            超管
                        @elseif ($user->premission == 2)
                            普通管理员
                        @else 
                            正常用户
                        @endif
                    </option>
                    @if ($user->premission == 0)
                        <option value="2">普通管理员</option>
                    @else
                        <option value="0">正常用户</option> 
                    @endif 
                        <option value="-1">封禁</option>
                  </select>
                </td>
            <td>{{$user->email}}</td>
        </tr>
        @endforeach
        
    </tbody>
</table>
<div class="mr-5 float-right">
{{$users->links()}}
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
</script>
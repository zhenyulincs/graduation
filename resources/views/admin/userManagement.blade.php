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
                <select class="input form-control form-control-lg">
                    <option value="{{$user->premission}}">
                        @if ($user->premission == 1)
                            admin
                        @else 
                            nomal user
                        @endif
                    </option>
                    @if ($user->premission == 0)
                        <option value="1">admin</option>
                    @else
                        <option value="0">nomal user</option> 
                    @endif 
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
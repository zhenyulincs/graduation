<table class="produces-management ml-5 table table-hover col-10 text-center">
    <thead class="text-center">
        <tr>
            <label class="lable" for="id"></label>
            <th scope="col">id</th>
            <label class="lable" for="name"></label>
            <th scope="col">商品名字</th>
            <label class="lable" for="description"></label>
            <th scope="col">商品描述</th>
            <label class="lable" for="cover"></label>
            <th scope="col">封面链接</th>
            <label class="lable" for="left"></label>
            <th scope="col">货品剩余</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($produces as $produce)
        <tr>
            <th class= "id" scope="row">{{$produce->id}}</th>
            <td><input type="text" class="input form-control" value="{{$produce->title}}"></td>
            <td><input type="text" class="input form-control" value="{{$produce->cover}}"></td>
            <td><input type="number" class="input form-control" value="{{$produce->left}}"></td>
        </tr>
        @endforeach
        
    </tbody>
</table>
<div class="mr-5 float-right">
{{$produces->links()}}
</div>
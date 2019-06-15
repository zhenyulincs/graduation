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
                    <td><button type="button" class="delete btn btn-outline-danger">删除这个商品</button></td>
                </tr>
                @endforeach
    
            </tbody>
        </table>
        <div class="mr-5 float-right">
            {{$produces->links()}}
        </div>
        <div class="mb-5 container d-flex justify-content-center align-items-center">
            <a class="add" href="#" onclick="return false">Please add produces</a>
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
        if ($("table tbody").children().length == 0) {
            $("table").hide()
        }
        else {
            $(".input").change(function() {
            // get data value
                var data = $(this).val()
            // get the description of data
                var field = $($(".lable")[$(this).parent().index()]).attr("for")
            // get the id
                var id = parseInt($($('.id')[$(this).parent().parent().index()]).html())
                update(data,field,id)
            })
        }
    // generate input for add user or produces
        var produceAddHtml = `
        <tr>
            <th class= "id" scope="row"></th>
            <td><input type="text" class="input form-control"></td>
            <td><input type="text" class="input form-control"></td>
            <td><input type="text" class="input form-control"></td>
            <td><input type="number" class="input form-control"></td>
            <td><input type="number" class="input form-control"></td>
            <td><button type="button" class="submit btn btn-outline-primary">提交</button></td>
            <td><button type="button" class="cancel btn btn-outline-danger">取消</button></td>
        </tr>
        `
    $('.add').click(function() {
        $("table").show()
        $("table tbody").append(produceAddHtml)
        $('td .cancel').click(function() {
            $(this).parents("tr")[0].remove()
        })
        $('td .submit').click(function() {
            var count = 0
            $($(this).parents("tr")[0]).find("input").each(function(key,value) {
                if ($(value).val() == "") {                
                    $(value).css("border-color","red")
                    $(value).siblings("p").remove()
                    $(value).after("<p>请填满所有的框框</p>")
                }
                else{
                    count+=1
                    $(value).css("border-color","#fff")
                    $(value).siblings("p").remove()
                }
            })
            if (count == 5) {
                var data = new Array()
                $($(this).parents("tr")[0]).find("input").each(function(index,value) {
                        data.push($(value).val())
                    })
                create(data)
                }
                
        })
    })
    </script>
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
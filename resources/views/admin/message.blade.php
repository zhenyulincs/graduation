@extends('layouts.backend')
@section('content')

<script>
    @if(session('static')=='success')
alert('成功了')
@endif

</script>
<div class="card">
    <div class="card-header">
        消息发送</div>
    <div class="card-body">
        <form class="form-horizontal" action="{{url()->current()}}/submit" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">发送人:</label>
                <div class="col-md-9">
                    <input class="form-control" id="text-input" type="number" name="receiverId" placeholder="输入要发送的id">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="text-input">标题</label>
                <div class="col-md-9">
                    <input class="form-control" id="text-input" type="text" name="title" placeholder="输入标题">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="textarea-input">内容</label>
                <div class="col-md-9" id="editor">
                </div>
            </div>
            <textarea class="d-none" id="textarea-input" name="content"></textarea>
    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" type="submit">
            <i class="fa fa-dot-circle-o"></i> 提交</button>
        <button class="btn btn-sm btn-danger" type="reset">
            <i class="fa fa-ban"></i> 重置</button>
    </div>
    </form>
</div>
<script src="js/wangEditor.min.js"></script>
<script>
var E = window.wangEditor
var editor = new E('#editor')
var $textarea = $('#textarea-input')
editor.customConfig.zIndex = 100
editor.customConfig.onchange = function (html) {
    $textarea.val(html)
}
editor.create()
$textarea.val(editor.txt.html())
$('button:reset').click(function() {
    $('.w-e-text').children().first().empty()
    $('.w-e-text').children().first().append('<br>')
    $('.w-e-text').children().first().siblings().remove()
})


</script>
@endsection
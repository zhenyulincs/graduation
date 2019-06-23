@extends('layouts.backend')
@section('content')
<script>
    @if($static=='success')
alert('成功了')
@endif
</script>
<div class="card">
    <div class="card-header">
        个人信息</div>
    <div class="card-body">
        <form class="form-horizontal" action="{{url()->current()}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="date-input">生日~</label>
                <div class="col-md-9">
                    <input class="form-control" id="date-input" type="date" name="birthday"
                        value='{{Auth::user()->birthday}}' placeholder="date">
                    @if ($error)
                    <span class="help-block">{{$error}}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="textarea-input">个人介绍~</label>
                <div class="col-md-9">
                    <textarea class="form-control" id="textarea-input"
                        name="description" rows="9" placeholder="请输入人生箴言">{{Auth::user()->description}}</textarea>
                </div>
            </div>

    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" type="submit">
            <i class="fa fa-dot-circle-o"></i> 提交</button>
        <button class="btn btn-sm btn-danger" type="reset">
            <i class="fa fa-ban"></i> 重置</button>
    </div>
    </form>
</div>
@endsection
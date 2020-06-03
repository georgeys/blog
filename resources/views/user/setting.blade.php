@extends("layout.main")
@section("content")

    <div class="col-sm-8 blog-main">
        <form class="form-horizontal" action="/user/me/setting" method="POST" enctype="multipart/form-data">
           {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-10">
                    <input class="form-control" name="name" type="text" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">头像</label>
                <div class="col-sm-2">
                    <input class=" file-loading preview_input" id="avatar" type="file" value="用户名" style="" name="avatar">
                    <img  class="preview_img" src="{{Auth::user()->avatar}}" alt="" id="avatarImg" class="img-rounded" style="border-radius:400px;margin-top: 10px;height: 110px;width: 100px">
                </div>
            </div>
            @include("layout.error")
            <button type="submit" class="btn btn-default">修改</button>
        </form>
        <br>

    </div>
@endsection

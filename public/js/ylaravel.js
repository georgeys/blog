var editor = new wangEditor('content');
if (editor.config) {
    // 上传图片（举例）
    editor.config.uploadImgUrl = '/posts/img/upload';

    editor.config.uploadHeaders = {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    };

    // 隐藏掉插入网络图片功能。该配置，只有在你正确配置了图片上传功能之后才可用。
    editor.config.hideLinkImg = true;
    editor.create();
}
//
$(".like-button").click(function (event) {
    var target = $(event.target)
    var current_like = target.attr('like-value');
    var user_id = target.attr('like-user');
    var _token = target.attr('_token');
    if (current_like == 1)
    {
        //取消关注
        $.ajax({
            url     : "/user/"+user_id+"/unfan",
            method  : "POST",
            dataType: "json",
            data: {"_token": _token},
            success:function(data)
            {
              if (data.error != 0 )
              {
                  alert(data.msg);
                  return;
              }
              target.attr("like-value",0);
              target.text("关注");
            }
         })
    }else{
        $.ajax({
            url     : "/user/"+user_id+"/fan",
            method  : "POST",
            dataType: "json",
            data: {"_token": _token},
            success:function(data)
            {
                if (data.error != 0 )
                {
                    alert(data.msg);
                    return;
                }
                target.attr("like-value",1);
                target.text("取消关注");
            }
        })
    }
    //关注

})
//预览头像
$("#avatar").change(function () {
    var img_src = URL.createObjectURL($(this)[0].files[0]);
    //给img标检的src赋值
    document.getElementById("avatarImg").src=img_src;
    //URL.revokeObjectURL(img_src);// 手动 回收，
})

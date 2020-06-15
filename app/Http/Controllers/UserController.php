<?php

namespace App\Http\Controllers;

use App\fan;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //个人设置页面
    public function setting()
    {
        return view('user.setting');
    }
    //个人设置行为修改姓名头像
    public function settingStore(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:2|max:20',
        ]);
        $user   =  User::find(Auth::id());
        $user->name = \request('name');
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid())
        {
        //获取后缀
        $avatar = $request->file('avatar');
        $ext =  $avatar->getClientOriginalExtension();
        if (!in_array($ext,array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG'))){
            echo "<script>alert('文件格式错误,仅支持 jpg ,gif,png,jpeg');";
            };
        //上传存到服务器的文件名
        $upload_avatar = md5(Auth::id()).".".$ext;
        $avatar->move('./uploads/avatar',$upload_avatar);
        $user->avatar = '/uploads/avatar'.'/'.$upload_avatar;
        }
        $result = $user->save();
        if ($result){return redirect("/user/".Auth::id());}
    }
    //个人中心详情页面
    public function show(User $user)
    {
        //个人的信息，包含文章数/粉丝/关注
        //without中填写model：User中的hansMany的方法名（得到数量）
        $posts = $user->posts()->orderBy('created_at','desc')->paginate(5);
        $user1 = User::withCount(['posts','fans','stars'])->get()->where('id', $user->id)->first();
        //返回多user1比user多上3个数量
        //  #attributes: array:11 [▼
        //    "id" => 5
        //    "name" => "1342479179@qq.com"
        //    "email" => "1342479179@qq.com"
        //    "password" => "$2y$10$v8vpXF1nnToFsFJu8mka/.qiLm98.XSc/XBrA77R.QZXKKHEISXBq"
        //    "remember_token" => "SB7v9gBEONvmiSIL1irpuw298cmyZxL1c2H6CGqRUbBeZCNthc9VHsEBq6dq"
        //    "created_at" => "2020-05-28 12:44:21"
        //    "updated_at" => "2020-05-28 12:44:21"
        //    "avatar" => null
        //    "posts_count" => 4
        //    "fans_count" => 0
        //    "stars_count" => 0
        //  ]
        //个人文章列表，取最新十条

        //个人关注的用户，该用户的姓名/粉丝/关注
        //pluck取表中一列中所有值组成数组(取出来$stars所有的star_id)
        $stars = $user->stars()->get();
        $susers = User::whereIn('id',$stars->pluck('star_id'))->withCount(['posts','fans','stars'])->paginate(10);


        //关注这个人的用户（这个人的粉丝），该用户的姓名/粉丝/关注
        //$fans = $user ->fans()->get();可以写成这样
        //pluck取表中一列中所有值组成数组(取出来$fans所有的fan_id)
        $fans = $user ->fans;
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['posts','fans','stars'])->paginate(10);
        return view('user.show',compact('posts','user1','susers','fusers'));
    }
    //关注用户
    public function fan(User $user)
    {
        $me = Auth::user();
        $me->doFan($user->id);
        return [
            'error' => 0,
            'msg'   =>''
        ];
    }
    //取消关注
    public function unfan(User $user)
    {
        $me = Auth::user();
        fan::where('fan_id',$me->id)->where('star_id',$user->id)->delete();
        return [
            'error' => 0,
            'msg'   =>''
        ];
    }
}

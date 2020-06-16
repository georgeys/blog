<?php

namespace App;

use App\Model\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminUser extends Authenticatable
{
    use Notifiable;
    //登录验证继承Authenticated
    /**
     * @var array
     */
    protected $fillable = ['name','password'];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //用户的哪一些角色//withPivot返回这两个值
    public function roles()
    {
       return $this->belongsToMany(AdminRole::class,'admin_role_user'
       ,'user_id','role_id')->withPivot(['user_id','role_id']);
    }

    //判断是否有某个角色
    //intersect将两个集合对比 查询数量
    //!! 0为false >1 为true
    public function isInRoles($roles)
    {
        if ($this->roles->intersect($roles)->count() > 0){
            return true;
        }else{
            return false;
        }
    }
    //给用户分配角色
    public function assignRole($role)
    {
        return $this->roles()->save($role);
    }
    //取消用户的角色(删除关系)
    public function deleteRole($role)
    {
        return $this->roles()->detach($role);
    }
    //用户是否有权限
    public function hasPermission($permission)
    {
        return $this->isInRoles($permission->roles);
    }

}

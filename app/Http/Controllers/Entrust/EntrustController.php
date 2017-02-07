<?php

namespace App\Http\Controllers\Entrust;

use App\Model\Permission;
use App\Model\Role;
use App\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EntrustController extends Controller
{
    public function index()
    {
        //todo 造角色
        $owner = new Role();
        $owner ->name = 'owner';
        $owner->display_name = '项目拥有人'; // optional
        $owner->description  = 'User is the owner of a given project'; // optional
        $owner->save();

        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = '用户管理员'; // optional
        $admin->description  = 'User is allowed to manage and edit other users'; // optional
        $admin->save();

        //todo 用户绑角色
        $user = User::where('user_name','admin')->first();
        $user ->attachRole($owner);

        //todo 造权限
        $createPost = new Permission();
        $createPost->name = "造物功能";
        $createPost->display_name = "一种造物的能力";
        $createPost->description = "能无中生有，能捏土成人，改变物质属性，及赋予灵性";
        $createPost->save();

        $editUser = new Permission();
        $editUser->name         = '编辑功能';
        $editUser->display_name = '编辑者们的能力'; // optional
        $editUser->description  = '能够改变物质属性，但不能无中生有。'; // optional
        $editUser->save();

        //todo 角色绑定权限
        $admin->attachPermission($editUser);
        $owner->attachPermission($createPost);


    }
}

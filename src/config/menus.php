<?php
/** .-------------------------------------------------------------------
 * |      Site: www.hdcms.com  www.houdunren.com
 * |      Date: 2018/7/2 上午12:54
 * |    Author: 向军大叔 <2300071698@qq.com>
 * '-------------------------------------------------------------------*/
/**
 * 后台菜单配置
 * 下面是属性说明：
 * title 菜单栏目
 * icon 图标参考 http://fontawesome.dashgame.com/
 * menus 子菜单
 * permission 权限标识，必须在permission.php配置文件中存在
 */
return [
    [
        "title"      => "系统管理",
        "p_id"        => 0,//父级ID
        "icon"       => "fa fa-cogs",
        'permission' => 'AdminController',
        "url" => "链接地址",
        "menus"      => [
            ["title" => "网站信息", "icon"=> "fa fa-navicon","permission" => "AdminController@config", "url" => "链接地址"],
            ["title" => "邮箱配置", "icon"=> "fa fa-navicon","permission" => "AdminController@email", "url" => "链接地址"],
            ["title" => "友情链接", "icon"=> "fa fa-navicon","permission" => "AdminController@link", "url" => "链接地址"],
            ["title" => "后台菜单", "icon"=> "fa fa-navicon","permission" => "Modules\Admin\Http\Controllers\MenuController@index", "url" => "/admin/menu"],
        ],
    ],
    [
        "title"      => "权限管理",
        "p_id"        => 0,//父级ID
        "icon"       => "fas fa-user-shield",
        'permission' => 'Permission',
        "url" => "链接地址",
        "menus"      => [
            ["title" => "管理员列表", "icon"=> "fa fa-navicon", "permission" => "Modules\Admin\Http\Controllers\AdminUserController@index", "url" => "链接地址"],
            ["title" => "管理员日志", "icon"=> "fa fa-navicon", "permission" => "PermissionController@log", "url" => "链接地址"],
            ["title" => "角色管理", "icon"=> "fa fa-navicon", "permission" => "Modules\Admin\Http\Controllers\RoleController@index", "url" => "/admin/role"],
            ["title" => "权限列表", "icon"=> "fa fa-navicon", "permission" => "Modules\Admin\Http\Controllers\PermissionController@index", "url" => "/admin/permission"],
        ],
    ],
];

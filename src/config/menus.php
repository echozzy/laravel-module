<?php
/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/
/**
 * 后台菜单配置
 * 下面是属性说明：
 * title 菜单栏目
 * p_id 父级菜单
 * icon 图标参考 https://fontawesome.com 或 http://www.fontawesome.com.cn
 * permission 权限标识，必须在permission.php配置文件中存在
 * url 菜单地址
 * menus 子菜单
 */
return [
    [
        "title"      => "系统管理",
        "p_id"        => 0,//父级ID
        "icon"       => "fa fa-cogs",
        'permission' => 'AdminController',
        "url" => "链接地址",
        "menus"      => [
            ["title" => "网站信息", "icon"=> "fa fa-navicon","permission" => "Modules\Admin\Http\Controllers\SettingController@edit", "url" => "/admin/setting"],
            ["title" => "邮箱配置", "icon"=> "fa fa-navicon","permission" => "Modules\Admin\Http\Controllers\MailerController@edit", "url" => "/admin/mailer"],
            ["title" => "短信配置", "icon"=> "fa fa-navicon","permission" => "Modules\Admin\Http\Controllers\SmsSettingController@index", "url" => "/admin/sms"],
            ["title" => "友情链接", "icon"=> "fa fa-navicon","permission" => "Modules\Admin\Http\Controllers\LinksController@index", "url" => "/admin/links"],
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
            ["title" => "管理员列表", "icon"=> "fa fa-navicon", "permission" => "Modules\Admin\Http\Controllers\AdminUserController@index", "url" => "/admin/admin_user"],
            ["title" => "管理员日志", "icon"=> "fa fa-navicon", "permission" => "Modules\Admin\Http\Controllers\AdminOperationLogController@index", "url" => "/admin/admin_operation_log"],
            ["title" => "角色管理", "icon"=> "fa fa-navicon", "permission" => "Modules\Admin\Http\Controllers\RoleController@index", "url" => "/admin/role"],
            ["title" => "权限列表", "icon"=> "fa fa-navicon", "permission" => "Modules\Admin\Http\Controllers\PermissionController@index", "url" => "/admin/permission"],
        ],
    ],
];

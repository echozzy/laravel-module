<?php
/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/
/**
 * 权限配置
 * 为了避免其他模块有同名的权限，权限标识要以 '控制器@方法' 开始
 * 资源路由控制器增删改查全由@index控制
 */
return [
    [
        'title' => '系统管理',
        'p_id' => 0,
        'name' => 'AdminController',
        'guard_name' => 'admin',
        'permissions' => [
            ['title' => '网站信息', 'name' => 'Modules\Admin\Http\Controllers\SettingController@edit', 'guard_name' => 'admin'],
            ['title' => '邮箱配置', 'name' => 'Modules\Admin\Http\Controllers\MenuController@edit', 'guard_name' => 'admin'],
            ['title' => '友情链接', 'name' => 'Modules\Admin\Http\Controllers\LinksController@index', 'guard_name' => 'admin'],
            ['title' => '后台菜单', 'name' => 'Modules\Admin\Http\Controllers\MenuController@index', 'guard_name' => 'admin'],
        ],
    ],
    [
        'title' => '权限管理',
        'p_id' => 0,
        'name' => 'Permission',
        'guard_name' => 'admin',
        'permissions' => [
            ['title' => '管理员列表', 'name' => 'Modules\Admin\Http\Controllers\AdminUserController@index', 'guard_name' => 'admin'],
            ['title' => '管理员日志', 'name' => 'Modules\Admin\Http\Controllers\AdminOperationLogController@index', 'guard_name' => 'admin'],
            ['title' => '角色管理', 'name' => 'Modules\Admin\Http\Controllers\RoleController@index', 'guard_name' => 'admin'],
            ['title' => '查看角色权限', 'name' => 'Modules\Admin\Http\Controllers\RoleController@permission', 'guard_name' => 'admin'],
            ['title' => '修改角色权限', 'name' => 'Modules\Admin\Http\Controllers\RoleController@permissionStore', 'guard_name' => 'admin'],
            ['title' => '权限列表', 'name' => 'Modules\Admin\Http\Controllers\PermissionController@index', 'guard_name' => 'admin'],
        ],
    ],
];

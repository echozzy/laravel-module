<?php
/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/
/**
 * 权限配置
 * 为了避免其他模块有同名的权限，权限标识要以 '控制器@方法' 开始
 */
return [
    [
        'title' => '权限管理',
        'p_id' => 0,
        'name' => 'Modules\Admin\Http\Controllers\RoleController',
        'guard_name' => 'admin',
        'permissions' => [
            ['title' => '管理员列表', 'name' => 'Modules\Admin\Http\Controllers\RoleController@list', 'guard_name' => 'admin'],
            ['title' => '管理员日志', 'name' => 'Modules\Admin\Http\Controllers\RoleController@log', 'guard_name' => 'admin'],
            ['title' => '角色管理', 'name' => 'Modules\Admin\Http\Controllers\RoleController@role', 'guard_name' => 'admin'],
            ['title' => '权限列表', 'name' => 'Modules\Admin\Http\Controllers\RoleController@permission', 'guard_name' => 'admin']
        ],
    ],
];

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
        'title' => '系统管理',
        'p_id' => 0,
        'name' => 'Admin',
        'guard_name' => 'admin',
        'permissions' => [
            ['title' => '网站信息', 'name' => 'Admin::config-site', 'guard_name' => 'admin'],
            ['title' => '邮箱配置', 'name' => 'Admin::config-email', 'guard_name' => 'admin'],
            ['title' => '友情链接', 'name' => 'Admin::config-link', 'guard_name' => 'admin'],
            ['title' => '后台菜单', 'name' => 'Admin::config-menu', 'guard_name' => 'admin']
        ],
    ],
    [
        'title' => '权限管理',
        'p_id' => 0,
        'name' => 'Permission',
        'guard_name' => 'admin',
        'permissions' => [
            ['title' => '管理员列表', 'name' => 'Permission::list', 'guard_name' => 'admin'],
            ['title' => '管理员日志', 'name' => 'Permission::log', 'guard_name' => 'admin'],
            ['title' => '角色管理', 'name' => 'Permission::role', 'guard_name' => 'admin'],
            ['title' => '权限列表', 'name' => 'Permission::permissions', 'guard_name' => 'admin']
        ],
    ],
];

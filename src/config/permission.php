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
        'group' => '文章管理',
        'permissions' => [
            ['title' => '添加栏目', 'name' => 'Modules\Admin\Http\Controllers\CategoryController@create', 'guard' => 'admin'],
        ],
    ],
];

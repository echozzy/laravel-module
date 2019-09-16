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
 * icon 图标参考 http://fontawesome.dashgame.com/
 * menus 子菜单
 * permission 权限标识，必须在permission.php配置文件中存在
 */
return [
    [
        "title"      => "系统管理",
        "p_id"        => 0,//父级ID
        "icon"       => "fa fa-navicon",
        'permission' => '权限标识',
        "url" => "链接地址",
        "menus"      => [
            ["title" => "网站配置", "icon"=> "fa fa-navicon", "permission" => "权限标识", "url" => "链接地址"],
        ],
    ],
];

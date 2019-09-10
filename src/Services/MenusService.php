<?php
/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/
namespace Zzy\Module\Services;
class MenusService
{
    public function all()
    {
        foreach (\Module::getOrdered() as $module) {
            $path                   = config('modules.paths.modules')."/{$module->name}/Config";
            $config                 = include "{$path}/config.php";
            $menus[$config['name']] = include "{$path}/menus.php";
        }

        return $menus;
    }
}

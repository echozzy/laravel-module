<?php
/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/
namespace Zzy\Module\Traits;

trait MenusService
{
    /**
     * 获取所有菜单
     *
     * @return mixed
     */
    public function getMenus()
    {
        foreach (\Module::getOrdered() as $module) {
            $path          = config('modules.paths.modules')."/{$module->name}/Config";
            $menusConfig   = include "{$path}/menus.php";
            $title         = \ZyModule::config($module->name.'.config.name');
            $menus[$title] = $menusConfig;
        }

        return $menus;
    }

    /**
     * 获取模块菜单
     *
     * @param $module
     *
     * @return mixed
     */
    public function getMenuByModule($module = null)
    {
        $module = $module ?? \ZyModule::currentModule();
        $path = config('modules.paths.modules')."/{$module}/Config";

        return include "{$path}/menus.php";
    }
}

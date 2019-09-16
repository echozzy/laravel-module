<?php

/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/

namespace Zzy\Module\Traits;

use Zzy\Module\Models\AdminMenu;
use Illuminate\Support\Facades\Cache;

trait MenusService
{
    /**
     * 获取所有菜单
     *
     * @return mixed
     */
    public function getMenus()
    {
        $menus = Cache::remember('admin.menus', now()->addMinutes(24*60), function () {
            $where = [
                ['p_id', '=', '0'],
            ];
            $menus = AdminMenu::where($where)->orderBy('list_order', 'asc')->get();
            $menus = $this->getChildMenus($menus);
            return $menus;
        });
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
        $path = config('modules.paths.modules') . "/{$module}/Config";

        return include "{$path}/menus.php";
    }

    /**
     * 获取所有菜单的子菜单
     *
     * @return array
     */
    protected function getChildMenus($menus)
    {
        foreach ($menus as $key => $menu) {
            $child_menus = AdminMenu::where('p_id', $menu['id'])->orderBy('list_order', 'asc')->get();
            if ($child_menus) {
                // 无线级
                // foreach ($child_menus as $key => $val) {
                //     $status = AdminMenu::where('p_id', $val['id'])->first();
                //     if ($status) {
                //         $childs[] = $this->getChildMenus($val);
                //     } else {
                //         $childs[] = $val;
                //     }
                // }
                // $menus[$key]['child'] = $childs;

                // 二级
                $menus[$key]['child'] = $child_menus;
            }else{
                $menus[$key]['child'] = '';
            }
        }
        return $menus;
    }
}

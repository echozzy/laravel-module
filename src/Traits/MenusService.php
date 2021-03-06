<?php
/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/

namespace Zzy\Module\Traits;

use Zzy\Module\Models\AdminMenu;
use Illuminate\Support\Facades\Cache;
use Zzy\Arr\Arr;

trait MenusService
{
    /**
     * 获取所有菜单
     *
     * @return mixed
     */
    public function getMenus()
    {
        $menus = AdminMenu::orderBy('list_order', 'asc')->get()->toArray();
        $menus = (new Arr())->tree($menus,'title','id','p_id');
        return $menus;
    }

    /**
     * 获取所有菜单(多维数组)
     *
     * @return mixed
     */
    public function getMenusLevel()
    {
        $menus = Cache::remember('admin.menus', now()->addMinutes(24*60), function () {
            $menus = AdminMenu::orderBy('list_order', 'asc')->get()->toArray();
            $menus = (new Arr())->treeLevel($menus,'title','id','p_id');
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
                // 无限级
                $menus[$key]['children'] = $this->getChildMenus($child_menus);;
                
            }else{
                $menus[$key]['children'] = '';
            }
        }
        return $menus;
    }
}

<?php

namespace Zzy\Module\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Zzy\Module\Models\AdminMenu;

/**
 * Class PermissionCreateCommand
 *
 * @package Zzy\Module\Commands
 */
class MenuCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zy:menu {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成菜单';

    /**
     * @var
     */
    protected $module;

    public function handle()
    {
        foreach ((array) $this->getModules() as $module) {
            $config = \ZyModule::config($module . '.menus');
            if($this->insert_menus($config)){
                $this->info("{$module} menus install successFully");
            }else{
                $this->error("{$module} menus install fail");
            }
        }
        Cache::forget('admin.menus');
    }

    /**
     * 检查权限标识
     *
     * @param array $permission
     *
     * @return bool
     */
    protected function menusIsExists(array $group): bool
    {
        $where = [
            ['title', '=', $group['title']],
        ];

        return (bool) AdminMenu::where($where)->first();
    }

    /**
     * 获取模块
     *
     * @return array
     */
    protected function getModules(): array
    {
        $modules = [];
        if ($module = $this->argument('name')) {
            $modules[] = ucfirst($module);
        } else {
            $modules = array_keys(\Module::getOrdered());
        }

        return $modules;
    }

    /**
     * 插入菜单
     *
     * @return bool
     */

    protected function insert_menus(array $groups)
    {
        foreach ((array) $groups as $group) {
            if (!$this->menusIsExists($group)) {
                $child_menus = empty($group['menus']) ? '' : $group['menus'];
                if (isset($group['menus'])) {
                    unset($group['menus']);
                }
                $p_id = AdminMenu::create($group)->id;
                // 添加父级ID
                if($p_id){
                    if ($child_menus) {
                        foreach ($child_menus as $key => $value) {
                            $child_menus[$key]['p_id'] = $p_id;
                        }
                        $this->insert_menus($child_menus);
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
        return true;
    }
}

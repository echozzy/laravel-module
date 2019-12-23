<?php
namespace Zzy\Module\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionCreateCommand
 *
 * @package Zzy\Module\Commands
 */
class PermissionCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zy:permission {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成权限数据';

    /**
     * @var
     */
    protected $module;

    public function handle()
    {
        app()['cache']->forget('spatie.permission.cache');
        foreach ((array)$this->getModules() as $module) {
            $config = \ZyModule::config($module.'.permission');
            if($this->insert_permission($config)){
                $this->info("{$module} permission install successFully");
            }else{
                $this->error("{$module} permission install fail");
            }
        }
    }

    /**
     * 检查权限标识
     *
     * @param array $permission
     *
     * @return bool
     */
    protected function permissionIsExists(array $permission): bool
    {
        $where = [
            ['name', '=', $permission['name']],
            ['guard_name', '=', $permission['guard_name']],
        ];

        return (bool)Permission::where($where)->first();
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
     * 插入权限
     *
     * @return bool
     */
    protected function insert_permission(array $groups)
    {
        foreach ((array) $groups as $group) {
            if (!$this->permissionIsExists($group)) {
                $child_permissions = empty($group['permissions']) ? '' : $group['permissions'];
                if (isset($group['permissions'])) {
                    unset($group['permissions']);
                }
                $p_id = Permission::create($group)->id;
                // 添加父级ID
                if($p_id){
                    if ($child_permissions) {
                        foreach ($child_permissions as $key => $value) {
                            $child_permissions[$key]['p_id'] = $p_id;
                        }
                        $this->insert_permission($child_permissions);
                    }
                }else{
                    return false;
                }
            }else{
                $child_permissions = empty($group['permissions']) ? '' : $group['permissions'];
                if ($child_permissions) {
                    $where = [
                        ['name', '=', $group['name']],
                        ['guard_name', '=', $group['guard_name']],
                    ];
                    $parent = Permission::where($where)->first();
                    $p_id = $parent->id;
                    foreach ($child_permissions as $key => $value) {
                        if ($this->permissionIsExists($value)) {
                            unset($child_permissions[$key]);
                        }else{
                            $child_permissions[$key]['p_id'] = $p_id;
                        }
                    }
                }
                if($child_permissions){
                    $this->insert_permission($child_permissions);
                }else{
                    return false;
                }
            }
        }
        return true;
    }
}

<?php

/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/

namespace Zzy\Module\Traits;

use Module;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Cache;

/**
 * Trait PermissionService
 *
 * @package Zzy\Module\Traits
 */
trait PermissionService
{

    /**
     * 获取所有权限
     *
     * @return mixed
     */
    public function getPermissions()
    {
        $permissions = Cache::remember('admin.permission', now()->addMinutes(24 * 60), function () {
            $where = [
                ['p_id', '=', '0'],
            ];
            $permissions = Permission::where($where)->get();
            $permissions = $this->getChildPermissions($permissions);
            return $permissions;
        });
        return $permissions;
    }

    /**
     * 验证权限
     *
     * @param        $permissions
     * @param string $guard
     *
     * @return bool
     */
    public function hadPermission($permissions, string $guard): bool
    {
        if ($this->isWebMaster()) {
            return true;
        }
        $permissions = is_array($permissions) ? $permissions : [$permissions];
        $data        = array_filter($permissions, function ($permission) use ($guard) {
            $where = [
                ['name', '=', $permission],
                ['guard_name', '=', $guard],
            ];

            return (bool) \DB::table('permissions')->where($where)->first();
        });
        return auth()->user()->hasAnyPermission($data);
    }

    /**
     * 站长检测
     *
     * @return bool
     */
    public function isWebMaster($guard = 'admin'): bool
    {
        $relation = auth($guard)->user()->roles();
        $has      = $relation->where('roles.name', 'Administrators')->first();

        return boolval($has);
    }

    /**
     * @param $guard
     *
     * @return array
     */
    public function getPermissionByGuard($guard)
    {
        $modules     = Module::getOrdered();
        $permissions = [];
        foreach ($modules as $module) {
            $permissions[] = [
                'module' => $module,
                'config' => $this->config($module->getName() . '.config'),
                'rules'  => $this->filterByGuard($module, $guard),
            ];
        }

        return $permissions;
    }

    /**
     * @param $module
     * @param $guard
     *
     * @return mixed
     */
    protected function filterByGuard($module, $guard)
    {
        $data = $config = \ZyModule::config($module . '.permission');
        foreach ($config as $k => $group) {
            foreach ($group['permissions'] as $n => $permission) {
                if ($permission['guard'] != $guard) {
                    unset($data[$k]['permissions'][$n]);
                }
            }
        }

        return $data;
    }

    /**
     * 获取所有权限的子权限
     *
     * @return array
     */
    protected function getChildPermissions($permissions)
    {
        foreach ($permissions as $key => $permission) {
            $child_permissions = Permission::where('p_id', $permission['id'])->get();
            if ($child_permissions) {
                // 无限级
                $permissions[$key]['children'] = $this->getChildPermissions($child_permissions);
            } else {
                $permissions[$key]['children'] = '';
            }
        }
        return $permissions;
    }
}

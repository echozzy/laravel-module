<?php

namespace Zzy\Module\Middlewares;

use Closure;
use Zzy\Module\Exceptions\PermissionDenyException;
use Zzy\Module\Traits\PermissionService;
use Route;
use DB;

/**
 * Class PermissionMiddleware
 *
 * @package Zzy\Module\Middlewares
 */
class PermissionMiddleware
{
    use PermissionService;

    /**
     * @param          $request
     * @param \Closure $next
     * @param string   $permission
     *
     * @return mixed
     * @throws \Zzy\Module\Exceptions\PermissionDenyException
     */
    public function handle($request, Closure $next, string $guard = 'admin', $resource = null)
    {
        if ( ! auth($guard)->check()) {
            throw new PermissionDenyException('请登录后操作');
        }
        //站长不需要验证
        if ( ! $this->isWebMaster($guard)) {
            $permission    = $this->getPermission($resource);
            $hasPermission = $this->hasPermission($permission, $guard);

            //权限规则没有定义处理
            if ( ! $hasPermission) {
                return $next($request);
            }
            $auth = auth($guard)->user()->hasAnyPermission($permission);
            if ( ! $auth) {
                throw new PermissionDenyException('你没有访问权限');
            }
        }

        return $next($request);
    }

    /**
     * 权限规则存在地验证
     *
     * @param string $permission
     * @param string $guard
     *
     * @return bool
     */
    protected function hasPermission(string $permission, string $guard): bool
    {
        $where = [
            ['name', '=', $permission],
            ['guard_name', '=', $guard],
        ];
        $has   = DB::table('permissions')->where($where)->first();

        return boolval($has);
    }

    /**
     * 根据路由获取权限标识
     *
     * @param $permission
     *
     * @return string
     */
    protected function getPermission($resource): string
    {
        $route = Route::getCurrentRoute();
        /**
         * 资源路由处理
         * 全归增删改查全通过index管理
         */
        if ($resource) {
            return str_replace(['@store', '@update','@create', '@edit', '@destroy'], '@index', $route->action['controller']);
        }

        return $route->action['controller'];
    }
}

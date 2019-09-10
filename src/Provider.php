<?php
/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/

namespace Zzy\Module;

use Zzy\Module\Traits\ConfigService;
use Zzy\Module\Traits\MenusService;
use Zzy\Module\Traits\ModuleService;
use Zzy\Module\Traits\PermissionService;

/**
 * Class Facade
 *
 * @package Zzy\Module
 */
class Provider
{
    use ConfigService, PermissionService, MenusService,ModuleService;
}

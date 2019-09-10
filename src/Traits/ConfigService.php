<?php
/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/
namespace Zzy\Module\Traits;

use Module;
use ZyModule;
/**
 * Class ModuleConfig
 *
 * @package Zzy\Module\Services
 */
trait ConfigService
{
    /**
     * 支持点语法的获取配置项
     *
     * @param $name
     *
     * @return mixed
     */
    public function config($name)
    {
        $exts = explode('.', $name);
        $file = config('modules.paths.modules').'/'.ucfirst(array_shift($exts)).'/Config/'.array_shift($exts).'.php';
        if (is_file($file)) {
            $config = include $file;

            return $exts ? array_get($config, implode('.', $exts)) : $config;
        }
    }

    public function saveConfig(array $data = [], $name = 'config')
    {
        $module = ZyModule::currentModule();
        $config = array_merge(ZyModule::config($module.'.'.$name), $data);
        $file   = ZyModule::getModulePath().'/Config/'.$name.'.php';

        return file_put_contents($file, '<?php return '.var_export($config, true).';');
    }
}

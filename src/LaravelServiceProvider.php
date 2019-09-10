<?php
/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/

namespace Zzy\Module;

use Zzy\Module\Commands\ModelCreateCommand;
use Zzy\Module\Commands\PermissionCreateCommand;
use Zzy\Module\Services\MenusService;
use Illuminate\Support\ServiceProvider;
use Zzy\Module\Commands\ModuleCreateCommand;
use Zzy\Module\Commands\ConfigCreateCommand;

class LaravelServiceProvider extends ServiceProvider
{
    public $singletons = [
        'zy-menu' => MenusService::class,
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ModuleCreateCommand::class,
                ConfigCreateCommand::class,
                PermissionCreateCommand::class,
                ModelCreateCommand::class,
            ]);
        }

        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        //配置文件
        $this->publishes([
            __DIR__.'/zzy_module.php' => config_path('zzy_module.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ZyModule', function () {
            return new Provider();
        });
    }
}

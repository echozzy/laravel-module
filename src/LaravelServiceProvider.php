<?php
/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/

namespace Zzy\Module;

use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;
use Zzy\Module\Commands\ModelCreateCommand;
use Zzy\Module\Commands\PermissionCreateCommand;
use Zzy\Module\Services\MenusService;
use Illuminate\Support\ServiceProvider;
use Zzy\Module\Commands\ModuleCreateCommand;
use Zzy\Module\Commands\ConfigCreateCommand;
use Zzy\Module\Commands\MenuCreateCommand;

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
    public function boot(Filesystem $filesystem)
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ModuleCreateCommand::class,
                ConfigCreateCommand::class,
                PermissionCreateCommand::class,
                MenuCreateCommand::class,
                ModelCreateCommand::class,
            ]);
        }
        $this->publishes([
            __DIR__.'/Migrations/create_menu_tables.php.stub' =>  $this->getMigrationFileName($filesystem),
        ], 'migrations');

        // $this->loadMigrationsFrom(__DIR__.'/Migrations');
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

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @param Filesystem $filesystem
     * @return string
     */
    protected function getMigrationFileName(Filesystem $filesystem): string
    {
        $timestamp = date('Y_m_d_His');

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem) {
                return $filesystem->glob($path.'*_create_menu_tables.php');
            })->push($this->app->databasePath()."/migrations/{$timestamp}_create_menu_tables.php")
            ->first();
    }
    
}

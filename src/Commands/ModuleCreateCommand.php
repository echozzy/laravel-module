<?php
namespace Zzy\Module\Commands;

use Illuminate\Console\Command;
use Artisan;
use Storage;

class ModuleCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zy:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a module';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = ucfirst($this->argument('name'));
        if (\Module::has($name)) {
            return $this->error("Module [{$this->name}] already exists");
        }
        $this->call('module:make', [
            'name' => [$name],
        ]);
        $this->call('zy:config', [
            'name' => $name,
        ]);

    }
}

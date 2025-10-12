<?php

namespace App\Console\Commands;

use App\Models\ThemeModule;
use App\Models\UiModule;
use App\Modules\Modules;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class UiModuleUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Update Ui Modules';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ui modules update';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modules = Modules::getModules();
        foreach ($modules as $module) {
            $moduleClass = new $module;
            $modulePath = $moduleClass->getModulePath();
            $moduleName = $moduleClass->getModuleName();
            UiModule::firstOrCreate([
                'module_path' => $modulePath,
                'module_name' => $moduleName,
                'status' => 1
            ]);
        }
    }
}

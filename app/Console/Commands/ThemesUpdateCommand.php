<?php

namespace App\Console\Commands;

use App\Models\Theme;
use Illuminate\Console\Command;

class ThemesUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'themes-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $themes = glob(base_path('resources/views/themes/*'));
        foreach ($themes as $theme) {
           $exploded_path = explode("/", $theme);
           $lastPath = end($exploded_path);
           Theme::firstOrCreate([
               'name' => $lastPath,
           ]);
        }
    }
}

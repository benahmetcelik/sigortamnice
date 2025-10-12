<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $domains = [
            [
                'name' => 'Default',
                'path' => '',
                'demo_url' => '',
                'image' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];
        Theme::insert($domains);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Domain;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AllowedDomainSeeder extends Seeder
{

    public function run(): void
    {
        $domains = [
            [
                'domain' => 'laravel.test',
                'status' => true,
                'expires_at' => Carbon::now()->addYear(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'theme_id'=>1
            ],

        ];
        Domain::insert($domains);
    }
}

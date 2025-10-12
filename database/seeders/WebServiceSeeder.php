<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $webServices = [
            ['name' => 'Sompo Sigorta'],
        ];

        foreach ($webServices as $webService) {
            $model = new \App\Models\WebService($webService);
            $model->save();

            //Form input alanları requirementa göre belirlenecek
            $modules = [
                ['name' => 'Dask', 'requirements' => [
                   [
                       'key' => 'username',
                          'label' => 'Kullanıcı Adı',
                   ],
                    [
                        'key' => 'password',
                        'label' => 'Şifre',
                    ],
                    [
                        'key' => 'proxy_host',
                        'label' => 'Proxy Host',
                    ],
                    [
                        'key' => 'proxy_port',
                        'label' => 'Proxy Port',
                    ],
                    [
                        'key' => 'proxy_user',
                        'label' => 'Proxy User',
                    ],
                    [
                        'key' => 'proxy_pass',
                        'label' => 'Proxy Pass',
                    ],
                ], 'web_service_id' => $model->id],

            ];
            foreach ($modules as $module) {
                $moduleModel = new \App\Models\WebServiceModule($module);
                $moduleModel->save();
            }
        }
    }
}

<?php

namespace App\Console\Commands;

use App\Jobs\FetchDaskDataJob;
use App\Models\Domain;
use App\Models\DomainModule;
use App\Models\Offer;
use App\Models\QuoteRequest;
use App\Models\Theme;
use App\Models\WebServiceModule;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-command';

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


        /**
         * @var Offer $offer
         */
        $offer = Offer::find(26);
        $offer->checkOffer();


        die();
        $qr = QuoteRequest::find(56);

        $job = new FetchDaskDataJob($qr);
        $handle = $job->handle();




die('b');

        $domainModule = DomainModule::find(10);

        $setting = collect($domainModule->settings)
            ->flatMap(function ($item) {
                return [$item['key'] => $item['value']];
            })->toArray()
        ;


        dd($setting);

        die();

        $offer = Offer::find(1);
        /**
         * @var WebServiceModule $webServiceModule
         */
        $webServiceModule = WebServiceModule::find(1);
        $webServiceModule->checkOffer($offer);





        die();
        $webServices = [
            ['name' => 'Koru Sigorta'],
            ['name' => 'Hepiyi Sigorta'],
            ['name' => 'Doğa Sigorta'],
            ['name' => 'Sompo Sigorta'],
            ['name' => 'TürkNippon Sigorta'],
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
                    ]
                ], 'web_service_id' => $model->id],

                ['name' => 'Kasko', 'requirements' => [
                    [
                        'key' => 'username',
                        'label' => 'Kullanıcı Adı',
                    ],
                    [
                        'key' => 'password',
                        'label' => 'Şifre',
                    ]
                ], 'web_service_id' => $model->id],

                ['name' => 'Trafik', 'requirements' => [
                    [
                        'key' => 'username',
                        'label' => 'Kullanıcı Adı',
                    ],
                    [
                        'key' => 'password',
                        'label' => 'Şifre',
                    ]
                ], 'web_service_id' => $model->id],

            ];
            foreach ($modules as $module) {
                $moduleModel = new \App\Models\WebServiceModule($module);
                $moduleModel->save();
            }
        }

        die();

        Cache::forget('domain_information_laravel.test');
        die();
        $quote = QuoteRequest::find(2);
        $services = $quote->getDomain->webServices()->whereHas('modules',function ($modules){
            return $modules->where('type','dask');
        })->get();
        dd($services);


        die();
       // Cache::forget('domain_information_laravel.test');
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

<?php

namespace App\Jobs;

use App\Models\DomainModule;
use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\File;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class FetchDaskDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private QuoteRequest $quoteRequest;

    /**
     * Create a new job instance.
     */
    public function __construct(QuoteRequest $quoteRequest)
    {
        $this->quoteRequest = $quoteRequest;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $domain = $this->quoteRequest->getDomain;

        $domainModules = DomainModule::where('domain_id', $domain->id)
            ->with([
                'webServiceModule.webService',
            ])
            ->whereRelation('webServiceModule', 'type', '=', 'dask')
            ->get();


        if ($domainModules->isNotEmpty()) {
            foreach ($domainModules as $domainModule) {
                $serviceName = Str::replace(' ','',$domainModule->webServiceModule->webService->name);
                $serviceType = Str::replace(' ','',$domainModule->webServiceModule->name);
                $jobName = "App\\Jobs\\$serviceType\\$serviceName"."Job";
                $jobName::dispatch($this->quoteRequest, $domainModule)
                    ->delay(now()->addSeconds(5))
                    ->onQueue('quote-requests');
            }

        }

    }
}

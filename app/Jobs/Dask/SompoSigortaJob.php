<?php

namespace App\Jobs\Dask;

use App\Jobs\Helpers\DaskHelper;
use App\Models\DomainModule;
use App\Models\QuoteRequest;
use App\Services\SompoDaskService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class SompoSigortaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, DaskHelper;

    private QuoteRequest $quoteRequest;
    private DomainModule $domainModule;

    /**
     * Create a new job instance.
     */
    public function __construct(QuoteRequest $quoteRequest, DomainModule $domainModule)
    {
        $this->domainModule = $domainModule;
        $this->quoteRequest = $quoteRequest;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $setting = collect($this->domainModule->settings)
            ->flatMap(function ($item) {
                return [$item['key'] => $item['value']];
            })->toArray();


        $sompoClient = new SompoDaskService(
            username: $setting['username'],
            password: $setting['password'],
            ip: $setting['proxy_port'],
            proxy_host: $setting['proxy_host'],
            proxy_port: $setting['proxy_port'],
            proxy_user: $setting['proxy_user'],
            proxy_pass: $setting['proxy_pass']
        );

        $formData = json_decode($this->quoteRequest->custom_fields);
        $customerInfo = $this->quoteRequest->getDealerCustomer;

        $phone = Str::replace(' ', '', $customerInfo->phone);
        $operatorCode = Str::take(Str::replace('+90', '', $phone),3);
        $phoneNumber = Str::take($phone,Str::length($phone)+3);



        $data = [
            'constYear' => $sompoClient->getConstYear(now()->subYears($formData->building_age)->year),
            'floorCount' => $sompoClient->getFloorCount($formData->total_floors),
            'constType' => $sompoClient->getConstType($formData->building_material),
            'buildingUsageType' => $sompoClient->getBuildingUsageType($formData->building_usage),
            'buildingSquareMeter' => $formData->building_size,
            'floorNo' => $sompoClient->getFloorNo($formData->building_floor),
            'landRegistryIndependentSectionNum' => "2", //
            'whoinsurance' => "1",
            'uavtCode' => $formData->uavt_code,
            'proposalNumber' => "",
            'PROPOSAL' => [
                'CUSTOMER' => [
                    'IDENTITY_NO' => $customerInfo->passport_no,
                    'PERSONAL_COMMERCIAL' => "O",
                    'EMAIL_ADDRESS' =>$customerInfo->email,
                    'GSM_COUNTRY_CODE' => "90",
                    'GSM_CODE' => $operatorCode,
                    'GSM_NUMBER' => $phoneNumber,
                ],
                'INSURED' => [
                    'IDENTITY_NO' => $customerInfo->passport_no,
                    'PERSONAL_COMMERCIAL' => "O",
                    'EMAIL_ADDRESS' =>$customerInfo->email,
                    'GSM_COUNTRY_CODE' => "90",
                    'GSM_CODE' => $operatorCode,
                    'GSM_NUMBER' => $phoneNumber,
                ],
            ],
        ];
        $offer = $this->saveOffer(
            $sompoClient->createProposal($data)
        );
        logger('data',(array)$offer);


    }


    /**
     * @param $response
     * @return array
     */
    public function formatResponse($response): array
    {
        logger('response',(array)$response);
        $reason = null;
        if (isset($response->PROPOSAL_RESPONSE->RESULT) && property_exists($response->PROPOSAL_RESPONSE->RESULT, 'ERROR')) {
            $reason = $response->PROPOSAL_RESPONSE->RESULT->ERROR?->ERROR_DESCRIPTION ?? null;
        }
        return [
            'price' => $response->PROPOSAL_RESPONSE->PAYMENT?->INSTALLMENTS?->INSTALLMENT?->INSTALLMENT_AMOUNT,
            'is_acceptable' => (bool)$response->PROPOSAL_RESPONSE->PAYMENT,
            'reason' => $reason,
            'response' => json_encode((array)$response),
        ];
    }
}

<?php

namespace App\Services;

use App\Models\Offer;
use Exception;

class NipponService extends BaseService
{




    private $wsdl;
    private $options;
    private $authHeader;
    private $client;

    public function __construct()
    {
        $this->wsdl = "https://galaksi.turknippon.com/appservice/dask-v2.asmx?wsdl";
        $this->options = [
            'trace' => 1,
            'exceptions' => true,
            'proxy_host' => '159.253.39.221',
            'proxy_port' => '3346',
            'proxy_login' => 'Nice',
            'proxy_password' => 'Nice33+35*',
        ];

        $this->authHeader = [
            'Channel' => 31672,
            'Username' => '31672001',
            'Password' => '31672001'
        ];

        $this->initializeClient();
    }

    private function initializeClient()
    {
        try {
            $this->client = new \SoapClient($this->wsdl, $this->options);
            $header = new \SoapHeader(
                'http://galaksi.turknippon.com/appservice/',
                'AuthHeader',
                $this->authHeader
            );
            $this->client->__setSoapHeaders($header);
        } catch (\SoapFault $e) {
            throw new \Exception("SOAP Client başlatma hatası: " . $e->getMessage());
        }
    }

    public function dask(Offer $offer)
    {
        try {
            $defaultInput = [
                'PrintType' => 1,
                'IsTestMode' => false,
                'Channel' => 31672,
                'Username' => '31672001',
                'CashPaymentType' => 0,
                'UseCreditCard' => false,
                'IsRenewal' => false,
                'InsurerType' => 1,
                'LossPayeeType' => 'Y',
            ];

            $daskInput = array_merge($defaultInput, [
                'TrackingCode' => $offer->id,
                'CitizenshipNumber' => $offer->getQuoteRequest->getDealerCustomer->tc,
                'BirthDate' =>$offer->getQuoteRequest->getDealerCustomer->birth_date->format('Y-m-dTH:i:s'),
                'ClientCitizenshipNumber' => '53989720452',
                'BeginDate' => $offer->created_at->format('Y-m-dTH:i:s'),
                'MobilePhoneNumber' => $offer->getQuoteRequest->getDealerCustomer->phone,
                'PhoneNumber' =>$offer->getQuoteRequest->getDealerCustomer->phone,
                'ClientMobilePhoneNumber' => $offer->getQuoteRequest->getDealerCustomer->phone,
                'ClientPhoneNumber' => $offer->getQuoteRequest->getDealerCustomer->phone,
                'RiskAddressCode' => $offer->getQuoteRequest->uavt_code,
                'GrossAreaM2' => 130,
                'UsageType' => 5,
                'BuildType' => 4,
                'BuildYear' => 9,
                'TotalFloor' => 6,
                'AnteriorDamage' => 0
            ]);

            $result = $this->client->__soapCall('Proposal', [['Input' => $daskInput]]);

            if ($result->ProposalResult->IsSuccess) {
                return  (object) [
                    'status' => true,
                    'policyNo' => $result->ProposalResult->PolicyNo,
                    'premium' => $result->ProposalResult->Premium,
                    'beginDate' => $result->ProposalResult->BeginDate,
                    'endDate' => $result->ProposalResult->EndDate,
                    'price'=>rand(100, 1000),
                    'is_acceptable'=>rand(0,1) === 1,
                ];
            }

            return [
                'status' => false,
                'error' => $result->ProposalResult->StatusDescription,
                'price'=>rand(100, 1000),
                'is_acceptable'=>rand(0,1) === 1,
            ];

        } catch (\SoapFault $e) {
            return (object) [
                'status' => false,
                'error' => "SOAP Hatası: " . $e->getMessage(),
                'price'=>rand(100, 1000),
                'is_acceptable'=>rand(0,1) === 1,
            ];
        } catch (\Exception $e) {
            return (object) [
                'status' => false,
                'error' => "Hata: " . $e->getMessage(),
                'price'=>rand(100, 1000),
                'is_acceptable'=>rand(0,1) === 1,
            ];
        }
    }





}

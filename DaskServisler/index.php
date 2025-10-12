<?php

class SompoDaskClient
{
    private $wsdl;
    private $username;
    private $password;
    private $ip;
    private $proxy_host;
    private $proxy_port;
    private $proxy_user;
    private $proxy_pass;
    private $client;

    public function __construct($wsdl, $username, $password, $ip, $proxy_host, $proxy_port, $proxy_user, $proxy_pass)
    {
        $this->wsdl = $wsdl;
        $this->username = $username;
        $this->password = $password;
        $this->ip = $ip;
        $this->proxy_host = $proxy_host;
        $this->proxy_port = $proxy_port;
        $this->proxy_user = $proxy_user;
        $this->proxy_pass = $proxy_pass;

        $this->initializeClient();
    }

    private function initializeClient()
    {
        try {
            $this->client = new SoapClient($this->wsdl, [
                'trace' => 1,
                'exceptions' => true,
                'proxy_host' => $this->proxy_host,
                'proxy_port' => $this->proxy_port,
                'proxy_login' => $this->proxy_user,
                'proxy_password' => $this->proxy_pass,
            ]);

            // SOAP Header'ı oluştur ve ekle
            $header = new SoapHeader(
                'http://tempuri.org/',
                'IdentityHeader',
                [
                    'KullaniciAdi' => $this->username,
                    'KullaniciParola' => $this->password,
                    'KullaniciIP' => $this->ip,
                    'KullaniciTipi' => 'ACENTE',
                ]
            );

            $this->client->__setSoapHeaders([$header]);
        } catch (SoapFault $fault) {
            throw new Exception("SOAP Client Initialization Error: " . $fault->getMessage());
        }
    }

    public function createProposal($data)
    {
        try {
            $result = $this->client->CreateProposal($data);
            return $result;
        } catch (SoapFault $fault) {
            throw new Exception("SOAP Error: " . $fault->getMessage());
        }
    }
}


$sompoClient = new SompoDaskClient(
    'https://www.sompojapan.com.tr/SompoEndPoint/Dask.asmx?wsdl',
    'NICESG',
    'RMb1bCkWh1',
    '159.253.39.220',
    '159.253.39.220',
    '3346',
    'Nice',
    'Nice33+35*'
);

$data = [
    'constYear' => "10",
    'floorCount' => "06",
    'constType' => "4",
    'buildingUsageType' => "5",
    'buildingSquareMeter' => "100",
    'floorNo' => "3",
    'landRegistryIndependentSectionNum' => "2",
    'whoinsurance' => "1",
    'uavtCode' => "2088718313",
    'proposalNumber' => "",
    'PROPOSAL' => [
        'CUSTOMER' => [
            'IDENTITY_NO' => "35935923964",
            'PERSONAL_COMMERCIAL' => "O",
            'EMAIL_ADDRESS' => "example@example.com",
            'GSM_COUNTRY_CODE' => "90",
            'GSM_CODE' => "545",
            'GSM_NUMBER' => "4864759",
        ],
        'INSURED' => [
            'IDENTITY_NO' => "35935923964",
            'PERSONAL_COMMERCIAL' => "O",
            'EMAIL_ADDRESS' => "example@example.com",
            'GSM_COUNTRY_CODE' => "90",
            'GSM_CODE' => "545",
            'GSM_NUMBER' => "4864759",
        ],
    ],
];

$response = $sompoClient->createProposal($data);


print_r($response);

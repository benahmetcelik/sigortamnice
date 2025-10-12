<?php

namespace App\Services;
class SompoDaskService
{

    private $username;
    private $password;
    private $ip;
    private $proxy_host;
    private $proxy_port;
    private $proxy_user;
    private $proxy_pass;
    private $client;

    public function __construct( $username, $password, $ip, $proxy_host, $proxy_port, $proxy_user, $proxy_pass)
    {
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
            $this->client = new \SoapClient("https://www.sompojapan.com.tr/SompoEndPoint/Dask.asmx?wsdl", [
                'trace' => 1,
                'exceptions' => true,
                'proxy_host' => $this->proxy_host,
                'proxy_port' => $this->proxy_port,
                'proxy_login' => $this->proxy_user,
                'proxy_password' => $this->proxy_pass,
            ]);

            // SOAP Header'ı oluştur ve ekle
            $header = new \SoapHeader(
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
        } catch (\SoapFault $fault) {
            throw new \Exception("SOAP Client Initialization Error: " . $fault->getMessage());
        }
    }

    public function createProposal($data)
    {
        try {
            $result = $this->client->CreateProposal($data);
            return $result;
        } catch (\SoapFault $fault) {
            throw new \Exception("SOAP Error: " . $fault->getMessage());
        }
    }

    /**
     * Bina inşaat yılına göre sabit değer döndürür.
     */
    public function getConstYear(int $year): ?string
    {
        if ($year <= 1975) {
            return "6";
        } elseif ($year >= 1976 && $year <= 1999) {
            return "7";
        } elseif ($year >= 2000 && $year <= 2006) {
            return "8";
        } elseif ($year >= 2007 && $year <= 2019) {
            return "9";
        } elseif ($year >= 2020) {
            return "10";
        }

        return null;
    }

    /**
     * Kat sayısına göre sabit değer döndürür.
     */
    public function getFloorCount(int $floor): ?string
    {
        if ($floor >= 1 && $floor <= 3) {
            return "05";
        } elseif ($floor >= 4 && $floor <= 7) {
            return "06";
        } elseif ($floor >= 8 && $floor <= 18) {
            return "07";
        } elseif ($floor >= 19) {
            return "08";
        }

        return null;
    }

    /**
     * Bina inşaat türüne göre sabit değer döndürür.
     */
    public function getConstType($type): ?string
    {
        $data = [
            'Çelik, betonarme' => "4",
            'Diğer' => "5",
        ];
        return $data[$type] ?? null;
    }

    /**
     * Bina kullanım türüne göre sabit değer döndürür.
     */
    public function getBuildingUsageType($type) : ?string {

        $data = [
            'MESKEN' => "5",
            'TİCARETHANE' => "6",
            'DİĞER' => "7",
        ];
        return $data[$type] ?? null;

    }

    /**
     * Bina kat sayısına göre sabit değer döndürür. 0 Zemin Kat
     */
    public function getFloorNo(int $floor): ?string
    {
        if ($floor <= -4) {
            return "-4";
        } elseif ($floor >= -3 && $floor <= 10) {
            return (string)$floor;
        } elseif ($floor >= 11) {
            return "11";
        }

        return null;
    }

    public function acceptOffer($body)
    {

        $result = $this->client->CreateProposal($body);

        return $result;
    }


}

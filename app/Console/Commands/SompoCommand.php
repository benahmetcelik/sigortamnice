<?php

namespace App\Console\Commands;

use App\Services\SompoDaskService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use phpseclib\Crypt\RSA;

class SompoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sompo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sompo Entegrasyonu Testi';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sompoService = new SompoDaskService(
            username: 'NICESG',
            password: 'RMb1bCkWh1',
            ip: request()->ip(),
            proxy_host: '159.253.39.220',
            proxy_port: '3346',
            proxy_user: 'Nice',
            proxy_pass: 'Nice33+35*'
        );



        $formData = (object)[
            'uavt_code' => '1344107899',
            'building_age' => '1995',
            'total_floors' => '4',
            'building_size' => '120',
            'building_type' => 'apartment',
            'building_floor' => '2',
            'building_usage' => 'MESKEN',
            'additional_info' => 'Deneme',
            'building_material' => 'Çelik, betonarme',
            'building_risk_class' => '1'
        ];
        $customerInfo =(object)[
            'phone'=>'+905465414635',
            'email'=>'ben4hmetcelik@gmail.com',
            'passport_no'=>'54061400460'

        ];

        $phone = Str::replace(' ', '', $customerInfo->phone);
        $operatorCode = Str::take(Str::replace('+90', '', $phone),3);
        $phoneNumber = Str::take($phone,Str::length($phone)+3);



        $data = [
            'constYear' => $sompoService->getConstYear(now()->subYears($formData->building_age)->year),
            'floorCount' => $sompoService->getFloorCount($formData->total_floors),
            'constType' => $sompoService->getConstType($formData->building_material),
            'buildingUsageType' => $sompoService->getBuildingUsageType($formData->building_usage),
            'buildingSquareMeter' => $formData->building_size,
            'floorNo' => $sompoService->getFloorNo($formData->building_floor),
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



        $proposal = $sompoService->createProposal($data);

        $response = json_decode(json_encode($proposal),true);
        /**
         * Koşul : PROPOSAL_RESPONSE->RESULT->RESULT_CODE ==1 ise başarılı demektir
         * Lisans Numarası : PROPOSAL_RESPONSE->PROPOSAL_NO
         */
        $policyNo = $response['PROPOSAL_RESPONSE']['PROPOSAL_NO'];
        $sompoService = new SompoDaskService(
            username: 'NICESG',
            password: 'RMb1bCkWh1',
            ip: request()->ip(),
            proxy_host: '159.253.39.220',
            proxy_port: '3346',
            proxy_user: 'Nice',
            proxy_pass: 'Nice33+35*'
        );

        $yanit =  $sompoService->acceptOffer([
            'Policy' => [
                'PolicyNumber' => $policyNo,
                'EndorsNr' => 0,
                'RenewalNr' => 0, // 0 olmalı demiş döküman,
                'FirmCode' => 0, // 0 olmalı demiş döküman,
                'CompanyCode' => 0, // 0 olmalı demiş döküman,
            ],
            'PaymentInput' => [
                'Installment' => 1,
                'CreditCardCvv' => $this->encryptedBinary('000'),
                'CreditCardEndYear' => $this->encryptedBinary('2025'),
                'CreditCardEndMonth' => $this->encryptedBinary('12'),
                'CreditCardNameSurname' => $this->encryptedBinary('Ahmet ÇELİK'),
                'CreditCardNumber' => $this->encryptedBinary('000000000000'),
                'PaymentType'=>0
            ],
            'Unit' => [
                'ADDRESS_LIST' => [
                    'ADDRESS_TYPE' => '1344107899',
                    'ADDRESS_DATA' => '809. Cadde Karşıyaka Mah. Aytaş Apt. No:13 içkapı:3'
                ],
                'IDENTITY_NO' => $customerInfo->passport_no,
                'TAX_NO' => null,
                'PHONE_COUNTRY_CODE' => null,
                'PHONE_CODE' => null,
                'PHONE_NUMBER' =>null,
                'GSM_COUNTRY_CODE' => '+90',
                'GSM_CODE' => '546',
                'GSM_NUMBER' => '5414635',
                'EMAIL_ADDRESS' => $customerInfo->email,
            ]

        ]);


        dd($yanit);
    }



    public function encryptedBinary($text)
    {


// 1. Şifrelenecek Metin
        $plainText = $text; // Keeping it very short for testing, as confirmed it's 5 bytes.

// 2. iso-8859-9 (Latin-5) Kodlamasına Çevirme
        $encodedText = iconv("UTF-8", "ISO-8859-9", $plainText);

        if ($encodedText === false) {
            die("Metin kodlama hatası! Lütfen karakter kodlamasını kontrol edin.");
        }

// 3. Açık Anahtarı phpseclib ile Yükleme - XML Formatında Deneme
        $rawModulus = "0MGEnUxDpWP8PXNP42HkPJ1nnaSUZaf4gQGo0rwvoqJfpybtkeTsdsFi2OFu3AELiJMuzf0a7jxB8/u149AFgh0zHoMg9AMaRoCVlZGhkjvDjYJOonbwtStFswoOj4HOgh7K8ul3nJWonSuqmzCvNjMG7JMEY7/8bHaVPJ20ZpauSWeoFJav5RtR/AihxUWg0nlSbAZV6bnCQpsxOl2zjiMHW2EEvgA0K87sXmrtq34mzeNVixCBRQh/NxBpxU8NMcCcDV73K54jpkZd7FMlKRxBgG6qwNHYm2iQVM/+RtSGZBtExuOoHlj8jVltqQmN1e3N9F4XNhBIl8WU3BalcOYJMTgLktjbWlBPAuAiY4Qt4x/onCEH/oADg+xTyXoqCCnTeUsYeMVGMqfcJRzQ/w/iZ+Er5yCIs2xPfqtX7rcKrW3Dn0SzDimeBxB0hagspMn8qnvuI+BbIkHMLYrHLLXf9v448zGPh0dSNcq4snQa8K2Ds/sXaTUx/gi/hudELNztd80zFp8InGYlfW1yptUpDLIis4oLpvb82zUn5g3tSqFZhRkb254aFY6IvsfDP8De7mp8G0LbGL8zJemW96l7atNEHMNVoU6/kv+iUuJl7QXrGYnk6z48aecssRXNtcBAxjs9bo7r2DKis9vN8voJlaMvzO3G9b1Omn3XQCk=";
        $rawExponent = "AQAB"; // This is the standard Base64 for 65537

// Construct the XML key string
        $xmlPublicKey = "<RSAKeyValue>\n"
            . "  <Modulus>" . $rawModulus . "</Modulus>\n"
            . "  <Exponent>" . $rawExponent . "</Exponent>\n"
            . "</RSAKeyValue>";

        $rsa = new RSA();

// Try loading as XML string. phpseclib is usually good at detecting this.
        if (!$rsa->loadKey($xmlPublicKey)) {
            die("Hata: Açık anahtar XML formatında yüklenemedi. XML yapısını kontrol edin.");
        }

// 4. Dolgulama (Padding) Modunu Ayarlama
        $rsa->setEncryptionMode(RSA::ENCRYPTION_PKCS1);

// 5. Veriyi Şifreleme
        $encryptedBinary = $rsa->encrypt($encodedText);

        if ($encryptedBinary === false) {
            die("Şifreleme hatası. Lütfen anahtarın geçerliliğini ve padding modunun doğru olduğundan emin olun.");
        }

// Şifrelenmiş veriyi Base64 kodlamasına çevirme
        $base64EncryptedData = base64_encode($encryptedBinary);

        return bin2hex($encryptedBinary);

    }




}

<?php
// DASK Web Servis Ayarları
$wsdl = "https://galaksi.turknippon.com/appservice/dask-v2.asmx?wsdl";
$options = [
    'trace' => 1, // Hata ayıklama için gerekli
    'exceptions' => true,
    'proxy_host' => '159.253.39.221',
    'proxy_port' => '3346',
    'proxy_login' => 'Nice',
    'proxy_password' => 'Nice33+35*',
];

// Kullanıcı bilgileri
$authHeader = [
    'Channel'  => 31672, // Servis kanalı
    'Username' => '31672001', // Kullanıcı adı
    'Password' => '31672001' // Parola
];

// Giriş parametreleri
$daskInput = [
    'PrintType' => 1, // Poliçe basım türü (1 = E-posta)
    'IsTestMode' => false, // Test modu
    'Channel' => 31672, // Servis kanalı
    'Username' => '31672001', // Kullanıcı adı
    'TrackingCode' => '23b2fcad-e57b-4b0f-9d2b-51114d4c87bc', // Takip kodu
    'CitizenshipNumber' => '35935923964', // T.C. Kimlik No
    'BirthDate' => '1999-03-02T00:00:00', // Doğum tarihi
    'TaxNumber' => null, // Vergi numarası
    'UnitNo' => null, // Birim no
    'PolicyNo' => null, // Poliçe no
    'CashPaymentType' => 0, // Nakit ödeme tipi
    'UseCreditCard' => false, // Kredi kartı kullanımı
    'ClientNo' => null, // Müşteri numarası
    'ClientCitizenshipNumber' => '53989720452', // Sigorta ettiren T.C. Kimlik No
    'ClientTaxNumber' => null, // Sigorta ettiren vergi numarası
    'IsRenewal' => false, // Yeni iş için false
    'BeginDate' => '2025-04-13T13:13:16', // Poliçe başlangıç tarihi
    'DASKPolicyNo' => null, // DASK poliçe no
    'InsurerType' => 1, // Sigorta ettiren sıfatı (1 = Mal Sahibi)
    'MobilePhoneNumber' => '5454864759', // Cep telefonu
    'PhoneNumber' => '5454864759', // Telefon numarası
    'ClientMobilePhoneNumber' => '5454864759', // Müşteri cep telefonu
    'ClientPhoneNumber' => '5454864759', // Müşteri telefon numarası
    'RiskAddressCode' => '2182944385', // UAVT adres kodu
    'GrossAreaM2' => 130, // Dairenin brüt alanı (m²)
    'UsageType' => 5, // Kullanım şekli
    'BuildType' => 4, // İnşaat tipi
    'BuildYear' => 9, // İnşaat yılı
    'TotalFloor' => 6, // Toplam kat sayısı
    'AnteriorDamage' => 0, // Önceki hasar durumu
    'LossPayeeType' => 'Y', // Daini mürtehin durumu (Y = Yok)
];

try {
    // SOAP Client oluştur
    $client = new SoapClient($wsdl, $options);

    // AuthHeader ekle
    $header = new SoapHeader(
        'http://galaksi.turknippon.com/appservice/',
        'AuthHeader',
        $authHeader
    );
    $client->__setSoapHeaders($header);

    // Proposal fonksiyonunu çağır
    $result = $client->__soapCall('Proposal', [['Input' => $daskInput]]);
    print_r($result);

    // Yanıtı işle
    if ($result->ProposalResult->IsSuccess) {
        echo "Teklif başarıyla oluşturuldu!\n";
        echo "Poliçe No: " . $result->ProposalResult->PolicyNo . "\n";
        echo "Prim Tutarı: " . $result->ProposalResult->Premium . " TL\n";
        echo "Başlangıç Tarihi: " . $result->ProposalResult->BeginDate . "\n";
        echo "Bitiş Tarihi: " . $result->ProposalResult->EndDate . "\n";
    } else {
        echo "Hata: " . $result->ProposalResult->StatusDescription . "\n";
    }
} catch (SoapFault $e) {
    // SOAP hatalarını yakala
    echo "SOAP Hatası: " . $e->getMessage();
} catch (Exception $e) {
    // Diğer hatalar
    echo "Hata: " . $e->getMessage();
}


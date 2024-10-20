<?php
// Takımların sezonları ve urllerini buraya gir
$teams = [
    'Galatasaray' => 'https://arsiv.mackolik.com/Takim/1/Galatasaray/2023/2024',
    'Fenerbahce' => 'https://arsiv.mackolik.com/Takim/2/Fenerbahce/2023/2024',
    'Trabzonspor' => 'https://arsiv.mackolik.com/Takim/4/Trabzonspor/2023/2024',
    'Basaksehir' => 'https://arsiv.mackolik.com/Takim/451/Basaksehir-FK/2023/2024',
    'Kasimpasa' => 'https://arsiv.mackolik.com/Takim/656/Kasimpasa/2023/2024',
    'Besiktas' => 'https://arsiv.mackolik.com/Takim/3/Besiktas/2023/2024',
    'Sivasspor' => 'https://arsiv.mackolik.com/Takim/446/Sivasspor/2023/2024',
    'Alanyaspor' => 'https://arsiv.mackolik.com/Takim/619/Alanyaspor/2023/2024',
    'Caykur_Rizespor' => 'https://arsiv.mackolik.com/Takim/448/Caykur-Rizespor/2023/2024',
    'Antalyaspor' => 'https://arsiv.mackolik.com/Takim/455/Antalyaspor/2023/2024',
    'Gaziantep_FK' => 'https://arsiv.mackolik.com/Takim/572/Gaziantep-FK/2023/2024',
    'Adana_Demirspor' => 'https://arsiv.mackolik.com/Takim/454/Adana-Demirspor/2023/2024',
    'Samsunspor' => 'https://arsiv.mackolik.com/Takim/8/Samsunspor/2023/2024',
    'Kayserispor' => 'https://arsiv.mackolik.com/Takim/570/Kayserispor/2023/2024',
    'Hatayspor' => 'https://arsiv.mackolik.com/Takim/574/Hatayspor/2023/2024',
    'Konyaspor' => 'https://arsiv.mackolik.com/Takim/447/Konyaspor/2023/2024',
    'Ankaragucu' => 'https://arsiv.mackolik.com/Takim/9/MKE-Ankaragucu/2023/2024',
    'Karagumruk' => 'https://arsiv.mackolik.com/Takim/537/Fatih-Karagumruk/2023/2024',
    'Pendikspor' => 'https://arsiv.mackolik.com/Takim/659/Pendikspor/2023/2024',
    'Istanbulspor' => 'https://arsiv.mackolik.com/Takim/11/Istanbulspor/2023/2024'
];

// Json dosyasında hata oluşmaması için türkçe karakterleri çevir
function convertTurkishChars($str) {
    $turkish = ['ç', 'ö', 'ü', 'ğ', 'ı', 'ş', 'Ç', 'Ö', 'Ü', 'Ğ', 'İ', 'Ş', ' '];
    $english = ['c', 'o', 'u', 'g', 'i', 's', 'c', 'o', 'u', 'g', 'i', 's', '_'];
    return strtolower(str_replace($turkish, $english, $str));
}

// Takımların veilerini çek
$all_matches = [];

foreach ($teams as $team_name => $url) {
    // start curl
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    $response = curl_exec($ch);

    curl_close($ch);

    $dom = new DOMDocument;
    libxml_use_internal_errors(true);
    $dom->loadHTML($response);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);

    // Maç bilgilerini seç
    $rows = $xpath->query('//tr[contains(@class, "row")]');

    // JSON formatında toplayabilmek için dizi oluştur
    $matches = [];

    foreach ($rows as $row) {
        $date = $xpath->query('.//td[1]', $row)->item(0)->nodeValue;
        $side = $row->getAttribute('side');
        
        if ($side == 'home') {
            $homeTeamNode = $xpath->query('.//td[3]//span[@class="team"]', $row);
            $awayTeamNode = $xpath->query('.//td[7]//a', $row);
        } else if ($side == 'away') {
            $homeTeamNode = $xpath->query('.//td[3]//a', $row);
            $awayTeamNode = $xpath->query('.//td[7]//span[@class="team"]', $row);
        } else {
            continue;
        }

        $scoreNode = $xpath->query('.//td[5]//a', $row);

        $homeTeam = $homeTeamNode->length > 0 ? convertTurkishChars($homeTeamNode->item(0)->nodeValue) : '';
        $awayTeam = $awayTeamNode->length > 0 ? convertTurkishChars($awayTeamNode->item(0)->nodeValue) : '';
        $score = $scoreNode->length > 0 ? trim($scoreNode->item(0)->nodeValue) : '';

        // Verileri diziye ekle
        $matches[] = [
            'tarih' => $date,
            'ev_sahibi' => $homeTeam,
            'deplasman' => $awayTeam,
            'skor' => $score
        ];
    }

    // Tüm maçları birleştir
    $all_matches[$team_name] = $matches;
}

// JSON verilerini bir dosyaya yaz
$json_data = json_encode($all_matches, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
$file_name = 'takim_maclari.json';
file_put_contents($file_name, $json_data);

echo "Veriler $file_name dosyasına kaydedildi.\n";
?>
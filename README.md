# Mackolik Sezon Verileri

Php kullanarak MaçKolik https://arsiv.mackolik.com/Takim/2/Fenerbahce/2023/2024 sitesinden takımların maç tarihleri, ev sahibi, deplasman, skor bilgilerini JSON ve TXT olarak çıkartır.





## Kullanım

```j<?php
// Takımların sezonları ve urllerini buraya gir
$teams = [
    'Galatasaray' => 'https://arsiv.mackolik.com/Takim/1/Galatasaray/2023/2024',
    'Fenerbahce' => 'https://arsiv.mackolik.com/Takim/2/Fenerbahce/2023/2024',
    'Trabzonspor' => 'https://arsiv.mackolik.com/Takim/4/Trabzonspor/2023/2024',
    'Basaksehir' => 'https://arsiv.mackolik.com/Takim/451/Basaksehir-FK/2023/2024',
    'Kasimpasa' => 'https://arsiv.mackolik.com/Takim/656/Kasimpasa/2023/2024',
    'Besiktas' => 'https://arsiv.mackolik.com/Takim/3/Besiktas/2023/2024',
    'Sivasspor' => 'https://arsiv.mackolik.com/Takim/446/Sivasspor/2023/2024',
    'Alanyaspor' => 'https://arsiv.mackolik.com/Takim/619/Alanyaspor/2023/2024'
];

```
İstenilen sezonun maçlarını almak için siteden aldığınız linkleri yapıştırın


<p1> KODU TERMİNALDE AÇTIKTAN SONRA php -S localhost:8080 ile başlatın. </p1>

<img width="1073" alt="image" src="https://github.com/user-attachments/assets/f333a258-d9cd-4585-9b33-4ed43b4fc244">



## Screenshots
<img width="738" alt="image" src="https://github.com/user-attachments/assets/0b108f33-01b7-4821-be70-1730af056552">

localhosttan girip kontrol edebilirsiniz localhost:8080/vericek.php verilen çekilmesi yaklaşık 25 saniye sürüyor çekildikten sonra belirttiğim adreste
<img width="1716" alt="image" src="https://github.com/user-attachments/assets/696271dd-f469-4717-915c-963f2613927f">
çekildiği yazacaktır ve klasörünüzde txt ile json oluşucaktır









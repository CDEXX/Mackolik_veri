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



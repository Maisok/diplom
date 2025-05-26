<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['name' => 'Россия', 'code' => 'RU'],
            ['name' => 'Германия', 'code' => 'DE'],
            ['name' => 'Япония', 'code' => 'JP'],
            ['name' => 'США', 'code' => 'US'],
            ['name' => 'Китай', 'code' => 'CN'],
            ['name' => 'Корея', 'code' => 'KR'],
            ['name' => 'Франция', 'code' => 'FR'],
            ['name' => 'Италия', 'code' => 'IT'],
            ['name' => 'Великобритания', 'code' => 'GB'],
            ['name' => 'Швеция', 'code' => 'SE'],
        ];
        
        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
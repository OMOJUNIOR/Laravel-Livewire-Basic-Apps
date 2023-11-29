<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Province;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            'Bursa', 'İstanbul', 'Ankara', 'İzmir'
        ];

        $provinces = [
            ['city' => 'Bursa', 'provinces' => ['Osmangazi', 'Nilüfer']],
            ['city' => 'İstanbul', 'provinces' => ['Kadıköy', 'Üsküdar']],
            ['city' => 'Ankara', 'provinces' => ['Çankaya', 'Keçiören']],
            ['city' => 'İzmir', 'provinces' => ['Konak', 'Karşıyaka']],
        ];

        foreach ($cities as $cityName) {
            $city = City::create(['name' => $cityName]);

            foreach ($provinces as $provinceData) {
                if ($provinceData['city'] === $cityName) {
                    foreach ($provinceData['provinces'] as $provinceName) {
                        Province::create([
                            'city_id' => $city->id,
                            'name' => $provinceName,
                        ]);
                    }
                }
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Address\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $countries = [
            [
                'continent_id' => 3,
                'country_name' => 'Nepal',
                'code' => 'NP'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'India',
                'code' => 'IN'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'China',
                'code' => 'CN'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'Bangladesh',
                'code' => 'BD'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'Pakistan',
                'code' => 'PK'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'Sri Lanka',
                'code' => 'LK'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'Bhutan',
                'code' => 'BT'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'Maldives',
                'code' => 'MV'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'Afghanistan',
                'code' => 'AF'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'Myanmar',
                'code' => 'MM'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'Thailand',
                'code' => 'TH'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'Vietnam',
                'code' => 'VN'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'Laos',
                'code' => 'LA'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'Cambodia',
                'code' => 'KH'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'Malaysia',
                'code' => 'MY'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'Singapore',
                'code' => 'SG'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'Indonesia',
                'code' => 'ID'
            ],
        ];
        foreach ($countries as $key => $value) {
            $total = Country::where('country_name', $value['country_name'])->count();
            if ($total === 0) {
                Country::create($value);
            }
        }

    }
}

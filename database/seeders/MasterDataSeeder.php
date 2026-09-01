<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\ProductCategory;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            'ID' => [
                'name' => 'Indonesia',
                'regions' => [
                    'Aceh', 'Sumatera Utara', 'Sumatera Barat', 'Riau', 'Kepulauan Riau', 'Jambi',
                    'Sumatera Selatan', 'Bengkulu', 'Lampung', 'DKI Jakarta', 'Jawa Barat', 'Jawa Tengah',
                    'DI Yogyakarta', 'Jawa Timur', 'Banten', 'Bali', 'Nusa Tenggara Barat', 'Nusa Tenggara Timur',
                    'Kalimantan Barat', 'Kalimantan Tengah', 'Kalimantan Selatan', 'Kalimantan Timur',
                    'Kalimantan Utara', 'Sulawesi Utara', 'Sulawesi Tengah', 'Sulawesi Selatan',
                    'Sulawesi Tenggara', 'Gorontalo', 'Sulawesi Barat', 'Maluku', 'Maluku Utara',
                    'Papua', 'Papua Barat',
                ],
            ],
            'MY' => [
                'name' => 'Malaysia',
                'regions' => [
                    'Johor', 'Kedah', 'Kelantan', 'Kuala Lumpur', 'Labuan', 'Melaka', 'Negeri Sembilan',
                    'Pahang', 'Penang', 'Perak', 'Perlis', 'Putrajaya', 'Sabah', 'Sarawak', 'Selangor', 'Terengganu',
                ],
            ],
            'TH' => [
                'name' => 'Thailand',
                'regions' => [
                    'Amnat Charoen', 'Ang Thong', 'Bangkok', 'Bueng Kan', 'Buriram', 'Chachoengsao',
                    'Chai Nat', 'Chaiyaphum', 'Chanthaburi', 'Chiang Mai', 'Chiang Rai', 'Chonburi',
                    'Chumphon', 'Kalasin', 'Kamphaeng Phet', 'Kanchanaburi', 'Khon Kaen', 'Krabi',
                    'Lampang', 'Lamphun', 'Loei', 'Lopburi', 'Mae Hong Son', 'Maha Sarakham',
                    'Mukdahan', 'Nakhon Nayok', 'Nakhon Pathom', 'Nakhon Phanom', 'Nakhon Ratchasima',
                    'Nakhon Sawan', 'Nakhon Si Thammarat', 'Nan', 'Narathiwat', 'Nong Bua Lamphu',
                    'Nong Khai', 'Nonthaburi', 'Pathum Thani', 'Pattani', 'Phang Nga', 'Phatthalung',
                    'Phayao', 'Phetchabun', 'Phetchaburi', 'Phichit', 'Phitsanulok', 'Phrae',
                    'Phuket', 'Prachinburi', 'Prachuap Khiri Khan', 'Ranong', 'Ratchaburi', 'Rayong',
                    'Roi Et', 'Sa Kaeo', 'Sakon Nakhon', 'Samut Prakan', 'Samut Sakhon', 'Samut Songkhram',
                    'Saraburi', 'Satun', 'Sing Buri', 'Sisaket', 'Songkhla', 'Sukhothai',
                    'Suphan Buri', 'Surat Thani', 'Surin', 'Tak', 'Trang', 'Trat', 'Ubon Ratchathani',
                    'Udon Thani', 'Uthai Thani', 'Uttaradit', 'Yala', 'Yasothon',
                ],
            ],
        ];

        foreach ($countries as $code => $countryData) {
            $country = Country::query()->updateOrCreate(
                ['code' => $code],
                ['name' => $countryData['name'], 'code' => $code, 'is_active' => true]
            );

            foreach ($countryData['regions'] as $regionName) {
                Region::query()->updateOrCreate(
                    ['country_id' => $country->id, 'name' => $regionName],
                    [
                        'country_id' => $country->id,
                        'name' => $regionName,
                        'code' => Str::slug($regionName),
                        'type' => 'province',
                        'is_active' => true,
                    ]
                );
            }
        }

        $productCategories = [
            'Agriculture',
            'Apparel',
            'Automobiles & Motorcycles',
            'Beauty & Personal Care',
            'Chemicals',
            'Computer Hardware & Software',
            'Construction & Real Estate',
            'Consumer Electronics',
            'Electrical Equipment & Supplies',
            'Electronic Components & Supplies',
            'Food & Beverage',
            'Furniture',
            'Health & Medical',
            'Home & Garden',
            'Industrial Machinery',
            'Minerals & Metallurgy',
            'Packaging & Printing',
            'Security & Protection',
            'Service Equipment',
            'Textiles & Leather Products',
            'Tools & Hardware',
        ];

        foreach ($productCategories as $name) {
            ProductCategory::query()->updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => $name,
                    'is_active' => true,
                ]
            );
        }
    }
}

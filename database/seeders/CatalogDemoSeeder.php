<?php

namespace Database\Seeders;

use App\Models\CompanyContact;
use App\Models\CompanyProfile;
use App\Models\Country;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CatalogDemoSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ProductCategory::query()->pluck('id', 'slug');
        $countries = Country::query()->pluck('id', 'code');

        $companies = [
            [
                'user' => [
                    'name' => 'Rizal Hidayat',
                    'email' => 'supplier.riau@imtgt.test',
                    'username' => 'supplierriau',
                    'account_type' => 'supplier',
                ],
                'country_code' => 'ID',
                'region_name' => 'Riau',
                'profile' => [
                    'company_prefix' => 'PT',
                    'company_name' => 'Riau PalmTech Nusantara',
                    'year_of_establishment' => 2014,
                    'main_product' => 'Refined palm oil, oleochemical derivative, and industrial packaging support',
                    'company_description' => 'Perusahaan manufaktur dan perdagangan yang fokus pada produk turunan sawit, minyak nabati, dan kebutuhan bahan baku industri untuk pasar Asia Tenggara.',
                    'address' => 'Jl. Soekarno Hatta No. 88, Pekanbaru, Riau',
                    'city' => 'Pekanbaru',
                    'zip_code' => '28282',
                    'scale_of_business' => '> 10.000.000.000',
                    'incoterm' => 'FOB',
                    'terms_of_payment' => 'LC',
                    'employee_count' => 145,
                    'website' => 'https://riau-palmtech.example',
                    'business_email' => 'sales@riau-palmtech.example',
                    'business_phone' => '+62 761 555 0101',
                    'type_of_business' => 'manufacturer',
                    'type_of_business_detail' => 'Palm derivative exporter',
                    'google_maps_link' => 'https://maps.google.com/?q=Pekanbaru',
                    'longitude' => '101.4478',
                    'latitude' => '0.5071',
                ],
                'contacts' => [
                    ['name' => 'Rizal Hidayat', 'position' => 'Export Manager', 'phone' => '+62 812 7000 101', 'email' => 'rizal@riau-palmtech.example'],
                    ['name' => 'Meylina Putri', 'position' => 'Trade Liaison', 'phone' => '+62 812 7000 102', 'email' => 'meylina@riau-palmtech.example'],
                ],
                'products' => [
                    [
                        'category_slug' => 'chemicals',
                        'title' => 'Industrial Grade Palm Fatty Acid',
                        'trade_kind' => 'goods',
                        'import_type' => 'Bulk industrial raw material',
                        'show_price' => true,
                        'price' => 18500000,
                        'currency' => 'IDR',
                        'price_unit' => 'per ton',
                        'description' => 'Palm fatty acid for oleochemical processing, soap manufacturing, and industrial blending requirements.',
                        'origin_country' => 'Indonesia',
                        'brand' => 'PalmTech',
                        'model' => 'PFA-78',
                        'sku' => 'PTN-PFA-78',
                        'hs_code' => '3823.19',
                        'min_order_qty' => '5 tons',
                        'production_capacity' => '500 tons / month',
                        'delivery_time' => '14 - 21 days',
                        'packaging' => 'IBC tank and drum',
                        'specifications' => "FFA content: 78%\nColor: light yellow\nApplication: oleochemical and industrial blending",
                        'additional_information' => 'Available for contract manufacturing and long-term supply agreement.',
                        'seo_keywords' => 'palm fatty acid, oleochemical, industrial raw material',
                        'support_contact' => 'rizal@riau-palmtech.example',
                    ],
                    [
                        'category_slug' => 'packaging-printing',
                        'title' => 'Export Drum Packaging Service',
                        'trade_kind' => 'services',
                        'import_type' => 'Cross-border industrial support',
                        'show_price' => false,
                        'price' => null,
                        'currency' => 'IDR',
                        'price_unit' => null,
                        'description' => 'Packaging preparation, relabeling, and export-grade drum handling service for liquid industrial products.',
                        'origin_country' => 'Indonesia',
                        'brand' => 'PalmTech Logistics',
                        'model' => 'Service Package',
                        'sku' => 'PTN-SVC-DRUM',
                        'hs_code' => '9801.00',
                        'min_order_qty' => '1 shipment',
                        'production_capacity' => '120 shipments / month',
                        'delivery_time' => '7 days',
                        'packaging' => 'Handled per shipment requirement',
                        'specifications' => "Support: relabeling, drum sealing, documentation assistance\nCoverage: Pekanbaru and Dumai export corridor",
                        'additional_information' => 'Suitable for regional B2B customers that require bundled packaging and documentation.',
                        'seo_keywords' => 'export packaging, drum handling, logistics support',
                        'support_contact' => 'meylina@riau-palmtech.example',
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => 'Farah Nabila',
                    'email' => 'supplier.malaysia@imtgt.test',
                    'username' => 'suppliermalaysia',
                    'account_type' => 'supplier',
                ],
                'country_code' => 'MY',
                'region_name' => 'Selangor',
                'profile' => [
                    'company_prefix' => 'Others',
                    'company_name' => 'Selangor Smart Components',
                    'year_of_establishment' => 2017,
                    'main_product' => 'Electronic components, embedded control units, and OEM assembly support',
                    'company_description' => 'Penyedia komponen elektronik dan layanan OEM untuk kebutuhan consumer electronics, smart appliance, dan automation module.',
                    'address' => 'No. 21, Jalan Teknologi 3/4, Shah Alam, Selangor',
                    'city' => 'Shah Alam',
                    'zip_code' => '40150',
                    'scale_of_business' => '5.000.000.000 - 10.000.000.000',
                    'incoterm' => 'CIF',
                    'terms_of_payment' => 'TT',
                    'employee_count' => 86,
                    'website' => 'https://selangor-components.example',
                    'business_email' => 'hello@selangor-components.example',
                    'business_phone' => '+60 3 5544 8891',
                    'type_of_business' => 'distributor',
                    'type_of_business_detail' => 'Electronic parts and OEM module supplier',
                    'google_maps_link' => 'https://maps.google.com/?q=Shah+Alam',
                    'longitude' => '101.5183',
                    'latitude' => '3.0738',
                ],
                'contacts' => [
                    ['name' => 'Farah Nabila', 'position' => 'Business Development Lead', 'phone' => '+60 12 880 1101', 'email' => 'farah@selangor-components.example'],
                ],
                'products' => [
                    [
                        'category_slug' => 'electronic-components-supplies',
                        'title' => 'Smart Appliance Control Board',
                        'trade_kind' => 'goods',
                        'import_type' => 'OEM electronic module',
                        'show_price' => true,
                        'price' => 220,
                        'currency' => 'MYR',
                        'price_unit' => 'per unit',
                        'description' => 'Multi-purpose control board for smart appliance manufacturing with customizable firmware support.',
                        'origin_country' => 'Malaysia',
                        'brand' => 'SSC',
                        'model' => 'CTRL-X4',
                        'sku' => 'SSC-CTRL-X4',
                        'hs_code' => '8537.10',
                        'min_order_qty' => '200 units',
                        'production_capacity' => '8,000 units / month',
                        'delivery_time' => '10 - 18 days',
                        'packaging' => 'Anti-static tray and carton',
                        'specifications' => "Voltage: 220V\nConnectivity: WiFi / BLE\nFirmware customization: available",
                        'additional_information' => 'Engineering support is available for buyer-side integration testing.',
                        'seo_keywords' => 'control board, OEM electronics, smart appliance',
                        'support_contact' => 'farah@selangor-components.example',
                    ],
                    [
                        'category_slug' => 'computer-hardware-software',
                        'title' => 'Embedded Software Localization Service',
                        'trade_kind' => 'services',
                        'import_type' => 'Software adaptation service',
                        'show_price' => false,
                        'price' => null,
                        'currency' => 'MYR',
                        'price_unit' => null,
                        'description' => 'Firmware localization and multilingual menu implementation for exported consumer devices.',
                        'origin_country' => 'Malaysia',
                        'brand' => 'SSC Digital',
                        'model' => 'Localization Suite',
                        'sku' => 'SSC-SVC-I18N',
                        'hs_code' => '9983.14',
                        'min_order_qty' => '1 project',
                        'production_capacity' => '12 projects / month',
                        'delivery_time' => '2 - 4 weeks',
                        'packaging' => 'Digital delivery',
                        'specifications' => "Languages: English, Bahasa Indonesia, Thai\nSupport: UI string mapping and firmware QA",
                        'additional_information' => 'Suitable for importers that need regional language adaptation before retail distribution.',
                        'seo_keywords' => 'embedded software, localization, firmware QA',
                        'support_contact' => 'farah@selangor-components.example',
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => 'Anucha Srisawat',
                    'email' => 'supplier.thailand@imtgt.test',
                    'username' => 'supplierthailand',
                    'account_type' => 'supplier',
                ],
                'country_code' => 'TH',
                'region_name' => 'Bangkok',
                'profile' => [
                    'company_prefix' => 'Others',
                    'company_name' => 'Bangkok Agro Spice Hub',
                    'year_of_establishment' => 2012,
                    'main_product' => 'Dried herbs, processed spice, and hospitality-ready food ingredient packs',
                    'company_description' => 'Eksportir bahan pangan olahan dan rempah siap distribusi untuk pasar horeca, retail specialty, dan buyer regional.',
                    'address' => '78 Rama IX Road, Huai Khwang, Bangkok',
                    'city' => 'Bangkok',
                    'zip_code' => '10310',
                    'scale_of_business' => '1.000.000.000 - 5.000.000.000',
                    'incoterm' => 'EXW',
                    'terms_of_payment' => 'TT',
                    'employee_count' => 52,
                    'website' => 'https://bangkok-spice.example',
                    'business_email' => 'trade@bangkok-spice.example',
                    'business_phone' => '+66 2 445 8811',
                    'type_of_business' => 'trader',
                    'type_of_business_detail' => 'Processed spice and ingredient exporter',
                    'google_maps_link' => 'https://maps.google.com/?q=Bangkok',
                    'longitude' => '100.5018',
                    'latitude' => '13.7563',
                ],
                'contacts' => [
                    ['name' => 'Anucha Srisawat', 'position' => 'Regional Trade Contact', 'phone' => '+66 81 778 3301', 'email' => 'anucha@bangkok-spice.example'],
                    ['name' => 'Suda Pranee', 'position' => 'Sales Coordinator', 'phone' => '+66 81 778 3302', 'email' => 'suda@bangkok-spice.example'],
                ],
                'products' => [
                    [
                        'category_slug' => 'food-beverage',
                        'title' => 'Premium Dried Lemongrass Cut',
                        'trade_kind' => 'goods',
                        'import_type' => 'Processed food ingredient',
                        'show_price' => true,
                        'price' => 95,
                        'currency' => 'USD',
                        'price_unit' => 'per carton',
                        'description' => 'Food-grade dried lemongrass cut for horeca, seasoning blends, and beverage infusion.',
                        'origin_country' => 'Thailand',
                        'brand' => 'Agro Spice Hub',
                        'model' => 'LG-12',
                        'sku' => 'BASH-LG-12',
                        'hs_code' => '1211.90',
                        'min_order_qty' => '50 cartons',
                        'production_capacity' => '3,000 cartons / month',
                        'delivery_time' => '12 days',
                        'packaging' => 'Vacuum inner pack with export carton',
                        'specifications' => "Moisture: below 8%\nCut size: 3 - 5 cm\nShelf life: 18 months",
                        'additional_information' => 'Custom label and private brand packaging are available for distributor orders.',
                        'seo_keywords' => 'dried lemongrass, food ingredient, thai spice',
                        'support_contact' => 'trade@bangkok-spice.example',
                    ],
                    [
                        'category_slug' => 'agriculture',
                        'title' => 'Regional Food Sourcing Assistance',
                        'trade_kind' => 'services',
                        'import_type' => 'Cross-border sourcing service',
                        'show_price' => false,
                        'price' => null,
                        'currency' => 'USD',
                        'price_unit' => null,
                        'description' => 'Supplier matching and sourcing support for dried herbs, spice packs, and processed agricultural inputs.',
                        'origin_country' => 'Thailand',
                        'brand' => 'Agro Spice Hub Service',
                        'model' => 'Sourcing Desk',
                        'sku' => 'BASH-SVC-SRC',
                        'hs_code' => '9985.90',
                        'min_order_qty' => '1 sourcing brief',
                        'production_capacity' => '20 briefs / month',
                        'delivery_time' => '5 - 10 days',
                        'packaging' => 'Digital report and sourcing summary',
                        'specifications' => "Includes supplier shortlist, baseline costing, and sample coordination",
                        'additional_information' => 'Recommended for importers who need pre-qualification before first order.',
                        'seo_keywords' => 'food sourcing, supplier matching, agriculture service',
                        'support_contact' => 'suda@bangkok-spice.example',
                    ],
                ],
            ],
        ];

        foreach ($companies as $companyData) {
            $countryId = $countries[$companyData['country_code']] ?? null;
            $region = Region::query()
                ->where('country_id', $countryId)
                ->where('name', $companyData['region_name'])
                ->first();

            if (! $countryId || ! $region) {
                continue;
            }

            $user = User::query()->updateOrCreate(
                ['email' => $companyData['user']['email']],
                [
                    'name' => $companyData['user']['name'],
                    'username' => $companyData['user']['username'],
                    'account_type' => $companyData['user']['account_type'],
                    'country_id' => $countryId,
                    'region_id' => $region->id,
                    'province' => $region->name,
                    'password' => 'password',
                ]
            );

            $profile = CompanyProfile::query()->updateOrCreate(
                ['user_id' => $user->id],
                $companyData['profile'] + [
                    'country_id' => $countryId,
                    'region_id' => $region->id,
                    'province' => $region->name,
                    'profile_completed_at' => now(),
                ]
            );

            $profile->contacts()->delete();

            foreach ($companyData['contacts'] as $index => $contact) {
                CompanyContact::query()->create([
                    'company_profile_id' => $profile->id,
                    'name' => $contact['name'],
                    'position' => $contact['position'],
                    'phone' => $contact['phone'],
                    'email' => $contact['email'],
                    'sort_order' => $index + 1,
                ]);
            }

            foreach ($companyData['products'] as $productData) {
                $title = $productData['title'];
                $slug = Str::slug($title);

                Product::query()->updateOrCreate(
                    ['slug' => $slug],
                    [
                        'user_id' => $user->id,
                        'company_profile_id' => $profile->id,
                        'product_category_id' => $categories[$productData['category_slug']] ?? null,
                        'title' => $title,
                        'slug' => $slug,
                        'status' => 'published',
                        'trade_kind' => $productData['trade_kind'],
                        'import_type' => $productData['import_type'],
                        'show_price' => $productData['show_price'],
                        'price' => $productData['price'],
                        'currency' => $productData['currency'],
                        'price_unit' => $productData['price_unit'],
                        'description' => $productData['description'],
                        'video_url' => null,
                        'origin_country' => $productData['origin_country'],
                        'brand' => $productData['brand'],
                        'model' => $productData['model'],
                        'sku' => $productData['sku'],
                        'hs_code' => $productData['hs_code'],
                        'min_order_qty' => $productData['min_order_qty'],
                        'production_capacity' => $productData['production_capacity'],
                        'delivery_time' => $productData['delivery_time'],
                        'packaging' => $productData['packaging'],
                        'specifications' => $productData['specifications'],
                        'additional_information' => $productData['additional_information'],
                        'seo_keywords' => $productData['seo_keywords'],
                        'support_contact' => $productData['support_contact'],
                        'is_hazardous' => false,
                        'published_at' => now()->subDays(rand(1, 25)),
                    ]
                );
            }
        }
    }
}

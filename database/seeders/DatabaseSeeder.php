<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            FoundationSeeder::class,
            MasterDataSeeder::class,
            CmsSeeder::class,
            CatalogDemoSeeder::class,
        ]);

        $superAdmin = User::query()->firstOrCreate([
            'email' => 'admin@imtgt.test',
        ], [
            'name' => 'Super Administrator',
            'username' => 'superadmin',
            'password' => 'password',
        ]);

        $superAdmin->assignRole('super-admin');
    }
}

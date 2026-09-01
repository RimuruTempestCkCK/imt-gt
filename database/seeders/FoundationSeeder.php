<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class FoundationSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'Lihat dashboard admin', 'code' => 'dashboard.view', 'group' => 'dashboard'],
            ['name' => 'Lihat user', 'code' => 'users.view', 'group' => 'users'],
            ['name' => 'Lihat role', 'code' => 'roles.view', 'group' => 'access'],
            ['name' => 'Lihat permission', 'code' => 'permissions.view', 'group' => 'access'],
            ['name' => 'Lihat settings', 'code' => 'settings.view', 'group' => 'settings'],
            ['name' => 'Ubah settings', 'code' => 'settings.update', 'group' => 'settings'],
            ['name' => 'Lihat audit log', 'code' => 'audit-logs.view', 'group' => 'audit'],
            ['name' => 'Lihat berita', 'code' => 'news.view', 'group' => 'cms'],
            ['name' => 'Kelola berita', 'code' => 'news.manage', 'group' => 'cms'],
            ['name' => 'Lihat kategori', 'code' => 'categories.view', 'group' => 'cms'],
            ['name' => 'Kelola kategori', 'code' => 'categories.manage', 'group' => 'cms'],
            ['name' => 'Lihat tag', 'code' => 'tags.view', 'group' => 'cms'],
            ['name' => 'Kelola tag', 'code' => 'tags.manage', 'group' => 'cms'],
            ['name' => 'Lihat halaman statis', 'code' => 'pages.view', 'group' => 'cms'],
            ['name' => 'Kelola halaman statis', 'code' => 'pages.manage', 'group' => 'cms'],
            ['name' => 'Lihat media library', 'code' => 'media.view', 'group' => 'cms'],
            ['name' => 'Kelola media library', 'code' => 'media.manage', 'group' => 'cms'],
            ['name' => 'Lihat banner', 'code' => 'banners.view', 'group' => 'cms'],
            ['name' => 'Kelola banner', 'code' => 'banners.manage', 'group' => 'cms'],
            ['name' => 'Lihat menu', 'code' => 'menus.view', 'group' => 'cms'],
            ['name' => 'Kelola menu', 'code' => 'menus.manage', 'group' => 'cms'],
            ['name' => 'Lihat sambutan', 'code' => 'greetings.view', 'group' => 'cms'],
            ['name' => 'Kelola sambutan', 'code' => 'greetings.manage', 'group' => 'cms'],
            ['name' => 'Lihat profil', 'code' => 'profiles.view', 'group' => 'cms'],
            ['name' => 'Kelola profil', 'code' => 'profiles.manage', 'group' => 'cms'],
        ];

        foreach ($permissions as $permission) {
            Permission::query()->updateOrCreate(
                ['code' => $permission['code']],
                $permission + ['description' => null]
            );
        }

        $roles = [
            'super-admin' => ['Super Administrator', true, Permission::query()->pluck('code')->all()],
            'administrator' => ['Administrator', true, [
                'dashboard.view', 'users.view', 'roles.view', 'permissions.view', 'settings.view', 'audit-logs.view',
                'news.view', 'news.manage', 'categories.view', 'categories.manage', 'tags.view', 'tags.manage',
                'pages.view', 'pages.manage', 'media.view', 'media.manage', 'banners.view', 'banners.manage',
                'menus.view', 'menus.manage', 'greetings.view', 'greetings.manage', 'profiles.view', 'profiles.manage',
            ]],
            'operator' => ['Operator', true, ['dashboard.view', 'news.view', 'news.manage', 'pages.view', 'pages.manage', 'media.view', 'media.manage']],
            'verifikator' => ['Verifikator', true, ['dashboard.view', 'news.view', 'pages.view', 'profiles.view']],
            'approver' => ['Approver', true, ['dashboard.view', 'news.view', 'pages.view', 'banners.view', 'profiles.view']],
        ];

        foreach ($roles as $code => [$name, $system, $permissionCodes]) {
            $role = Role::query()->updateOrCreate(
                ['code' => $code],
                [
                    'name' => $name,
                    'description' => $name,
                    'is_system' => $system,
                ]
            );

            $role->permissions()->sync(
                Permission::query()->whereIn('code', $permissionCodes)->pluck('id')->all()
            );
        }

        $settings = [
            ['key' => 'app_name', 'value' => 'IMT-GT', 'label' => 'Nama Aplikasi', 'is_public' => true],
            ['key' => 'app_tagline', 'value' => 'Indonesia IMT-GT Business Centre', 'label' => 'Tagline', 'is_public' => true],
            ['key' => 'app_email', 'value' => 'info@indonesia-imtgt.test', 'label' => 'Email', 'is_public' => true],
            ['key' => 'app_phone', 'value' => '+62 21 000 000', 'label' => 'Telepon', 'is_public' => true],
            ['key' => 'app_address', 'value' => 'Indonesia IMT-GT Business Centre, Indonesia', 'label' => 'Alamat', 'is_public' => true],
            ['key' => 'app_locale', 'value' => 'id', 'label' => 'Locale', 'is_public' => false],
            ['key' => 'app_timezone', 'value' => 'Asia/Jakarta', 'label' => 'Timezone', 'is_public' => false],
            ['key' => 'hero_title', 'value' => 'Menghubungkan Potensi Indonesia IMT-GT dengan Kolaborasi Bisnis Regional.', 'label' => 'Hero Title', 'is_public' => true],
            ['key' => 'hero_subtitle', 'value' => 'Portal resmi untuk informasi perdagangan, investasi, UMKM, dan kerja sama kawasan IMT-GT.', 'label' => 'Hero Subtitle', 'is_public' => true],
        ];

        foreach ($settings as $setting) {
            Setting::query()->updateOrCreate(
                ['key' => $setting['key']],
                $setting + ['type' => 'text', 'group' => 'general']
            );
        }
    }
}

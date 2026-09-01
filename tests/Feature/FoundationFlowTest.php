<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FoundationFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_admin_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_super_admin_can_access_dashboard(): void
    {
        $role = Role::factory()->create([
            'name' => 'Super Administrator',
            'code' => 'super-admin',
        ]);

        $permission = Permission::factory()->create([
            'name' => 'Lihat dashboard admin',
            'code' => 'dashboard.view',
            'group' => 'dashboard',
        ]);

        $role->permissions()->attach($permission);

        $user = User::factory()->create();
        $user->roles()->attach($role);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertOk();
    }

    public function test_public_homepage_uses_settings_from_database(): void
    {
        Setting::query()->create([
            'key' => 'hero_title',
            'value' => 'Judul Hero Dari Database',
            'type' => 'text',
            'group' => 'general',
            'label' => 'Hero Title',
            'is_public' => true,
        ]);

        $response = $this->get(route('home'));

        $response->assertSee('Judul Hero Dari Database');
    }
}

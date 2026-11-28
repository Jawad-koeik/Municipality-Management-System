<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class AuthAndRbacTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_public_registration_always_assigns_citizen_role_and_creates_citizen_profile(): void
    {
        $adminRole = Role::where('slug', Role::ADMIN)->firstOrFail();

        $response = $this->post('/register', [
            'name' => 'New Citizen',
            'email' => 'newcitizen@mms.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'national_id' => 'LB-999001',
            'address' => 'Beirut',
            'contact' => '+961 71 000001',
            'date_of_birth' => '1999-01-15',
            'role_id' => $adminRole->id,
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();

        $user = User::where('email', 'newcitizen@mms.test')->firstOrFail();
        $this->assertTrue($user->hasRole(Role::CITIZEN));
        $this->assertFalse($user->hasRole(Role::ADMIN));
        $this->assertDatabaseHas('citizens', [
            'user_id' => $user->id,
            'national_id' => 'LB-999001',
        ]);
    }

    public function test_seeded_user_can_login_view_dashboard_and_logout(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@mms.test',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();

        $this->get('/dashboard')
            ->assertOk()
            ->assertSee('أحمد المدير');

        $this->post('/logout')->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_inactive_user_cannot_login(): void
    {
        $user = User::where('email', 'citizen@mms.test')->firstOrFail();
        $user->update(['status' => 'inactive']);

        $response = $this->post('/login', [
            'email' => 'citizen@mms.test',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_role_middleware_allows_authorized_role_and_blocks_others(): void
    {
        Route::middleware(['web', 'auth', 'role:admin,finance_officer'])
            ->get('/_test-finance', fn () => response('ok'));

        $citizen = User::where('email', 'citizen@mms.test')->firstOrFail();
        $finance = User::where('email', 'finance@mms.test')->firstOrFail();

        $this->actingAs($citizen)->get('/_test-finance')->assertForbidden();
        $this->actingAs($finance)->get('/_test-finance')->assertOk();
    }

    public function test_language_switcher_toggles_between_english_ltr_and_arabic_rtl(): void
    {
        $this->get('/locale/ar')->assertRedirect();

        $this->get('/login')
            ->assertOk()
            ->assertSee('dir="rtl"', false)
            ->assertSee('تسجيل الدخول');

        $this->get('/locale/en')->assertRedirect();

        $this->get('/login')
            ->assertOk()
            ->assertSee('dir="ltr"', false)
            ->assertSee('Log in');
    }
}

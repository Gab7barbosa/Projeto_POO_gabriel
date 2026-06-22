<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MangaStoreAccessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that guests are redirected to login for secure routes.
     */
    public function test_guests_are_redirected_to_login(): void
    {
        $this->get(route('dashboard'))->assertRedirect(route('login'));
        $this->get(route('mangas.index'))->assertRedirect(route('login'));
        $this->get(route('clientes.index'))->assertRedirect(route('login'));
        $this->get(route('funcionarios.index'))->assertRedirect(route('login'));
    }

    /**
     * Test that an employee (funcionario) can access dashboard, mangas, and clients,
     * but is forbidden from accessing the employees management pages.
     */
    public function test_funcionario_permissions(): void
    {
        $funcionario = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'role' => 'funcionario',
            'cpf' => '000.000.000-00',
            'active' => true,
        ]);

        $response = $this->actingAs($funcionario);

        $response->get(route('dashboard'))->assertStatus(200);
        $response->get(route('mangas.index'))->assertStatus(200);
        $response->get(route('clientes.index'))->assertStatus(200);
        
        // Assert forbidden (403) for employees list
        $response->get(route('funcionarios.index'))->assertStatus(403);
    }

    /**
     * Test that an admin can access all resources.
     */
    public function test_admin_permissions(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'cpf' => '111.111.111-11',
            'active' => true,
        ]);

        $response = $this->actingAs($admin);

        $response->get(route('dashboard'))->assertStatus(200);
        $response->get(route('mangas.index'))->assertStatus(200);
        $response->get(route('clientes.index'))->assertStatus(200);
        $response->get(route('funcionarios.index'))->assertStatus(200);
    }

    /**
     * Test that inactive users are logged out and redirected with an error.
     */
    public function test_inactive_user_cannot_access(): void
    {
        $inactive = User::create([
            'name' => 'Inactive User',
            'email' => 'inactive@example.com',
            'password' => bcrypt('password'),
            'role' => 'funcionario',
            'cpf' => '222.222.222-22',
            'active' => false,
        ]);

        // Accessing a page with an inactive logged in user triggers the role middleware block
        $response = $this->actingAs($inactive)->get(route('dashboard'));
        
        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}

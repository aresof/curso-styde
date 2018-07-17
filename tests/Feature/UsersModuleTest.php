<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    function it_loads_the_users_list_page()
    {
        factory(User::class)->create([
            'name' => 'Arturo'
        ]);

        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Usuarios')
            ->assertSee('Arturo');
    }

    /** @test  */
    function it_loads_the_users_list_is_empty()
    {
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados.');
    }

    /** @test  */
    function it_displays_the_users_details()
    {
        $user = factory(User::class)->create([
            'name' => 'Arturo'
        ]);

        $this->get('/usuario/'.$user->id)
            ->assertStatus(200)
            ->assertSee('Arturo');
    }

    /** @test */
    function it_displays_error_user_not_exists(){
        $this->get('/usuario/999')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');
    }

    /** @test  */
    function it_loads_the_users_create_page()
    {
        $this->get('/usuario/nuevo')
            ->assertStatus(200)
            ->assertSee('Creando nuevo usuario');
    }

    /** @test  */
    function it_loads_the_users_edit_page()
    {
        $this->get('/usuario/5/edit')
            ->assertStatus(200)
            ->assertSee('Edición Usuario: 5');
    }
    /** @test  */
    function it_loads_the_users_edit_page_without_numbers()
    {
        $this->get('/usuario/texto/edit')
            ->assertStatus(404);
    }
}

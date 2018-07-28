<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\Rule;

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
            ->assertSee('Crear usuario');
    }

    /** @test  */
    function it_creates_new_user()
    {
        $this->withoutExceptionHandling();

        $this->post('/usuario/crear', [
           'name' => 'Arturo',
           'email' => 'arturo@arturo.es',
           'password' => 'secret'
        ])->assertRedirect('usuarios');

        $this->assertCredentials([
            'name' => 'Arturo',
            'email' => 'arturo@arturo.es',
            'password' => 'secret'
        ]);
    }

    /** @test  */
    function name_is_required()
    {
        $this->from('usuario/nuevo')
            ->post('/usuario/crear', [
                'name' => '',
                'email' => 'arturo@arturo.es',
                'password' => 'secret'
            ])
            ->assertRedirect('usuario/nuevo')
            ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);

        $this->assertEquals(0, User::count());


    }

    /** @test  */
    function email_is_required()
    {
        $this->from('usuario/nuevo')
            ->post('/usuario/crear', [
                'name' => 'Arturo',
                'email' => '',
                'password' => 'secret'
            ])
            ->assertRedirect('usuario/nuevo')
            ->assertSessionHasErrors(['email' => 'El campo email es obligatorio']);

        $this->assertEquals(0, User::count());


    }

    /** @test  */
    function email_must_be_valid()
    {
        $this->from('usuario/nuevo')
            ->post('/usuario/crear', [
                'name' => 'Arturo',
                'email' => 'correo-no-valido',
                'password' => 'secret'
            ])
            ->assertRedirect('usuario/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());


    }

    /** @test  */
    function email_must_be_unique()
    {
        factory(User::class)->create([
           'email' => 'arturo@arturo.es'
        ]);

        $this->from('usuario/nuevo')
            ->post('/usuario/crear', [
                'name' => 'Arturo',
                'email' => 'arturo@arturo.es',
                'password' => 'secret'
            ])
            ->assertRedirect('usuario/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());


    }

    /** @test  */
    function password_is_required()
    {
        $this->from('usuario/nuevo')
            ->post('/usuario/crear', [
                'name' => 'Arturo',
                'email' => 'arturo@arturo.es',
                'password' => ''
            ])
            ->assertRedirect('usuario/nuevo')
            ->assertSessionHasErrors(['password' => 'El campo password es obligatorio']);

        $this->assertEquals(0, User::count());


    }


    /** @test  */
    function it_loads_the_users_edit_page()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->get("/usuario/{$user->id}/edit")
            ->assertStatus(200)
            ->assertSee("Editar Usuario")
            ->assertViewIs('users.edit')
            ->assertViewHas('user',function($viewUser) use ($user){
                return $viewUser->id === $user->id;
            });
    }

    /** @test  */
    function it_loads_the_users_edit_page_without_numbers()
    {
        $this->get('/usuario/texto/edit')
            ->assertStatus(404);
    }

    /** @test  */
    function it_update_user()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->put("/usuario/{$user->id}", [
            'name' => 'Arturo',
            'email' => 'arturo@arturo.es',
            'password' => 'secret'
        ])->assertRedirect("usuario/{$user->id}");

        $this->assertCredentials([
            'name' => 'Arturo',
            'email' => 'arturo@arturo.es',
            'password' => 'secret'
        ]);
    }

    /** @test  */
    function name_is_required_updating()
    {

        $user = factory(User::class)->create();

        $this->from("usuario/{$user->id}/edit")
            ->put("usuario/{$user->id}", [
                'name' => '',
                'email' => 'arturo@arturo.es',
                'password' => 'secret'
            ])
            ->assertRedirect("usuario/{$user->id}/edit")
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users', ['email' => 'arturo@arturo.es']);


    }

    /** @test  */
    function email_is_required_updating()
    {
        $user = factory(User::class)->create();

        $this->from("usuario/{$user->id}/edit")
            ->put("usuario/{$user->id}", [
                'name' => 'Arturo',
                'email' => '',
                'password' => 'secret'
            ])
            ->assertRedirect("usuario/{$user->id}/edit")
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', ['name' => 'Arturo']);


    }

    /** @test  */
    function email_must_be_valid_updating()
    {
        $user = factory(User::class)->create();

        $this->from("usuario/{$user->id}/edit")
            ->put("usuario/{$user->id}", [
                'name' => 'Arturo',
                'email' => 'correo-no-valido',
                'password' => 'secret'
            ])
            ->assertRedirect("usuario/{$user->id}/edit")
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', ['name' => 'Arturo']);


    }

    /** @test  */
    function email_must_be_unique_updating()
    {
//        self::marKTestIncomplete();
//        return;
        factory(User::class)->create([
            'email' => 'otro@email.es'
        ]);

        $user = factory(User::class)->create([
            'email' => 'arturo@arturo.es'
        ]);

        $this->from("usuario/{$user->id}/edit")
            ->put("usuario/{$user->id}", [
                'name' => 'Arturo',
                'email' => 'otro@email.es',
                'password' => 'secret'
            ])
            ->assertRedirect("usuario/{$user->id}/edit")
            ->assertSessionHasErrors(['email']);



    }

    /** @test  */
    function password_is_optional_updating()
    {
        $old_password = 'CLAVE_ANTERIOR';

        $user = factory(User::class)->create([
            'password' => bcrypt($old_password)
        ]);

        $this->from("usuario/{$user->id}/edit")
            ->put("usuario/{$user->id}", [
                'name' => 'Arturo',
                'email' => 'arturo@arturo.es',
                'password' => ''
            ])
            ->assertRedirect("usuario/{$user->id}"); //users.show

        $this->assertCredentials([
            'name' => 'Arturo',
            'email' => 'arturo@arturo.es',
            'password' => $old_password
            ]);


    }

    /** @test  */
    function email_can_stay_same_updating()
    {
        $user = factory(User::class)->create([
            'email' => 'arturo@arturo.es'
        ]);

        $this->from("usuario/{$user->id}/edit")
            ->put("usuario/{$user->id}", [
                'name' => 'Arturo',
                'email' => 'arturo@arturo.es',
                'password' => 'secret'
            ])
            ->assertRedirect("usuario/{$user->id}"); //users.show

        $this->assertDatabaseHas('users',[
            'name' => 'Arturo',
            'email' => 'arturo@arturo.es'
        ]);


    }

    /** @test */
    function it_delete_user()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->delete("usuario/{$user->id}")
            ->assertRedirect("usuarios");

        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);

    }

}

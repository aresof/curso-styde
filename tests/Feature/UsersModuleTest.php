<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    /** @test  */
    function it_loads_the_users_list_page()
    {
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Usuarios');
    }

    /** @test  */
    function it_loads_the_users_details_page()
    {
        $this->get('/usuario/5')
            ->assertStatus(200)
            ->assertSee('Usuario: 5');
    }

    /** @test  */
    function it_loads_the_users_edit_page()
    {
        $this->get('/usuario/5/edit')
            ->assertStatus(200)
            ->assertSee('Edición Usuario: 5');
    }
}

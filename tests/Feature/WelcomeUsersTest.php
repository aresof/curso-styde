<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    /** @test */
    function it_loads_full_parameters()
    {
        $this->get('/saludo/Arturo/Ares')
            ->assertStatus(200)
            ->assertSee('Bienvenido Arturo, tu apodo es Ares');
    }
    /** @test */
    function it_loads_half_parameters()
    {
        $this->get('/saludo/Arturo')
            ->assertStatus(200)
            ->assertSee('Bienvenido Arturo');
    }
}

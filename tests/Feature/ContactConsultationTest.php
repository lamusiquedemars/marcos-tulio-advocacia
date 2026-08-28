<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactConsultationTest extends TestCase
{
    use RefreshDatabase;

    public function test_consultation_link_displays_a_dedicated_request_form(): void
    {
        $this->get('/contact?tipo=consulta')
            ->assertOk()
            ->assertSee('Solicite uma consulta')
            ->assertSee('Modalidade preferida')
            ->assertSee('value="consulta"', false)
            ->assertSee('Consulta online');
    }

    public function test_unknown_contact_type_keeps_the_standard_contact_form(): void
    {
        $this->get('/contact?tipo=invalido')
            ->assertOk()
            ->assertSee('Envie uma mensagem')
            ->assertSee('value="outro"', false)
            ->assertDontSee('Modalidade preferida');
    }
}

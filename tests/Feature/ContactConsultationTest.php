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
            ->assertSee('Envie uma mensagem ou solicite uma consulta')
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
            ->assertSee('Modalidade preferida')
            ->assertDontSee('Sem preferência');
    }

    public function test_consultation_requires_a_chosen_modality(): void
    {
        $this->post('/contact', [
            'name' => 'Pessoa de teste',
            'email' => 'pessoa@example.test',
            'request_type' => 'consulta',
            'message' => 'Mensagem de teste sem dados sensíveis.',
            'consent' => '1',
        ])->assertSessionHasErrors('modality');
    }
}

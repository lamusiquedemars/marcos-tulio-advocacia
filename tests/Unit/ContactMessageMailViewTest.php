<?php

namespace Tests\Unit;

use App\Modules\ContactForm\Data\ContactMessage;
use Tests\TestCase;

class ContactMessageMailViewTest extends TestCase
{
    public function test_received_email_preserves_message_line_breaks_and_escapes_html(): void
    {
        $html = view('mail.contact-message-received', [
            'messageData' => $this->message(),
        ])->render();

        $this->assertStringContainsString('Primeiro parágrafo.<br', $html);
        $this->assertSame(3, substr_count($html, '<br />'));
        $this->assertStringContainsString('Segundo parágrafo.', $html);
        $this->assertStringContainsString('&lt;script&gt;alert(&quot;x&quot;)&lt;/script&gt;', $html);
        $this->assertStringNotContainsString('<script>', $html);
    }

    public function test_confirmation_email_preserves_message_line_breaks_and_escapes_html(): void
    {
        $html = view('mail.contact-message-confirmation', [
            'messageData' => $this->message(),
        ])->render();

        $this->assertStringContainsString('Primeiro parágrafo.<br', $html);
        $this->assertSame(3, substr_count($html, '<br />'));
        $this->assertStringContainsString('Segundo parágrafo.', $html);
        $this->assertStringContainsString('&lt;script&gt;alert(&quot;x&quot;)&lt;/script&gt;', $html);
        $this->assertStringNotContainsString('<script>', $html);
    }

    private function message(): ContactMessage
    {
        return new ContactMessage(
            name: 'Contato de teste',
            email: 'contato@example.test',
            phone: null,
            subject: 'Mensagem de teste',
            message: "Primeiro parágrafo.\n\nSegundo parágrafo.\n<script>alert(\"x\")</script>",
        );
    }
}

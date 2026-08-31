<p>Olá,</p>

<p>Recebemos sua mensagem enviada pelo site.</p>

<p><strong>Seu email:</strong> {{ $messageData->email }}</p>
@if ($messageData->name)
    <p><strong>Nome:</strong> {{ $messageData->name }}</p>
@endif
@if ($messageData->subject)
    <p><strong>Assunto:</strong> {{ $messageData->subject }}</p>
@endif
<p><strong>Mensagem:</strong></p>
<div style="line-height: 1.6; overflow-wrap: anywhere;">{!! nl2br(e($messageData->message)) !!}</div>

<p>Entraremos em contato em breve.</p>

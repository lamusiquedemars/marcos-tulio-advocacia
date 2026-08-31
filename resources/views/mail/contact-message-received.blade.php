<p>Uma nova mensagem foi recebida pelo site.</p>

<p><strong>Nome:</strong> {{ $messageData->name }}</p>
<p><strong>Email:</strong> {{ $messageData->email }}</p>
@if ($messageData->phone)
    <p><strong>Telefone:</strong> {{ $messageData->phone }}</p>
@endif
@if ($messageData->subject)
    <p><strong>Assunto:</strong> {{ $messageData->subject }}</p>
@endif
<p><strong>Mensagem:</strong></p>
<div style="line-height: 1.6; overflow-wrap: anywhere;">{!! nl2br(e($messageData->message)) !!}</div>

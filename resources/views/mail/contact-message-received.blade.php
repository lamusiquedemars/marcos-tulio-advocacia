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
<p>{{ $messageData->message }}</p>

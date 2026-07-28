<p>Uma pessoa solicitou contato pelo site.</p>

<p><strong>Referência:</strong> {{ $conversation->public_reference }}</p>
<p><strong>Nome:</strong> {{ $inquiry->name }}</p>
@if (filled($inquiry->email))
    <p><strong>Email:</strong> {{ $inquiry->email }}</p>
@endif
@if (filled($inquiry->phone))
    <p><strong>Telefone:</strong> {{ $inquiry->phone }}</p>
@endif
@if (filled($conversation->urgency?->label()))
    <p><strong>Urgência:</strong> {{ $conversation->urgency->label() }}</p>
@endif
@if (filled($conversation->summary))
    <p><strong>Resumo:</strong> {{ $conversation->summary }}</p>
@endif

<p><a href="{{ $adminUrl }}">Abrir a conversa na administração</a></p>

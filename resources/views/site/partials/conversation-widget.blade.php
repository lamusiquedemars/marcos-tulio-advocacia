@php($conversationSettings = \App\Modules\Conversations\Models\ConversationSetting::current())

<div
    class="conversation-widget"
    data-conversation-widget
    data-history-url="{{ route('conversations.public.show') }}"
    data-message-url="{{ route('conversations.public.store') }}"
    data-callback-url="{{ route('conversations.public.callback') }}"
>
    <button
        class="btn btn--primary conversation-widget__toggle"
        type="button"
        aria-expanded="false"
        aria-controls="conversation-panel"
        data-conversation-toggle
    >
        {{ $conversationSettings->widget_button_label }}
    </button>

    <aside
        class="conversation-widget__panel"
        id="conversation-panel"
        aria-label="Conversa com o assistente do escritório"
        hidden
        data-conversation-panel
    >
        <header class="conversation-widget__header">
            <div>
                <strong>{{ $conversationSettings->widget_title }}</strong>
                <small data-conversation-reference></small>
            </div>
            <button type="button" aria-label="Fechar conversa" data-conversation-close>×</button>
        </header>

        <details class="conversation-widget__notice">
            <summary>Aviso sobre este atendimento</summary>
            <p>{{ $conversationSettings->privacy_notice }}</p>
        </details>

        <div
            class="conversation-widget__messages"
            role="log"
            aria-live="polite"
            aria-relevant="additions"
            data-conversation-messages
        ></div>

        <p class="conversation-widget__status" role="status" data-conversation-status></p>

        <div class="conversation-widget__actions">
            <a class="btn btn--secondary" href="#" target="_blank" rel="nofollow noopener" hidden data-conversation-whatsapp>
                Continuar pelo WhatsApp
            </a>
            <button class="btn btn--secondary" type="button" hidden data-conversation-callback>
                Quero ser contatado
            </button>
        </div>

        <form class="conversation-widget__form" data-conversation-form>
            <label for="conversation-message">Sua mensagem</label>
            <textarea
                id="conversation-message"
                name="content"
                maxlength="5000"
                rows="2"
                required
                data-conversation-input
            ></textarea>
            <input name="website" type="text" tabindex="-1" autocomplete="off" class="conversation-widget__honeypot">
            <button class="btn btn--primary" type="submit">Enviar</button>
        </form>

        <div class="conversation-widget__completed" hidden data-conversation-completed>
            <strong>Solicitação registrada</strong>
            <p>O escritório entrará em contato pelo canal informado. Esta conversa foi encerrada e não recebe novas mensagens.</p>
        </div>
    </aside>
</div>

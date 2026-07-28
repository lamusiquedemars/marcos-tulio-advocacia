<div
    class="conversation-widget"
    data-conversation-widget
    data-history-url="{{ route('conversations.public.show') }}"
    data-message-url="{{ route('conversations.public.store') }}"
>
    <button
        class="btn btn--primary conversation-widget__toggle"
        type="button"
        aria-expanded="false"
        aria-controls="conversation-panel"
        data-conversation-toggle
    >
        {{ config('maracuja.conversations.public.button_label') }}
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
                <strong>{{ config('maracuja.conversations.public.title') }}</strong>
                <small data-conversation-reference></small>
            </div>
            <button type="button" aria-label="Fechar conversa" data-conversation-close>×</button>
        </header>

        <div class="conversation-widget__notice">
            {{ config('maracuja.conversations.public.notice') }}
        </div>

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
        </div>

        <form class="conversation-widget__form" data-conversation-form>
            <label for="conversation-message">Sua mensagem</label>
            <textarea
                id="conversation-message"
                name="content"
                maxlength="5000"
                rows="3"
                required
                data-conversation-input
            ></textarea>
            <input name="website" type="text" tabindex="-1" autocomplete="off" class="conversation-widget__honeypot">
            <button class="btn btn--primary" type="submit">Enviar</button>
        </form>
    </aside>
</div>

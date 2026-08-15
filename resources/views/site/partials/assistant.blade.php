<div
    class="assistant"
    data-assistant
    data-endpoint="{{ route('assistant.inquiry') }}"
    data-whatsapp="{{ config('maracuja.law_firm.whatsapp_url') }}"
>
    <button class="btn btn--secondary assistant__trigger" type="button" data-assistant-open>
        Explicar minha situação
    </button>

    <dialog class="assistant__dialog" data-assistant-dialog aria-labelledby="assistant-title">
        <div class="assistant__header">
            <div>
                <span class="media-tag">Atendimento inicial</span>
                <h2 id="assistant-title">Como podemos orientar o primeiro contato?</h2>
            </div>
            <button class="btn btn--ghost" type="button" data-assistant-close aria-label="Fechar assistente">Fechar</button>
        </div>

        <div class="assistant__safety">
            <strong>Este assistente não é advogado e não fornece aconselhamento jurídico.</strong>
            Não envie documentos, senhas, nomes de terceiros ou um relato completo.
            <a href="{{ config('maracuja.law_firm.whatsapp_url') }}" rel="nofollow">Em uma urgência, fale diretamente pelo WhatsApp.</a>
        </div>

        <form data-assistant-form novalidate>
            <input name="website" type="text" tabindex="-1" autocomplete="off" class="assistant__honeypot" aria-hidden="true">

            <fieldset data-assistant-step>
                <legend>O que você procura?</legend>
                <div class="assistant__choices">
                    <label><input type="radio" name="request_type" value="analise" required> Apresentar uma situação</label>
                    <label><input type="radio" name="request_type" value="consulta" required> Solicitar uma consulta</label>
                    <label><input type="radio" name="request_type" value="outro" required> Tirar uma dúvida sobre o atendimento</label>
                </div>
            </fieldset>

            <fieldset data-assistant-step hidden>
                <legend>Existe urgência ou prazo próximo?</legend>
                <div class="assistant__choices">
                    <label><input type="radio" name="urgency" value="urgente" required> É urgente</label>
                    <label><input type="radio" name="urgency" value="prazo_proximo" required> Existe prazo próximo</label>
                    <label><input type="radio" name="urgency" value="sem_urgencia" required> Sem urgência imediata</label>
                </div>
                <p class="assistant__urgent" data-assistant-urgent hidden>
                    Não espere pelo assistente:
                    <a class="btn btn--primary" href="{{ config('maracuja.law_firm.whatsapp_url') }}" rel="nofollow">Abrir WhatsApp</a>
                </p>
            </fieldset>

            <fieldset data-assistant-step hidden>
                <legend>Em qual fase geral a situação se encontra?</legend>
                <label class="field">
                    Fase
                    <select name="phase" required>
                        <option value="">Selecione</option>
                        <option value="nao_informada">Prefiro não informar</option>
                        <option value="investigacao">Investigação</option>
                        <option value="intimacao_depoimento">Intimação ou depoimento</option>
                        <option value="prisao">Prisão</option>
                        <option value="processo_penal">Processo penal</option>
                        <option value="recurso">Recurso ou habeas corpus</option>
                        <option value="preventiva">Orientação preventiva</option>
                    </select>
                </label>
                <label class="field">
                    Preferência de atendimento
                    <select name="modality">
                        <option value="indiferente">A definir</option>
                        <option value="presencial">Presencial</option>
                        <option value="remoto">Remoto</option>
                    </select>
                </label>
            </fieldset>

            <fieldset data-assistant-step hidden>
                <legend>Dados mínimos para o retorno</legend>
                <div class="assistant__contact-grid">
                    <label class="field">Nome <input name="name" maxlength="120" autocomplete="name" required></label>
                    <label class="field">Email <input name="email" type="email" maxlength="160" autocomplete="email" required></label>
                    <label class="field">Telefone, se desejar <input name="phone" maxlength="60" autocomplete="tel"></label>
                    <label class="field">Cidade e estado <input name="location" maxlength="120"></label>
                </div>
                <label class="field">
                    Resumo inicial
                    <textarea name="summary" rows="5" maxlength="1500" required></textarea>
                    <small>Até 1.500 caracteres. Não envie documentos ou detalhes desnecessários.</small>
                </label>
                <label class="assistant__consent">
                    <input name="consent" type="checkbox" value="1" required>
                    <span>Autorizo o uso destes dados para que o escritório responda à minha solicitação.</span>
                </label>
            </fieldset>

            <p class="assistant__status" data-assistant-status role="status" aria-live="polite"></p>

            <div class="assistant__actions">
                <button class="btn btn--secondary" type="button" data-assistant-back hidden>Voltar</button>
                <button class="btn btn--primary" type="button" data-assistant-next>Continuar</button>
                <button class="btn btn--primary" type="submit" data-assistant-submit hidden>Registrar solicitação</button>
            </div>
        </form>
    </dialog>

    <noscript>
        <a class="btn btn--secondary" href="{{ route('contact', ['tipo' => 'analise']) }}">Apresentar minha situação</a>
    </noscript>
</div>

@extends('layouts.site', [
    'seoTitle' => $page?->seo_title ?? ('Atendimento — ' . $settings->site_name),
    'seoDescription' => $page?->seo_description ?? ('Formas de atendimento de ' . $settings->site_name),
    'seoImage' => $page?->heroImageUrl(),
])

@section('content')
    <x-site.hero
        eyebrow="Atendimento presencial ou remoto"
        :title="$page?->hero_title ?? $page?->title ?? 'Atendimento e Contato'"
        :subtitle="$page?->hero_subtitle ?? $page?->excerpt ?? 'Escolha o caminho adequado para o primeiro contato.'"
        :image="$page?->heroImageUrl()"
    />

    <x-site.section
        title="Escolha como começar"
        intro="Uma urgência penal não depende do formulário. Para explicar uma situação, envie somente os dados iniciais necessários."
        heading-variant="accent"
    >
        <div class="contact-intro">
            <article class="pathway-card pathway-card--urgent">
                <span class="pathway-card__label">Urgência penal</span>
                <h2>Contato direto por WhatsApp</h2>
                <p>Use este caminho para prisão, diligência em andamento, intimação próxima ou outro prazo imediato.</p>
                <x-site.button :href="config('maracuja.law_firm.whatsapp_url')">Abrir WhatsApp</x-site.button>
                <small class="form-help">Link fictício nesta demonstração. Nenhuma mensagem real será enviada.</small>
            </article>

            <article class="pathway-card pathway-card--analysis">
                <span class="pathway-card__label">Análise ou consulta</span>
                <h2>Apresente um resumo inicial</h2>
                <p>O formulário organiza o primeiro contato. Não envie documentos, senhas, provas ou o relato completo do caso.</p>
                <a href="#formulario" class="btn btn--secondary">Ir para o formulário</a>
            </article>
        </div>

        <div class="confidentiality-note">
            <strong>Ambiente de demonstração:</strong> use apenas dados fictícios. O preenchimento não cria relação advogado-cliente, não substitui orientação jurídica e não envia email real.
        </div>
    </x-site.section>

    <x-site.section
        id="formulario"
        variant="muted"
        title="Apresentação inicial"
        intro="Campos reduzidos para organizar a solicitação sem recolher o conteúdo completo de um caso."
        heading-variant="underline"
    >
        @if (($appointmentSettings ?? null)?->canBookDirectly())
            <div class="confidentiality-note">
                <strong>Agendamento direto disponível.</strong>
                A reserva será concluída na página Brevo Meetings, sem envio do resumo desta solicitação.
                <a class="btn btn--secondary" href="{{ route('appointments.booking') }}">
                    Ver horários disponíveis
                </a>
            </div>
        @elseif (($appointmentSettings ?? null)?->is_enabled)
            <div class="confidentiality-note">
                <strong>Agendamento após análise.</strong>
                Depois de examinar a solicitação inicial, o escritório poderá encaminhar o acesso à página de reserva.
            </div>
        @endif

        @if (session('status'))
            <p class="notice" role="status">{{ session('status') }}</p>
        @endif

        <form method="post" action="{{ route('contact.store') }}" class="contact-form" data-form>
            @csrf
            <input type="text" name="website" value="" autocomplete="off" tabindex="-1" aria-hidden="true" style="position:absolute; left:-9999px; top:auto; width:1px; height:1px; overflow:hidden;">

            <label>
                Tipo de solicitação
                <select name="request_type" required>
                    <option value="">Selecione</option>
                    <option value="analise" @selected(old('request_type', request('tipo')) === 'analise')>Apresentar uma situação</option>
                    <option value="consulta" @selected(old('request_type', request('tipo')) === 'consulta')>Solicitar uma consulta</option>
                    <option value="outro" @selected(old('request_type', request('tipo')) === 'outro')>Outro contato</option>
                </select>
                @error('request_type') <small class="field__error">{{ $message }}</small> @enderror
            </label>

            <label>
                Grau de urgência
                <select name="urgency">
                    <option value="sem_urgencia" @selected(old('urgency') === 'sem_urgencia')>Sem urgência imediata</option>
                    <option value="prazo_proximo" @selected(old('urgency') === 'prazo_proximo')>Existe um prazo próximo</option>
                    <option value="urgente" @selected(old('urgency') === 'urgente')>Urgente — já vi o contato direto</option>
                </select>
            </label>

            <label>
                Fase geral da situação
                <select name="phase">
                    <option value="nao_informada" @selected(old('phase') === 'nao_informada')>Prefiro não informar</option>
                    <option value="investigacao" @selected(old('phase') === 'investigacao')>Investigação</option>
                    <option value="intimacao_depoimento" @selected(old('phase') === 'intimacao_depoimento')>Intimação ou depoimento</option>
                    <option value="prisao" @selected(old('phase') === 'prisao')>Prisão</option>
                    <option value="processo_penal" @selected(old('phase') === 'processo_penal')>Processo penal</option>
                    <option value="recurso" @selected(old('phase') === 'recurso')>Recurso ou habeas corpus</option>
                    <option value="preventiva" @selected(old('phase') === 'preventiva')>Orientação preventiva</option>
                </select>
                @error('phase') <small class="field__error">{{ $message }}</small> @enderror
            </label>

            @if ($settings->contact_form_show_name)
                <label>
                    Nome
                    <input name="name" value="{{ old('name') }}" autocomplete="name" required>
                    @error('name') <small class="field__error">{{ $message }}</small> @enderror
                </label>
            @endif

            <label>
                Email
                <input name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>
                @error('email') <small class="field__error">{{ $message }}</small> @enderror
            </label>

            @if ($settings->contact_form_show_phone)
                <label>
                    Telefone
                    <input name="phone" value="{{ old('phone') }}" autocomplete="tel">
                </label>
            @endif

            <label>
                Cidade e estado
                <input name="location" value="{{ old('location') }}" placeholder="Ex.: Cuiabá, MT">
            </label>

            <label>
                Data importante, se houver
                <input name="deadline" type="date" value="{{ old('deadline') }}">
            </label>

            <label>
                Preferência de atendimento
                <select name="modality">
                    <option value="indiferente" @selected(old('modality') === 'indiferente')>A definir</option>
                    <option value="presencial" @selected(old('modality') === 'presencial')>Presencial em Cuiabá</option>
                    <option value="remoto" @selected(old('modality') === 'remoto')>Atendimento remoto</option>
                </select>
            </label>

            <label class="full">
                Resumo inicial
                <textarea name="message" rows="7" maxlength="5000" required>{{ old('message') }}</textarea>
                <small class="form-help">Não inclua documentos, senhas, dados de terceiros ou detalhes desnecessários.</small>
                @error('message') <small class="field__error">{{ $message }}</small> @enderror
            </label>

            <label class="full consent-field">
                <input name="consent" type="checkbox" value="1" @checked(old('consent')) required>
                <span>
                    Confirmo que estou usando dados fictícios nesta demonstração e autorizo o registro desta solicitação de teste.
                    @error('consent') <small class="field__error">{{ $message }}</small> @enderror
                </span>
            </label>

            <div class="full">
                <x-site.button type="submit">Registrar solicitação de demonstração</x-site.button>
            </div>
        </form>
    </x-site.section>
@endsection

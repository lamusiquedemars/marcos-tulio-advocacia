@extends('layouts.site', [
    'seoTitle' => $page?->seo_title ?? ('Atendimento — ' . $settings->site_name),
    'seoDescription' => $page?->seo_description ?? ('Formas de atendimento de ' . $settings->site_name),
    'seoImage' => $page?->heroImageUrl(),
])

@section('content')
    @php
        $isConsultationRequest = ($requestType ?? 'outro') === 'consulta';
        $isAnalysisRequest = ($requestType ?? 'outro') === 'analise';
    @endphp

    <x-site.hero
        :eyebrow="$isConsultationRequest ? 'Solicitação de consulta' : 'Atendimento presencial ou remoto'"
        :title="$isConsultationRequest ? 'Solicite uma consulta' : ($isAnalysisRequest ? 'Apresente sua situação' : ($page?->hero_title ?? $page?->title ?? 'Fale com o escritório'))"
        :subtitle="$isConsultationRequest ? 'Informe o essencial. Após a análise inicial, o escritório enviará um convite privado para você escolher o horário.' : ($page?->hero_subtitle ?? $page?->excerpt ?? 'Conte brevemente como podemos ajudar. A equipe avaliará o encaminhamento adequado.')"
        :image="$page?->heroImageUrl()"
    />

    <x-site.section
        id="formulario"
        :title="$isConsultationRequest ? 'Pedido de consulta' : 'Envie uma mensagem'"
        :intro="$isConsultationRequest ? 'Indique a modalidade desejada e descreva apenas o essencial. Não envie documentos ou informações muito sensíveis.' : 'Não é necessário relatar todos os detalhes nem enviar documentos neste primeiro contato.'"
        heading-variant="accent"
    >
        <div class="contact-simple">
            <div>
                @if (session('status'))
                    <p class="notice" role="status">{{ session('status') }}</p>
                @endif

                <form method="post" action="{{ route('contact.store') }}" class="contact-form contact-form--legal" data-form data-acquisition-form>
                    @csrf
                    <input type="hidden" name="acquisition_attribution" value="{{ old('acquisition_attribution') }}">
                    <input type="hidden" name="request_type" value="{{ $requestType ?? 'outro' }}">
                    <input type="text" name="website" value="" autocomplete="off" tabindex="-1" aria-hidden="true" style="position:absolute; left:-9999px; top:auto; width:1px; height:1px; overflow:hidden;">

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
                        <label class="full">
                            Telefone <small class="form-help">Opcional</small>
                            <input name="phone" value="{{ old('phone') }}" autocomplete="tel">
                        </label>
                    @endif

                    @if ($isConsultationRequest)
                        <fieldset class="full">
                            <legend>Modalidade preferida</legend>
                            <label><input type="radio" name="modality" value="remoto" @checked(old('modality') === 'remoto') required> Consulta online</label>
                            <label><input type="radio" name="modality" value="presencial" @checked(old('modality') === 'presencial') required> Consulta presencial</label>
                            <label><input type="radio" name="modality" value="indiferente" @checked(old('modality') === 'indiferente') required> Sem preferência</label>
                            @error('modality') <small class="field__error">{{ $message }}</small> @enderror
                        </fieldset>
                    @endif

                    <label class="full">
                        {{ $isConsultationRequest ? 'O que você precisa tratar na consulta?' : 'Como podemos ajudar?' }}
                        <textarea name="message" rows="6" maxlength="5000" required>{{ old('message') }}</textarea>
                        <small class="form-help">Escreva apenas o essencial. Não envie documentos ou informações muito sensíveis.</small>
                        @error('message') <small class="field__error">{{ $message }}</small> @enderror
                    </label>

                    <label class="full consent-field">
                        <input name="consent" type="checkbox" value="1" @checked(old('consent')) required>
                        <span>
                            Autorizo o uso destes dados para que o escritório responda à minha solicitação.
                            @error('consent') <small class="field__error">{{ $message }}</small> @enderror
                        </span>
                    </label>

                    <div class="full">
                        <x-site.button type="submit">{{ $isConsultationRequest ? 'Solicitar consulta' : 'Enviar mensagem' }}</x-site.button>
                    </div>
                </form>
            </div>

            <aside class="contact-direct">
                <span class="pathway-card__label">Contato direto</span>
                <h2>Prefere conversar pelo WhatsApp?</h2>
                <p>Para uma conversa direta com o escritório, continue pelo WhatsApp.</p>
                <x-site.button :href="$settings->whatsappUrl()">Abrir WhatsApp</x-site.button>

                @if (($appointmentSettings ?? null)?->canBookDirectly())
                    <div class="contact-direct__secondary">
                        <h3>Agendamento</h3>
                        <p>Consulte os horários disponíveis para atendimento.</p>
                        <a href="{{ route('appointments.booking') }}">Ver horários</a>
                    </div>
                @endif

                <small>Em caso de prisão, audiência ou prazo imediato, informe isso logo no início da conversa.</small>
            </aside>
        </div>
    </x-site.section>

    <x-site.section
        variant="muted"
        title="Onde nos encontrar"
        intro="Entre em contato pelo canal de sua preferência. O atendimento presencial é realizado mediante agendamento."
        heading-variant="underline"
    >
        <div class="contact-details-grid">
            @if ($settings->phone)
                <article class="contact-detail-card">
                    <x-site.contact-icon name="phone" />
                    <div><span>Telefone</span><a href="tel:{{ preg_replace('/[^\d+]/', '', $settings->phone) }}">{{ $settings->phone }}</a></div>
                </article>
            @endif
            @if ($settings->contact_email)
                <article class="contact-detail-card">
                    <x-site.contact-icon name="mail" />
                    <div><span>Email</span><a href="mailto:{{ $settings->contact_email }}">{{ $settings->contact_email }}</a></div>
                </article>
            @endif
            <article class="contact-detail-card">
                <x-site.contact-icon name="map-pin" />
                <div><span>Endereço</span><p>{{ $settings->address ?: 'Endereço completo em Cuiabá, MT' }}</p></div>
            </article>
            <article class="contact-detail-card">
                <x-site.contact-icon name="clock" />
                <div><span>Horários de atendimento</span><p>{{ \App\Support\ContentSlots::value('contact.office_hours', 'Segunda a sexta, mediante agendamento.') }}</p></div>
            </article>
        </div>
    </x-site.section>
@endsection

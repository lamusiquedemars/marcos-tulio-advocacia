@extends('layouts.site', [
    'seoTitle' => $page?->seo_title ?? ('Atendimento — ' . $settings->site_name),
    'seoDescription' => $page?->seo_description ?? ('Formas de atendimento de ' . $settings->site_name),
    'seoImage' => $page?->heroImageUrl(),
])

@section('content')
    @php
        $isConsultationRequest = ($requestType ?? 'outro') === 'consulta';
    @endphp

    <x-site.hero
        eyebrow="Atendimento presencial ou remoto"
        :title="$page?->hero_title ?? $page?->title ?? 'Fale com o escritório'"
        :subtitle="$page?->hero_subtitle ?? $page?->excerpt ?? 'Conte brevemente como podemos ajudar. A equipe avaliará o encaminhamento adequado.'"
        :image="$page?->heroImageUrl()"
    />

    <x-site.section
        id="formulario"
        title="Envie uma mensagem ou solicite uma consulta"
        intro="Você escolhe o melhor primeiro passo. Não é necessário relatar todos os detalhes nem enviar documentos neste primeiro contato."
        heading-variant="accent"
    >
        <div class="contact-simple">
            <div>
                @if (session('status'))
                    <p class="notice" role="status">{{ session('status') }}</p>
                @endif

                <form method="post" action="{{ route('contact.store') }}" class="contact-form contact-form--legal" data-form data-acquisition-form data-contact-consultation>
                    @csrf
                    <input type="hidden" name="acquisition_attribution" value="{{ old('acquisition_attribution') }}">
                    <input type="text" name="website" value="" autocomplete="off" tabindex="-1" aria-hidden="true" style="position:absolute; left:-9999px; top:auto; width:1px; height:1px; overflow:hidden;">

                    <fieldset class="full contact-intent">
                        <legend>Como prefere continuar?</legend>
                        <div class="contact-inline-options">
                            <label><input type="radio" name="request_type" value="outro" @checked(old('request_type', $requestType ?? 'outro') !== 'consulta')> Enviar uma mensagem</label>
                            <label><input type="radio" name="request_type" value="consulta" @checked(old('request_type', $requestType ?? 'outro') === 'consulta')> Solicitar uma consulta</label>
                        </div>
                    </fieldset>

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

                    <section class="full contact-consultation" data-contact-consultation-panel @if (! $isConsultationRequest && old('request_type') !== 'consulta') hidden @endif>
                        <p>Após a análise inicial, o escritório enviará um convite privado para você escolher o horário.</p>
                        <fieldset>
                            <legend>Modalidade preferida</legend>
                            <div class="contact-inline-options">
                                <label><input type="radio" name="modality" value="remoto" @checked(old('modality') === 'remoto')> Consulta online</label>
                                <label><input type="radio" name="modality" value="presencial" @checked(old('modality') === 'presencial')> Consulta presencial</label>
                            </div>
                            @error('modality') <small class="field__error">{{ $message }}</small> @enderror
                        </fieldset>
                    </section>

                    <label class="full">
                        Como podemos ajudar?
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
                        <x-site.button type="submit">Enviar solicitação</x-site.button>
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

@extends('layouts.site', [
    'seoTitle' => 'Agendamento de demonstração',
    'seoDescription' => 'Demonstração fictícia do futuro percurso de agendamento.',
])

@section('content')
    <x-site.hero
        variant="page"
        eyebrow="Atendimento"
        title="Agendamento"
        subtitle="Etapa de demonstração, sem conexão com uma agenda ou conta Brevo real."
    />

    <x-site.breadcrumb :items="[['label' => 'Agendamento']]" />

    <x-site.section
        title="Reserva fictícia"
        intro="O formulário Brevo Meetings será incorporado aqui somente após a validação completa do percurso em português brasileiro."
        heading-variant="accent"
    >
        <div class="confidentiality-note">
            <strong>Nenhum agendamento real será realizado.</strong>
            Esta página confirma que o visitante permanecerá dentro do site, sem login Brevo e sem mudança de aba.
        </div>

        <div class="cluster">
            <x-site.button :href="route('contact', ['tipo' => 'consulta'])">Voltar ao atendimento</x-site.button>
            <x-site.button :href="config('maracuja.law_firm.whatsapp_url')" variant="secondary">Urgência pelo WhatsApp</x-site.button>
        </div>
    </x-site.section>
@endsection

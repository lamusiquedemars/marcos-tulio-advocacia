@extends('layouts.site', [
    'seoTitle' => 'Agendamento',
    'seoDescription' => 'Agendamento de atendimento com Marcos Túlio Advocacia.',
])

@section('content')
    <x-site.hero
        variant="page"
        eyebrow="Atendimento"
        title="Agendamento"
        subtitle="Consulte as informações para solicitar seu atendimento."
    />

    <x-site.breadcrumb :items="[['label' => 'Agendamento']]" />

    <x-site.section
        title="Solicitar atendimento"
        intro="O escritório confirmará a disponibilidade e as informações necessárias para o atendimento."
        heading-variant="accent"
    >
        <div class="confidentiality-note">
            <strong>O agendamento depende de confirmação.</strong>
            O envio de uma solicitação não confirma automaticamente a data ou o horário do atendimento.
        </div>

        <div class="cluster">
            <x-site.button :href="route('contact', ['tipo' => 'consulta'])">Voltar ao atendimento</x-site.button>
            <x-site.button :href="config('maracuja.law_firm.whatsapp_url')" variant="secondary">Urgência pelo WhatsApp</x-site.button>
        </div>
    </x-site.section>
@endsection

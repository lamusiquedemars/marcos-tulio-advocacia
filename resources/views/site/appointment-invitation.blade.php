@extends('layouts.site', [
    'seoTitle' => 'Agendamento de consulta',
    'seoDescription' => 'Escolha um horário para sua consulta com Marcos Túlio Advocacia.',
])

@section('content')
    <x-site.hero
        variant="page"
        eyebrow="Atendimento"
        title="Agendamento de consulta"
        subtitle="Escolha o melhor horário disponível. A reserva permanece sujeita à confirmação do escritório."
    />

    <x-site.section heading-variant="accent">
        <div class="appointment-booking" data-acquisition-component="appointment-booking">
            <iframe
                src="{{ $invitation->booking_url }}"
                title="{{ $invitation->type->label() }}"
                loading="lazy"
                referrerpolicy="strict-origin-when-cross-origin"
            ></iframe>
        </div>
    </x-site.section>
@endsection

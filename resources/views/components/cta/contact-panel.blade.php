{{-- Clinic contact block: booking, call, WhatsApp and email actions from resources/data/site.json. --}}
@props([
    'heading' => 'Book an appointment or contact the clinic',
    'text' => null,
])
@inject('site', 'App\Support\SiteConfig')

@php $text ??= 'Call or send a WhatsApp message to ask about appointment times at the ' . $site->branchCities() . ' clinics.'; @endphp

<section {{ $attributes->class('relative overflow-hidden rounded-3xl p-8 md:p-10 text-white') }} style="background: var(--gradient-hero);">
    <div class="absolute inset-0 bg-grid pointer-events-none" aria-hidden="true"></div>
    <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
        <div class="max-w-xl">
            <h2 class="text-2xl md:text-3xl font-extrabold">{{ $heading }}</h2>
            <p class="mt-3 text-white/75 leading-relaxed">{{ $text }}</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <x-cta.book-appointment variant="light" />
            <x-cta.call-clinic variant="glass" :show-number="true" />
            <x-cta.whatsapp-clinic />
            <x-cta.email-clinic variant="glass" />
        </div>
    </div>
</section>

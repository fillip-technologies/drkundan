@extends('layouts.app')

@section('title', '| ' . $entry['seoTitle'])
@section('meta_description', $entry['seoDescription'])

@php
    $label = fn (string $section) => $catalog->sectionLabel($entry, $section);
    $related = $catalog->related($entry);
    $preparation = $catalog->preparation($entry);
    $preparationLinks = $catalog->preparationLinks($entry);
    $doctors = array_values(array_filter(array_map(fn ($id) => $site->doctor($id), $entry['doctorIds'])));
    $categoryUrl = route('services.index') . '#' . $category['id'];
    $card = 'rounded-3xl bg-white border border-slate-100 p-6 sm:p-8 scroll-mt-28';
    $h2 = 'text-xl sm:text-2xl font-extrabold';

    $breadcrumbs = [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Services', 'url' => route('services.index')],
        ['name' => $category['label'], 'url' => $categoryUrl],
        ['name' => $entry['heading'], 'url' => url()->current()],
    ];
@endphp

@push('head')
    <script type="application/ld+json">{!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => array_map(fn ($crumb, $i) => ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $crumb['name'], 'item' => $crumb['url']], $breadcrumbs, array_keys($breadcrumbs)),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
    @if ($entry['faqs'])
        <script type="application/ld+json">{!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => array_map(fn ($faq) => ['@type' => 'Question', 'name' => $faq['question'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']]], $entry['faqs']),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
    @endif
@endpush

@section('content')

    {{-- Hero --}}
    <section class="relative overflow-hidden pt-36 pb-16 px-6" style="background: var(--gradient-hero);">
        @if ($entry['image'])
            <img src="{{ asset($entry['image']) }}" alt="" class="absolute inset-0 w-full h-full object-cover opacity-[0.12] mix-blend-luminosity">
        @endif
        <div class="absolute inset-0 bg-grid pointer-events-none" aria-hidden="true"></div>

        <div class="relative max-w-6xl mx-auto">
            <nav aria-label="Breadcrumb">
                <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 text-sm text-white/65">
                    @foreach ($breadcrumbs as $i => $crumb)
                        <li class="flex items-center gap-2">
                            @if ($loop->last)
                                <span aria-current="page" class="font-semibold" style="color: var(--color-secondary);">{{ $crumb['name'] }}</span>
                            @else
                                <a href="{{ $crumb['url'] }}" class="hover:text-white transition-colors">{{ $crumb['name'] }}</a>
                                <i class="fa-solid fa-chevron-right text-[9px] opacity-60" aria-hidden="true"></i>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>

            <div class="mt-6 flex items-center gap-3">
                <span class="w-12 h-12 rounded-xl flex items-center justify-center text-white text-lg shadow-lg shadow-brand-600/30"
                    style="background: var(--gradient-brand);">
                    <i class="{{ $entry['icon'] }}" aria-hidden="true"></i>
                </span>
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-white/10 border border-white/15"
                    style="color: var(--color-secondary);">{{ $category['label'] }}</span>
            </div>

            <h1 class="mt-5 text-4xl sm:text-5xl font-extrabold text-white leading-tight max-w-3xl">{{ $entry['heading'] }}</h1>
            <p class="mt-4 text-lg text-white/75 max-w-2xl leading-relaxed">{{ $entry['shortDescription'] }}</p>

            <div class="flex flex-wrap gap-3 mt-8">
                <x-cta.book-appointment variant="light" size="lg" />
                <x-cta.call-clinic variant="glass" size="lg" />
                <x-cta.whatsapp-clinic size="lg" />
            </div>
        </div>
    </section>

    <div class="px-6 py-12 sm:py-14" style="background: var(--color-light);">
        <div class="max-w-6xl mx-auto grid lg:grid-cols-3 gap-8">

            {{-- Main content --}}
            <div class="lg:col-span-2 space-y-6 min-w-0">

                @if ($entry['urgentNotice'])
                    <x-emergency-notice :text="$entry['urgentNotice']" title="When to get emergency help" />
                @endif

                {{-- A. Introduction --}}
                <section id="overview" aria-labelledby="overview-heading" class="{{ $card }}">
                    <h2 id="overview-heading" class="{{ $h2 }}" style="color: var(--color-dark);">{{ $label('introduction') }}</h2>
                    <div class="mt-4 space-y-4 text-slate-600 leading-relaxed">
                        @foreach ($entry['introduction'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                    @if ($entry['availabilityNote'])
                        <p class="mt-5 flex items-start gap-3 rounded-2xl p-4 text-sm text-slate-700" style="background: var(--color-soft);">
                            <i class="fa-solid fa-circle-info mt-0.5 text-brand-600" aria-hidden="true"></i>
                            {{ $entry['availabilityNote'] }}
                        </p>
                    @endif
                </section>

                {{-- B. Symptoms or reasons to seek assessment --}}
                @if ($entry['symptomsOrReasons'])
                    <section id="symptoms" aria-labelledby="symptoms-heading" class="{{ $card }}">
                        <h2 id="symptoms-heading" class="{{ $h2 }}" style="color: var(--color-dark);">{{ $label('symptomsOrReasons') }}</h2>
                        <ul class="mt-5 grid sm:grid-cols-2 gap-3">
                            @foreach ($entry['symptomsOrReasons'] as $item)
                                <li class="flex items-start gap-3 rounded-2xl p-4 text-sm text-slate-700" style="background: var(--color-light);">
                                    <i class="fa-solid fa-circle-check mt-0.5 text-brand-600" aria-hidden="true"></i>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                        <p class="mt-5 text-sm text-slate-500">Having one or more of these does not by itself mean you have a particular condition. A doctor's assessment is needed to find the cause.</p>
                    </section>
                @endif

                {{-- C. What the service involves --}}
                @if ($entry['whatToExpect'])
                    <section id="what-to-expect" aria-labelledby="what-to-expect-heading" class="{{ $card }}">
                        <h2 id="what-to-expect-heading" class="{{ $h2 }}" style="color: var(--color-dark);">{{ $label('whatToExpect') }}</h2>
                        <ol class="mt-5 space-y-4">
                            @foreach ($entry['whatToExpect'] as $step)
                                <li class="flex items-start gap-4">
                                    <span class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 text-white text-sm font-bold"
                                        style="background: var(--gradient-brand);" aria-hidden="true">{{ $loop->iteration }}</span>
                                    <span class="pt-1 text-slate-600 leading-relaxed">{{ $step }}</span>
                                </li>
                            @endforeach
                        </ol>
                    </section>
                @endif

                {{-- D. Who should consider this service --}}
                @if ($entry['whoMayBenefit'])
                    <section id="who" aria-labelledby="who-heading" class="{{ $card }}">
                        <h2 id="who-heading" class="{{ $h2 }}" style="color: var(--color-dark);">{{ $label('whoMayBenefit') }}</h2>
                        <ul class="mt-5 space-y-3">
                            @foreach ($entry['whoMayBenefit'] as $item)
                                <li class="flex items-start gap-3 text-slate-600">
                                    <i class="fa-solid fa-user mt-1 text-xs text-brand-500" aria-hidden="true"></i>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endif

                {{-- Resource page sections --}}
                @foreach ($entry['sections'] as $i => $section)
                    <section aria-labelledby="section-{{ $i }}-heading"
                        @class([$card, '!bg-rose-50 !border-rose-200' => $section['style'] === 'alert'])>
                        <h2 id="section-{{ $i }}-heading" @class([$h2, 'text-rose-700' => $section['style'] === 'alert'])
                            @if ($section['style'] !== 'alert') style="color: var(--color-dark);" @endif>{{ $section['heading'] }}</h2>
                        @if ($section['intro'])
                            <p class="mt-3 text-slate-600">{{ $section['intro'] }}</p>
                        @endif

                        @if ($section['style'] === 'branches')
                            @include('services.partials.branches')
                        @elseif ($section['style'] === 'steps')
                            <ol class="mt-5 space-y-4">
                                @foreach ($section['items'] as $item)
                                    <li class="flex items-start gap-4">
                                        <span class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 text-white text-sm font-bold"
                                            style="background: var(--gradient-brand);" aria-hidden="true">{{ $loop->iteration }}</span>
                                        <span class="pt-1 text-slate-600 leading-relaxed">@include('services.partials.item-text', ['item' => $item])</span>
                                    </li>
                                @endforeach
                            </ol>
                        @elseif ($section['style'] === 'links')
                            <ul class="mt-5 grid sm:grid-cols-2 gap-3">
                                @foreach ($section['items'] as $item)
                                    @php $target = $item['serviceId'] ? $catalog->find($item['serviceId']) : null; @endphp
                                    <li>
                                        @if ($target && $catalog->url($target))
                                            <a href="{{ $catalog->url($target) }}"
                                                class="group flex items-center gap-3 h-full rounded-2xl p-4 border border-slate-100 transition hover:border-brand-200 hover:bg-brand-50"
                                                style="background: var(--color-light);">
                                                <span class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0 bg-white text-brand-600 shadow-sm">
                                                    <i class="{{ $target['icon'] }}" aria-hidden="true"></i>
                                                </span>
                                                <span class="min-w-0 flex-1">
                                                    <span class="block text-sm font-semibold" style="color: var(--color-dark);">{{ $item['text'] }}</span>
                                                    <span class="block text-xs text-brand-600 mt-0.5">{{ $target['title'] }}</span>
                                                </span>
                                                <i class="fa-solid fa-arrow-right text-xs text-brand-500 transition-transform group-hover:translate-x-1" aria-hidden="true"></i>
                                            </a>
                                        @else
                                            <span class="flex items-center gap-3 h-full rounded-2xl p-4 text-sm text-slate-700" style="background: var(--color-light);">{{ $item['text'] }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <ul @class(['mt-5', 'grid sm:grid-cols-2 gap-3' => $section['style'] === 'checklist', 'space-y-3' => $section['style'] !== 'checklist'])>
                                @foreach ($section['items'] as $item)
                                    <li @class([
                                        'flex items-start gap-3',
                                        'rounded-2xl p-4 text-sm text-slate-700 bg-[var(--color-light)]' => $section['style'] === 'checklist',
                                        'text-slate-700' => $section['style'] === 'alert',
                                        'text-slate-600' => $section['style'] === 'list',
                                    ])>
                                        <i @class([
                                            'mt-0.5',
                                            'fa-solid fa-square-check text-brand-600' => $section['style'] === 'checklist',
                                            'fa-solid fa-triangle-exclamation text-rose-600' => $section['style'] === 'alert',
                                            'fa-solid fa-circle text-[6px] mt-2.5 text-brand-500' => $section['style'] === 'list',
                                        ]) aria-hidden="true"></i>
                                        <span>@include('services.partials.item-text', ['item' => $item])</span>
                                    </li>
                                @endforeach
                            </ul>
                            @if ($section['style'] === 'alert' && $site->emergencyTelUrl())
                                <a href="{{ $site->emergencyTelUrl() }}" class="{{ \App\Support\CtaStyle::classes('emergency', 'sm') }} mt-5">
                                    <i class="fa-solid fa-phone text-xs" aria-hidden="true"></i> Call {{ $site->emergencyNumber() }}
                                </a>
                            @endif
                        @endif
                    </section>
                @endforeach

                {{-- Doctor --}}
                @foreach ($doctors as $doctor)
                    <section aria-labelledby="doctor-{{ $doctor['id'] }}-heading" class="{{ $card }}">
                        <h2 id="doctor-{{ $doctor['id'] }}-heading" class="{{ $h2 }}" style="color: var(--color-dark);">Your doctor</h2>
                        <div class="mt-5 flex flex-col sm:flex-row sm:items-center gap-5">
                            @if (! empty($doctor['image']))
                                <img src="{{ asset($doctor['image']) }}" alt="{{ $doctor['name'] }}" loading="lazy"
                                    class="w-24 h-24 rounded-2xl object-cover object-top shrink-0">
                            @endif
                            <div class="min-w-0">
                                <p class="text-lg font-bold" style="color: var(--color-dark);">{{ $doctor['name'] }}</p>
                                @if (! empty($doctor['role']))
                                    <p class="text-sm text-brand-600 font-semibold">{{ $doctor['role'] }}</p>
                                @endif
                                @if (! empty($doctor['qualifications']))
                                    <ul class="mt-3 flex flex-wrap gap-2" aria-label="Qualifications">
                                        @foreach ($doctor['qualifications'] as $qualification)
                                            <li class="px-2.5 py-1 rounded-lg text-xs font-semibold text-brand-700 bg-brand-50">{{ $qualification }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <div class="mt-4 flex flex-wrap gap-x-5 gap-y-2 text-sm font-bold">
                                    @if (! empty($doctor['profileUrl']))
                                        <a href="{{ url($doctor['profileUrl']) }}" class="inline-flex items-center gap-1.5 text-brand-600 hover:text-brand-700">
                                            View profile <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                    @if (! empty($doctor['opdUrl']))
                                        <a href="{{ url($doctor['opdUrl']) }}" class="inline-flex items-center gap-1.5 text-brand-600 hover:text-brand-700">
                                            OPD schedule <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section>
                @endforeach

                {{-- E. How to prepare --}}
                @if ($preparation)
                    <section id="preparation" aria-labelledby="preparation-heading" class="{{ $card }}">
                        <h2 id="preparation-heading" class="{{ $h2 }}" style="color: var(--color-dark);">{{ $label('preparation') }}</h2>
                        <p class="mt-3 text-slate-600">It helps to bring:</p>
                        <ul class="mt-4 grid sm:grid-cols-2 gap-3">
                            @foreach ($preparation as $item)
                                <li class="flex items-start gap-3 rounded-2xl p-4 text-sm text-slate-700" style="background: var(--color-light);">
                                    <i class="fa-solid fa-square-check mt-0.5 text-brand-600" aria-hidden="true"></i>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                        @if ($preparationLinks)
                            <div class="mt-5 flex flex-wrap gap-x-6 gap-y-2 text-sm font-bold">
                                @foreach ($preparationLinks as $page)
                                    <a href="{{ $catalog->url($page) }}" class="inline-flex items-center gap-1.5 text-brand-600 hover:text-brand-700">
                                        {{ $page['title'] }} <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </section>
                @endif

                {{-- F. What happens next --}}
                @if ($entry['nextSteps'])
                    <section id="next-steps" aria-labelledby="next-steps-heading" class="{{ $card }}">
                        <h2 id="next-steps-heading" class="{{ $h2 }}" style="color: var(--color-dark);">{{ $label('nextSteps') }}</h2>
                        <ul class="mt-5 space-y-3">
                            @foreach ($entry['nextSteps'] as $step)
                                <li class="flex items-start gap-3 text-slate-600 leading-relaxed">
                                    <i class="fa-solid fa-arrow-right mt-1.5 text-xs text-brand-500" aria-hidden="true"></i>
                                    {{ $step }}
                                </li>
                            @endforeach
                        </ul>
                        @if ($catalog->defaults('nextStepsNote'))
                            <p class="mt-5 text-sm text-slate-500">{{ $catalog->defaults('nextStepsNote') }}</p>
                        @endif
                    </section>
                @endif

                {{-- G. Frequently asked questions --}}
                @if ($entry['faqs'])
                    <section id="faqs" aria-labelledby="faqs-heading" class="{{ $card }}">
                        <h2 id="faqs-heading" class="{{ $h2 }}" style="color: var(--color-dark);">{{ $label('faqs') }}</h2>
                        <div class="mt-5 space-y-3">
                            @foreach ($entry['faqs'] as $faq)
                                <details class="group rounded-2xl border border-slate-100 open:border-brand-200 open:shadow-[0_10px_40px_-15px_rgba(61,90,254,0.3)] transition-shadow">
                                    <summary class="flex items-center justify-between gap-4 cursor-pointer list-none p-5 font-semibold rounded-2xl [&::-webkit-details-marker]:hidden focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600"
                                        style="color: var(--color-dark);">
                                        {{ $faq['question'] }}
                                        <span class="w-8 h-8 shrink-0 rounded-full flex items-center justify-center bg-brand-50 text-brand-600 transition-transform group-open:rotate-180" aria-hidden="true">
                                            <i class="fa-solid fa-chevron-down text-xs"></i>
                                        </span>
                                    </summary>
                                    <p class="px-5 pb-5 -mt-1 text-slate-600 leading-relaxed">{{ $faq['answer'] }}</p>
                                </details>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- Where to consult --}}
                @if ($entry['pageType'] === 'service' && $site->branches())
                    <section id="locations" aria-labelledby="locations-heading" class="{{ $card }}">
                        <h2 id="locations-heading" class="{{ $h2 }}" style="color: var(--color-dark);">Clinic locations</h2>
                        <p class="mt-3 text-slate-600">Please confirm the OPD day, timings and availability of this service when you book.</p>
                        @include('services.partials.branches')
                    </section>
                @endif

                {{-- J. Important medical guidance --}}
                <section aria-label="Important medical information" class="space-y-4">
                    @if ($catalog->defaults('disclaimer'))
                        <p class="flex items-start gap-3 rounded-2xl p-5 text-sm text-slate-600 bg-white border border-slate-100">
                            <i class="fa-solid fa-circle-info mt-0.5 text-brand-500" aria-hidden="true"></i>
                            {{ $catalog->defaults('disclaimer') }}
                        </p>
                    @endif
                    @unless ($entry['urgentNotice'])
                        <x-emergency-notice />
                    @endunless
                </section>
            </div>

            {{-- I. Appointment and contact actions --}}
            <aside class="min-w-0" aria-label="Book an appointment">
                <div class="lg:sticky lg:top-28 rounded-3xl bg-white border border-slate-100 p-6 sm:p-7 shadow-[0_20px_50px_-20px_rgba(11,20,55,0.2)]">
                    <p class="text-lg font-extrabold" style="color: var(--color-dark);">Book an appointment</p>
                    <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                        @if ($entry['pageType'] === 'service')
                            Ask about {{ $entry['title'] }} and appointment times at the {{ $site->branchCities() }} clinics.
                        @else
                            Ask about appointment times at the {{ $site->branchCities() }} clinics.
                        @endif
                    </p>
                    <div class="mt-5 grid gap-3">
                        <x-cta.book-appointment class="w-full" />
                        <x-cta.call-clinic class="w-full" :show-number="true" />
                        <x-cta.whatsapp-clinic class="w-full" label="WhatsApp the Clinic" />
                        <x-cta.email-clinic variant="link" class="justify-center mt-1" label="Email the clinic" />
                    </div>
                </div>
            </aside>
        </div>

        {{-- H. Related services --}}
        @if ($related)
            <section aria-labelledby="related-heading" class="max-w-6xl mx-auto mt-14">
                <h2 id="related-heading" class="text-2xl sm:text-3xl font-extrabold" style="color: var(--color-dark);">{{ $label('related') }}</h2>
                <div class="mt-6 grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach ($related as $relatedEntry)
                        <x-service-card :entry="$relatedEntry" :url="$catalog->url($relatedEntry)" />
                    @endforeach
                </div>
            </section>
        @endif

        <div class="max-w-6xl mx-auto mt-14">
            <x-cta.contact-panel />
        </div>
    </div>

@endsection

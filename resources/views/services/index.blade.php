@extends('layouts.app')

@section('title', '| Services, Conditions & Patient Resources')
@section('meta_description', 'Explore neurology specialities, conditions, diagnostic tests, rehabilitation services and patient guides. Learn what each involves and how to book an appointment.')

@php
    // Published entries per category, with the text the search box matches against.
    $sections = [];
    $searchIndex = [];
    foreach ($catalog->categories() as $category) {
        $groups = $catalog->groups($category['id'], publishedOnly: true);
        $count = array_sum(array_map(fn ($group) => count($group['entries']), $groups));
        if (! $count) {
            continue;
        }
        foreach ($groups as $group) {
            foreach ($group['entries'] as $entry) {
                $searchIndex[$entry['id']] = [
                    'c' => $category['id'],
                    't' => mb_strtolower(implode(' ', [$entry['title'], $entry['heading'], $entry['shortDescription'], $entry['menuDescription'], $group['label'], $category['label']])),
                ];
            }
        }
        $sections[] = ['category' => $category, 'groups' => $groups, 'count' => $count];
    }
@endphp

@section('content')

    {{-- Hero --}}
    <section class="relative overflow-hidden pt-36 pb-16 px-6" style="background: var(--gradient-hero);">
        <div class="absolute inset-0 bg-grid pointer-events-none" aria-hidden="true"></div>
        <div class="relative max-w-4xl mx-auto text-center">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-5 bg-white/10 border border-white/15"
                style="color: var(--color-secondary);">
                Our Services
            </span>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-5 leading-tight">
                Neurological Services &amp; <span class="text-gradient">Patient Care</span>
            </h1>
            <p class="text-white/75 text-lg max-w-2xl mx-auto leading-relaxed">
                Explore the clinic's specialities, the conditions we see, diagnostic tests, rehabilitation services and practical
                guides for patients. Each page explains what to expect, how to prepare and how to book.
            </p>
            <div class="flex flex-wrap justify-center gap-3 mt-8">
                <x-cta.book-appointment variant="light" size="lg" />
                <x-cta.call-clinic variant="glass" size="lg" :show-number="true" />
                <x-cta.whatsapp-clinic size="lg" />
            </div>
        </div>
    </section>

    <div x-data="{
            query: '',
            category: 'all',
            items: @js($searchIndex),
            matches(id) {
                const item = this.items[id];
                if (! item) return true;
                if (this.category !== 'all' && item.c !== this.category) return false;
                const words = this.query.trim().toLowerCase().split(/\s+/).filter(Boolean);
                return words.every((word) => item.t.includes(word));
            },
            count(category = null) {
                return Object.keys(this.items).filter((id) => (category === null || this.items[id].c === category) && this.matches(id)).length;
            },
            anyMatch(ids) {
                return ids.some((id) => this.matches(id));
            },
        }">

        {{-- Search and category filters --}}
        <div class="px-6 pt-10 pb-4 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col lg:flex-row lg:items-center gap-4">
                    <div class="relative lg:w-80 shrink-0">
                        <label for="service-search" class="sr-only">Search services, conditions and tests</label>
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm" aria-hidden="true"></i>
                        <input id="service-search" type="search" x-model.debounce.150ms="query" autocomplete="off"
                            placeholder="Search services, conditions or tests"
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-white text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:border-brand-400 focus:ring-2 focus:ring-brand-100">
                    </div>
                    <div class="flex flex-wrap gap-2" role="group" aria-label="Filter by category">
                        <button type="button" @click="category = 'all'" :aria-pressed="category === 'all'" aria-pressed="true"
                            class="px-4 py-2 rounded-full text-sm font-semibold border transition-colors focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600"
                            :class="category === 'all' ? 'bg-brand-600 border-brand-600 text-white' : 'bg-white border-slate-200 text-slate-600 hover:border-brand-300 hover:text-brand-600'">
                            All
                        </button>
                        @foreach ($sections as $section)
                            <button type="button" @click="category = '{{ $section['category']['id'] }}'"
                                :aria-pressed="category === '{{ $section['category']['id'] }}'" aria-pressed="false"
                                class="px-4 py-2 rounded-full text-sm font-semibold border transition-colors bg-white border-slate-200 text-slate-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600"
                                :class="category === '{{ $section['category']['id'] }}' ? '!bg-brand-600 !border-brand-600 !text-white' : 'hover:border-brand-300 hover:text-brand-600'">
                                {{ $section['category']['label'] }}
                                <span class="opacity-70">({{ $section['count'] }})</span>
                            </button>
                        @endforeach
                    </div>
                </div>
                <p class="sr-only" aria-live="polite" x-text="count() + ' results'"></p>
            </div>
        </div>

        {{-- Categories --}}
        @foreach ($sections as $index => $section)
            @php $category = $section['category']; @endphp
            <section id="{{ $category['id'] }}" aria-labelledby="{{ $category['id'] }}-heading"
                class="scroll-mt-24 px-6 py-14 {{ $index % 2 ? 'bg-white' : '' }}" @if ($index % 2 === 0) style="background: var(--color-light);" @endif
                x-show="count('{{ $category['id'] }}') > 0">
                <div class="max-w-7xl mx-auto">
                    <div class="flex items-start gap-4 mb-8">
                        <span class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 text-white text-lg shadow-lg shadow-brand-600/25"
                            style="background: var(--gradient-brand);">
                            <i class="{{ $category['icon'] }}" aria-hidden="true"></i>
                        </span>
                        <div>
                            <h2 id="{{ $category['id'] }}-heading" class="text-2xl sm:text-3xl font-extrabold" style="color: var(--color-dark);">
                                {{ $category['label'] }}
                            </h2>
                            @if ($category['description'])
                                <p class="mt-1 text-slate-500">{{ $category['description'] }}</p>
                            @endif
                        </div>
                    </div>

                    @foreach ($section['groups'] as $group)
                        <div @class(['mt-10 first:mt-0' => $group['label']]) x-show="anyMatch(@js(array_column($group['entries'], 'id')))">
                            @if ($group['label'])
                                <h3 class="flex items-center gap-2.5 mb-4 text-xs font-bold uppercase tracking-[0.14em] text-brand-600">
                                    <span class="w-7 h-7 rounded-lg flex items-center justify-center bg-brand-50 text-brand-600 text-xs">
                                        <i class="{{ $group['icon'] }}" aria-hidden="true"></i>
                                    </span>
                                    {{ $group['label'] }}
                                </h3>
                            @endif
                            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                                @foreach ($group['entries'] as $entry)
                                    <x-service-card :entry="$entry" :url="$catalog->url($entry)" :heading-level="$group['label'] ? 'h4' : 'h3'"
                                        x-show="matches('{{ $entry['id'] }}')" />
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach

        <div x-show="count() === 0" style="display: none;" class="px-6 py-16 text-center">
            <p class="text-lg font-bold" style="color: var(--color-dark);">No services match your search.</p>
            <p class="mt-2 text-slate-500">Try a different word, or contact the clinic and we will help you find the right service.</p>
            <div class="flex flex-wrap justify-center gap-3 mt-6">
                <x-cta.call-clinic />
                <x-cta.whatsapp-clinic />
            </div>
        </div>
    </div>

    {{-- Other help --}}
    <section class="px-6 py-14 bg-white">
        <div class="max-w-7xl mx-auto space-y-10">
            <div class="grid md:grid-cols-3 gap-5">
                @foreach ([
                    ['icon' => 'fa-solid fa-user-doctor', 'title' => 'Doctors', 'text' => 'Meet ' . $site->displayName() . ': qualifications, experience and areas of expertise.', 'url' => url('/about')],
                    ['icon' => 'fa-solid fa-hospital', 'title' => 'About the Clinic', 'text' => 'Clinic locations in Patna, Ara and Siwan, OPD days and directions.', 'url' => url('/clinics')],
                    ['icon' => 'fa-solid fa-headset', 'title' => 'Contact Us', 'text' => 'Call, WhatsApp or email the clinic, or send an appointment request.', 'url' => url('/contact')],
                ] as $link)
                    <a href="{{ $link['url'] }}"
                        class="group flex items-start gap-4 rounded-2xl p-6 border border-slate-100 transition hover:border-brand-100 hover:shadow-lg"
                        style="background: var(--color-light);">
                        <span class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 bg-white text-brand-600 shadow-sm">
                            <i class="{{ $link['icon'] }}" aria-hidden="true"></i>
                        </span>
                        <span>
                            <span class="flex items-center gap-2 font-bold" style="color: var(--color-dark);">
                                {{ $link['title'] }}
                                <i class="fa-solid fa-arrow-right text-xs text-brand-600 transition-transform group-hover:translate-x-1" aria-hidden="true"></i>
                            </span>
                            <span class="block mt-1 text-sm text-slate-500">{{ $link['text'] }}</span>
                        </span>
                    </a>
                @endforeach
            </div>

            <x-cta.contact-panel />

            <x-emergency-notice />
        </div>
    </section>

@endsection

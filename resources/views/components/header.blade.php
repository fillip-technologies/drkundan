@inject('navigation', 'App\Support\Navigation')

@php
$mainLinks = $navigation->main();
$menus = $navigation->menus();
@endphp

<style>
    .site-header :is(a, button):focus-visible {
        outline: 2px solid var(--color-primary);
        outline-offset: 2px;
    }

    .nav-trigger[aria-expanded="true"] {
        background-color: #EEF2FF;
        color: #2B3FD6;
    }

    .nav-chevron {
        transition: transform .2s ease;
    }

    [aria-expanded="true"]>.nav-chevron {
        transform: rotate(180deg);
    }

    /* Desktop panels: hidden panels are invisible, so their links leave the tab order. */
    .mega-panel {
        visibility: hidden;
        opacity: 0;
        transform: translateY(-6px);
        pointer-events: none;
        transition: opacity .18s ease, transform .18s ease, visibility 0s linear .18s;
    }

    .mega-panel.is-open {
        visibility: visible;
        opacity: 1;
        transform: none;
        pointer-events: auto;
        transition: opacity .18s ease, transform .18s ease, visibility 0s;
    }

    /* Moving between open panels swaps them instantly instead of cross-fading. */
    .is-switching .mega-panel {
        transition: none;
    }

    @media (prefers-reduced-motion: reduce) {

        .site-header *,
        .site-header *::before,
        .site-header *::after {
            transition-duration: 0s !important;
        }

        .mega-panel {
            transform: none;
        }
    }
</style>

<!-- Floating Glass Header -->
<header x-data="siteNav" class="site-header fixed top-4 left-1/2 -translate-x-1/2 w-[calc(100%-2rem)] max-w-7xl z-50"
    @keydown.escape.window="onEscape()" @click.outside="closeAll()" @pointerenter="cancelClose()"
    @pointerleave="leaveArea($event)">
    <div class="relative backdrop-blur-xl bg-white/95 border border-white/60 shadow-[0_8px_30px_rgba(11,20,55,0.08)] rounded-2xl">

        <div class="flex items-center justify-between gap-4 px-4 sm:px-5 py-2.5">

            <!-- Logo / Doctor Identity (name is visually hidden on phones to keep Book Appointment in the bar) -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 shrink-0 rounded-xl">
                <img src="{{ asset('images/dr-kundan-logo.png') }}" alt="Dr. Kundan Kumar logo" class="w-10 h-10 object-contain shrink-0 rounded-xl border border-amber-300/50 bg-amber-50/50 p-0.5">
                <span class="leading-tight sr-only sm:not-sr-only">
                    <span class="block text-sm font-bold" style="color: var(--color-dark);">Dr. Kundan Kumar</span>
                    <span class="block text-xs font-semibold text-amber-700">Neurosurgeon · Patna</span>
                </span>
            </a>

            <!-- Desktop Navigation -->
            <nav aria-label="Main" class="hidden xl:flex flex-1 min-w-0 justify-center" x-ref="desktopNav"
                :class="{ 'is-switching': switching }">
                <ul class="flex items-center gap-0.5 text-[13.5px] font-semibold">
                    @foreach ($mainLinks as $link)
                    @if (isset($link['menu']))
                    @php
                    $key = $link['menu'];
                    $menu = $menus[$key];
                    $isMega = $menu['type'] === 'mega';
                    @endphp
                    <li @class(['relative'=> ! $isMega]) @focusout="focusLeave('{{ $key }}', $event)">
                        <button type="button" id="nav-trigger-{{ $key }}" data-nav-trigger
                            class="nav-trigger inline-flex items-center gap-1 px-2.5 py-2 rounded-xl whitespace-nowrap transition-colors {{ $link['active'] ? 'bg-brand-50 text-brand-600' : 'text-slate-600 hover:text-brand-600 hover:bg-brand-50/60' }}"
                            aria-expanded="false" :aria-expanded="isOpen('{{ $key }}')"
                            aria-controls="nav-panel-{{ $key }}" @click="toggle('{{ $key }}', $event)"
                            @pointerenter="hoverIn('{{ $key }}', $event)" @pointerleave="hoverOut($event)"
                            @focus="focusIn('{{ $key }}', $event)" @keydown.down.prevent="openAndFocus('{{ $key }}')">
                            {{ $link['label'] }}
                            <svg class="nav-chevron w-3 h-3 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- {{ $link['label'] }} Menu -->
                        <div id="nav-panel-{{ $key }}"
                            @class([ 'mega-panel absolute top-full' , 'inset-x-0 pt-2'=> $isMega,
                            'pt-5' => ! $isMega,
                            'right-0' => ! $isMega && ($menu['align'] ?? 'left') === 'right',
                            'left-0' => ! $isMega && ($menu['align'] ?? 'left') === 'left',
                            ])
                            :class="{ 'is-open': isOpen('{{ $key }}') }">
                            <div @class([ 'bg-white rounded-2xl border border-slate-100 shadow-[0_24px_60px_-20px_rgba(11,20,55,0.28)] overflow-y-auto overscroll-contain' , 'flex gap-10 px-8 py-7'=> $isMega,
                                'flex gap-3 p-3' => ! $isMega,
                                ]) style="max-height: calc(100vh - 6.5rem); max-height: calc(100dvh - 6.5rem);">

                                <div @class([ 'flex-1 min-w-0'=> $isMega,
                                    'shrink-0 px-3 py-1' => ! $isMega,
                                    'w-72' => ! $isMega && ! $menu['profile'],
                                    'w-52' => ! $isMega && $menu['profile'],
                                    ])>
                                    @if ($menu['rows'])
                                    <ul class="grid {{ $menu['gridClass'] }} {{ $menu['rows'] }} grid-flow-col gap-x-10 gap-y-1">
                                        @foreach ($menu['groups'][0]['items'] as $item)
                                        <li>@include('components.partials.nav-item', ['item' => $item])</li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <div class="grid {{ $menu['gridClass'] }} gap-x-10 gap-y-6">
                                        @foreach ($menu['groups'] as $g => $group)
                                        <div class="min-w-0">
                                            <p id="nav-{{ $key }}-{{ $g }}"
                                                class="flex items-center gap-2.5 text-[11px] font-bold uppercase tracking-[0.14em] text-brand-600">
                                                @if ($group['icon'])
                                                <span class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 text-white text-xs shadow-sm shadow-brand-600/30"
                                                    style="background: var(--gradient-brand);">
                                                    <i class="{{ $group['icon'] }}" aria-hidden="true"></i>
                                                </span>
                                                @endif
                                                {{ $group['heading'] }}
                                            </p>
                                            <ul aria-labelledby="nav-{{ $key }}-{{ $g }}" class="mt-3 space-y-0.5">
                                                @foreach ($group['items'] as $item)
                                                <li>@include('components.partials.nav-item', ['item' => $item])</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>

                                @if ($menu['profile'])
                                @php $profile = $menu['profile']; @endphp
                                <div class="w-64 shrink-0 rounded-xl p-4" style="background: var(--color-light); border: 1px solid rgba(var(--primary-rgb),0.1);">
                                    <a href="{{ $profile['url'] }}" class="group/link flex items-center gap-3 rounded-lg">
                                        @if ($profile['image'])
                                        <img src="{{ asset($profile['image']) }}" alt="" class="w-12 h-12 rounded-xl object-cover object-top shrink-0">
                                        @endif
                                        <span class="min-w-0">
                                            <span class="block text-[11px] font-bold uppercase tracking-[0.14em] text-brand-600">Doctor Profile</span>
                                            <span class="block font-bold group-hover/link:text-brand-700" style="color: var(--color-dark);">{{ $profile['name'] }}</span>
                                            <span class="block text-xs text-slate-500">{{ $profile['role'] }}</span>
                                        </span>
                                    </a>
                                    <ul class="mt-3 pt-2 border-t border-slate-200/70 px-3">
                                        @foreach ($profile['items'] as $item)
                                        <li>@include('components.partials.nav-item', ['item' => $item])</li>
                                        @endforeach
                                    </ul>
                                    <x-cta.book-appointment size="sm" class="mt-3 w-full" />
                                </div>
                                @endif

                            </div>
                        </div>
                    </li>
                    @else
                    <li>
                        <a href="{{ $link['href'] }}" @if ($link['active']) aria-current="page" @endif
                            class="block px-2.5 py-2 rounded-xl whitespace-nowrap transition-colors {{ $link['active'] ? 'bg-brand-50 text-brand-600' : 'text-slate-600 hover:text-brand-600 hover:bg-brand-50/60' }}">
                            {{ $link['label'] }}
                        </a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </nav>

            <!-- Appointment -->
            <x-cta.book-appointment size="sm" class="!hidden xl:!inline-flex shrink-0 pl-5 pr-4" />

            <!-- Mobile Actions -->
            <div class="flex xl:hidden items-center gap-2">
                <x-cta.book-appointment size="sm" :icon="false" class="!px-3.5 sm:!px-4 !text-[13px] sm:!text-sm" />
                <button type="button" x-ref="mobileToggle" @click="mobileOpen = !mobileOpen"
                    class="w-11 h-11 rounded-xl flex items-center justify-center bg-brand-50"
                    aria-controls="mobile-menu" aria-expanded="false" :aria-expanded="mobileOpen"
                    aria-label="Open menu" :aria-label="mobileOpen ? 'Close menu' : 'Open menu'">
                    <svg x-show="!mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" style="color: var(--color-dark);"
                        viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" style="display: none; color: var(--color-dark);"
                        viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

        </div>

    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" x-show="mobileOpen" x-transition.opacity.duration.150ms
        class="xl:hidden mt-3 flex flex-col overflow-hidden backdrop-blur-xl bg-white/95 border border-white/60 shadow-xl rounded-2xl"
        style="display: none; max-height: calc(100vh - 6.5rem); max-height: calc(100dvh - 6.5rem);">

        <nav aria-label="Main" class="flex-1 min-h-0 overflow-y-auto overscroll-contain p-3">
            <ul class="space-y-0.5">
                @foreach ($mainLinks as $link)
                @if (isset($link['menu']))
                @php
                $key = $link['menu'];
                $menu = $menus[$key];
                @endphp
                <li x-data="{ open: false }">
                    <button type="button" id="mnav-trigger-{{ $key }}" @click="open = !open"
                        class="w-full flex items-center justify-between gap-3 px-4 min-h-[48px] rounded-xl text-[15px] font-semibold text-left transition-colors {{ $link['active'] ? 'text-brand-600' : 'text-slate-700' }}"
                        :class="open ? 'bg-brand-50/70' : 'hover:bg-slate-50'"
                        aria-expanded="false" :aria-expanded="open" aria-controls="mnav-panel-{{ $key }}">
                        {{ $link['label'] }}
                        <svg class="nav-chevron w-4 h-4 shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="mnav-panel-{{ $key }}" x-show="open" style="display: none;" class="px-4 pt-3 pb-4 space-y-5">
                        @foreach ($menu['groups'] as $g => $group)
                        <div>
                            @if ($group['heading'])
                            <p id="mnav-{{ $key }}-{{ $g }}"
                                class="mb-2 flex items-center gap-2.5 text-[11px] font-bold uppercase tracking-[0.14em] text-brand-600">
                                @if ($group['icon'])
                                <span class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 text-white text-xs"
                                    style="background: var(--gradient-brand);">
                                    <i class="{{ $group['icon'] }}" aria-hidden="true"></i>
                                </span>
                                @endif
                                {{ $group['heading'] }}
                            </p>
                            @endif
                            <ul @if ($group['heading']) aria-labelledby="mnav-{{ $key }}-{{ $g }}" @endif class="pl-3 border-l-2 border-brand-100">
                                @foreach ($group['items'] as $item)
                                <li>@include('components.partials.nav-item', ['item' => $item, 'mobile' => true])</li>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach

                        @if ($menu['profile'])
                        @php $profile = $menu['profile']; @endphp
                        <div class="rounded-xl p-4" style="background: var(--color-light);">
                            <a href="{{ $profile['url'] }}" @click="mobileOpen = false" class="flex items-center gap-3">
                                @if ($profile['image'])
                                <img src="{{ asset($profile['image']) }}" alt="" class="w-12 h-12 rounded-xl object-cover object-top shrink-0">
                                @endif
                                <span>
                                    <span class="block text-[11px] font-bold uppercase tracking-[0.14em] text-brand-600">Doctor Profile</span>
                                    <span class="block font-bold" style="color: var(--color-dark);">{{ $profile['name'] }}</span>
                                    <span class="block text-xs text-slate-500">{{ $profile['role'] }}</span>
                                </span>
                            </a>
                            <ul class="mt-3">
                                @foreach ($profile['items'] as $item)
                                <li>@include('components.partials.nav-item', ['item' => $item, 'mobile' => true])</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </li>
                @else
                <li>
                    <a href="{{ $link['href'] }}" @click="mobileOpen = false" @if ($link['active']) aria-current="page" @endif
                        class="flex items-center px-4 min-h-[48px] rounded-xl text-[15px] font-semibold transition-colors {{ $link['active'] ? 'bg-brand-50 text-brand-600' : 'text-slate-700 hover:bg-slate-50' }}">
                        {{ $link['label'] }}
                    </a>
                </li>
                @endif
                @endforeach
            </ul>
        </nav>

        <div class="shrink-0 p-3 space-y-2 border-t border-slate-100 bg-white/80">
            <x-cta.book-appointment class="w-full min-h-[48px]" x-on:click="mobileOpen = false" />
            <div class="grid grid-cols-2 gap-2">
                <x-cta.call-clinic size="sm" class="min-h-[44px]" />
                <x-cta.whatsapp-clinic size="sm" class="min-h-[44px]" />
            </div>
        </div>

    </div>
</header>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('siteNav', () => ({
            active: null, // key of the open desktop panel
            openedBy: null, // 'hover' | 'focus' | 'click'
            switching: false,
            mobileOpen: false,
            openTimer: null,
            closeTimer: null,
            restoringFocus: false,

            init() {
                this.$watch('mobileOpen', (open) => document.documentElement.classList.toggle('overflow-hidden', open));
                window.matchMedia('(min-width: 1280px)').addEventListener('change', () => this.closeAll());
                window.addEventListener('pageshow', (event) => event.persisted && this.closeAll());
            },

            isOpen(key) {
                return this.active === key;
            },

            open(key, by) {
                this.clearTimers();
                this.switching = this.active !== null && this.active !== key;
                this.active = key;
                this.openedBy = by;
            },

            close() {
                this.clearTimers();
                this.switching = false;
                this.active = null;
                this.openedBy = null;
            },

            closeAll() {
                this.close();
                this.mobileOpen = false;
            },

            clearTimers() {
                clearTimeout(this.openTimer);
                clearTimeout(this.closeTimer);
            },

            // Hover intent: a short delay stops panels opening or switching as the pointer sweeps past.
            hoverIn(key, event) {
                if (event.pointerType === 'touch') return;
                this.clearTimers();
                if (this.active === key) return;
                this.openTimer = setTimeout(() => this.open(key, 'hover'), this.active ? 120 : 60);
            },

            hoverOut(event) {
                if (event.pointerType !== 'touch') clearTimeout(this.openTimer);
            },

            cancelClose() {
                clearTimeout(this.closeTimer);
            },

            leaveArea(event) {
                if (event.pointerType === 'touch') return;
                clearTimeout(this.openTimer);
                if (this.active && this.openedBy !== 'focus') {
                    this.closeTimer = setTimeout(() => this.close(), 200);
                }
            },

            toggle(key, event) {
                if (this.active !== key) return this.open(key, 'click');
                // A pointer click on a panel that hover has just opened keeps it open.
                if (this.openedBy === 'hover' && event.detail > 0) return (this.openedBy = 'click');
                this.close();
            },

            focusIn(key, event) {
                if (this.restoringFocus || !event.target.matches(':focus-visible')) return;
                if (this.active !== key) this.open(key, 'focus');
            },

            focusLeave(key, event) {
                const next = event.relatedTarget;
                if (this.active !== key || !next || event.currentTarget.contains(next)) return;
                if (next.hasAttribute('data-nav-trigger')) return; // that trigger switches panels itself
                this.close();
            },

            openAndFocus(key) {
                this.open(key, 'focus');
                this.$nextTick(() => document.getElementById('nav-panel-' + key)?.querySelector('a, button')?.focus());
            },

            onEscape() {
                if (this.mobileOpen) {
                    this.mobileOpen = false;
                    this.$refs.mobileToggle.focus();
                    return;
                }
                if (!this.active) return;

                const trigger = document.getElementById('nav-trigger-' + this.active);
                const focusInside = this.$refs.desktopNav.contains(document.activeElement);
                this.close();
                if (focusInside) {
                    this.restoringFocus = true;
                    trigger.focus();
                    this.restoringFocus = false;
                }
            },
        }));
    });
</script>

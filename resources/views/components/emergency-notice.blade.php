{{-- Emergency guidance: tells visitors to seek emergency care instead of booking. Text comes from site.json. --}}
@props(['text' => null, 'title' => 'In an emergency'])
@inject('site', 'App\Support\SiteConfig')

@php $text ??= $site->emergencyGuidance(); @endphp

@if ($text)
    <div {{ $attributes->class('rounded-2xl border border-rose-200 bg-rose-50 p-5 sm:p-6') }} role="note">
        <div class="flex items-start gap-4">
            <span class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 bg-rose-600 text-white">
                <i class="fa-solid fa-truck-medical" aria-hidden="true"></i>
            </span>
            <div class="min-w-0">
                <p class="font-bold text-rose-700">{{ $title }}</p>
                <p class="mt-1.5 text-sm leading-relaxed text-slate-700">{{ $text }}</p>
                @if ($site->emergencyTelUrl())
                    <a href="{{ $site->emergencyTelUrl() }}" class="{{ \App\Support\CtaStyle::classes('emergency', 'sm') }} mt-4">
                        <i class="fa-solid fa-phone text-xs" aria-hidden="true"></i> Call {{ $site->emergencyNumber() }}
                    </a>
                @endif
            </div>
        </div>
    </div>
@endif

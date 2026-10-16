{{-- Book Appointment action. The booking URL and label come from resources/data/site.json. --}}
@props(['variant' => 'primary', 'size' => 'md', 'icon' => true])
@inject('site', 'App\Support\SiteConfig')

@if ($site->bookingUrl())
    <a href="{{ $site->bookingUrl() }}" {{ $attributes->class(\App\Support\CtaStyle::classes($variant, $size)) }}>
        @if ($slot->isEmpty())
            {{ $site->bookingLabel() }}
            @if ($icon)
                <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i>
            @endif
        @else
            {{ $slot }}
        @endif
    </a>
@endif

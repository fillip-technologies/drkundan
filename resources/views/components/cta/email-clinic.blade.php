{{-- Email action. The address comes from resources/data/site.json. --}}
@props(['variant' => 'outline', 'size' => 'md', 'icon' => true, 'showAddress' => false, 'label' => 'Email'])
@inject('site', 'App\Support\SiteConfig')

@if ($site->mailtoUrl())
    <a href="{{ $site->mailtoUrl() }}" {{ $attributes->class(\App\Support\CtaStyle::classes($variant, $size)) }}>
        @if ($slot->isEmpty())
            @if ($icon)
                <i class="fa-regular fa-envelope text-xs" aria-hidden="true"></i>
            @endif
            {{ $showAddress ? $site->email() : $label }}
        @else
            {{ $slot }}
        @endif
    </a>
@endif

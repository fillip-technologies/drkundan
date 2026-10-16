{{-- Call Clinic action. The phone number comes from resources/data/site.json. --}}
@props(['variant' => 'outline', 'size' => 'md', 'icon' => true, 'showNumber' => false, 'label' => 'Call Clinic'])
@inject('site', 'App\Support\SiteConfig')

@if ($site->telUrl())
    <a href="{{ $site->telUrl() }}" {{ $attributes->class(\App\Support\CtaStyle::classes($variant, $size)) }}>
        @if ($slot->isEmpty())
            @if ($icon)
                <i class="fa-solid fa-phone text-xs" aria-hidden="true"></i>
            @endif
            {{ $showNumber ? $site->phoneDisplay() : $label }}
        @else
            {{ $slot }}
        @endif
    </a>
@endif

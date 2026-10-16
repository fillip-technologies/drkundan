{{--
    WhatsApp Clinic action. The number and the default generic enquiry message
    come from resources/data/site.json; never put patient health details in $message.
--}}
@props(['variant' => 'whatsapp', 'size' => 'md', 'icon' => true, 'label' => 'WhatsApp', 'message' => null])
@inject('site', 'App\Support\SiteConfig')

@if ($site->whatsappUrl($message))
    <a href="{{ $site->whatsappUrl($message) }}" target="_blank" rel="noopener"
        {{ $attributes->class(\App\Support\CtaStyle::classes($variant, $size)) }}>
        @if ($slot->isEmpty())
            @if ($icon)
                <i class="fa-brands fa-whatsapp text-base" aria-hidden="true"></i>
            @endif
            {{ $label }}
        @else
            {{ $slot }}
        @endif
    </a>
@endif

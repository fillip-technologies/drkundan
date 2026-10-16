<?php

namespace App\Support;

/**
 * Shared button styles for the clinic CTA components (resources/views/components/cta).
 */
class CtaStyle
{
    private const BASE = 'inline-flex items-center justify-center gap-2 rounded-xl font-semibold whitespace-nowrap transition';

    private const VARIANTS = [
        'primary' => 'text-white shadow-lg shadow-brand-600/30 bg-[image:var(--gradient-brand)] hover:-translate-y-0.5',
        'light' => 'bg-white text-brand-600 shadow-lg shadow-black/10 hover:-translate-y-0.5',
        'outline' => 'bg-white text-brand-600 border border-brand-200 hover:border-brand-300 hover:bg-brand-50',
        'glass' => 'text-white bg-white/10 border border-white/20 backdrop-blur hover:bg-white/15',
        // Darker than WhatsApp's brand green so white text keeps accessible contrast.
        'whatsapp' => 'text-white bg-green-700 shadow-lg shadow-black/10 hover:bg-green-800 hover:-translate-y-0.5',
        'emergency' => 'text-white bg-rose-600 hover:bg-rose-700',
        'link' => 'text-brand-600 hover:text-brand-700',
    ];

    private const SIZES = [
        'sm' => 'px-4 py-2.5 text-sm',
        'md' => 'px-5 py-3 text-sm',
        'lg' => 'px-7 py-4 text-base',
    ];

    /**
     * Classes for a variant and size. The 'none' variant adds nothing, for
     * existing sections that keep their own button styling.
     */
    public static function classes(string $variant, string $size = 'md'): string
    {
        if ($variant === 'none') {
            return '';
        }

        $size = $variant === 'link' ? '' : (self::SIZES[$size] ?? self::SIZES['md']);

        return trim(self::BASE.' '.(self::VARIANTS[$variant] ?? self::VARIANTS['primary']).' '.$size);
    }
}

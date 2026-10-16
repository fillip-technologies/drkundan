{{-- A catalog entry as a card with a "View Details" link; the whole card is clickable. --}}
@props(['entry', 'url', 'headingLevel' => 'h3'])

<article {{ $attributes->class('group relative flex flex-col rounded-2xl bg-white p-6 border border-slate-100 transition-all duration-300 hover:-translate-y-1 hover:border-brand-100 hover:shadow-[0_20px_50px_-12px_rgba(61,90,254,0.25)] focus-within:border-brand-200') }}>
    <span class="w-12 h-12 rounded-xl flex items-center justify-center text-lg bg-brand-50 text-brand-600 transition-colors group-hover:bg-brand-600 group-hover:text-white">
        <i class="{{ $entry['icon'] }}" aria-hidden="true"></i>
    </span>
    <{{ $headingLevel }} class="mt-4 font-bold text-lg leading-snug" style="color: var(--color-dark);">{{ $entry['title'] }}</{{ $headingLevel }}>
    <p class="mt-2 text-sm leading-relaxed text-slate-500 flex-1">{{ $entry['shortDescription'] }}</p>
    <a href="{{ $url }}"
        class="mt-5 inline-flex items-center gap-1.5 text-sm font-bold text-brand-600 after:absolute after:inset-0 after:rounded-2xl group-hover:gap-2.5 transition-all">
        View Details<span class="sr-only">: {{ $entry['title'] }}</span>
        <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i>
    </a>
</article>

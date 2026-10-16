{{-- Clinic branches from resources/data/site.json. --}}
<ul class="mt-5 grid sm:grid-cols-3 gap-4">
    @foreach ($site->branches() as $branch)
        <li class="flex flex-col rounded-2xl p-5" style="background: var(--color-light);">
            <p class="font-bold" style="color: var(--color-dark);">{{ $branch['name'] }}</p>
            @if (! empty($branch['address']))
                <p class="mt-1 text-sm text-slate-500 leading-relaxed">{{ $branch['address'] }}</p>
            @endif
            @if (! empty($branch['opd']))
                <p class="mt-3 flex items-start gap-2 text-sm font-semibold text-slate-700">
                    <i class="fa-regular fa-clock mt-0.5 text-brand-600" aria-hidden="true"></i>
                    {{ $branch['opd'] }}
                </p>
            @endif
            @if (! empty($branch['mapUrl']))
                <a href="{{ $branch['mapUrl'] }}" target="_blank" rel="noopener"
                    class="mt-auto pt-4 inline-flex items-center gap-1.5 text-sm font-bold text-brand-600 hover:text-brand-700">
                    Directions<span class="sr-only"> to {{ $branch['name'] }} (opens Google Maps)</span>
                    <i class="fa-solid fa-arrow-up-right-from-square text-xs" aria-hidden="true"></i>
                </a>
            @endif
        </li>
    @endforeach
</ul>

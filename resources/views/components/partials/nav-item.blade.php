{{-- One header menu entry: a link when the item has a page, plain text otherwise. --}}
@php $mobile = $mobile ?? false; @endphp

@if ($item['href'])
    <a href="{{ $item['href'] }}" @if ($item['current']) aria-current="page" @endif @if ($mobile) @click="mobileOpen = false" @endif
        class="group/link flex items-center gap-3 px-3 py-2 rounded-xl transition-colors hover:bg-brand-50 {{ $mobile ? 'min-h-[44px]' : '-mx-3' }} {{ $item['current'] ? 'bg-brand-50' : '' }}">
        @if ($item['icon'])
            <span class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 text-[13px] transition-colors group-hover/link:bg-brand-600 group-hover/link:text-white {{ $item['current'] ? 'bg-brand-600 text-white' : 'bg-brand-50 text-brand-600' }}">
                <i class="{{ $item['icon'] }}" aria-hidden="true"></i>
            </span>
        @endif
        <span class="min-w-0 flex-1">
            <span class="block text-sm font-medium transition-colors group-hover/link:text-brand-700 {{ $item['current'] ? 'text-brand-700' : 'text-slate-700' }}">{{ $item['label'] }}</span>
            @if ($item['description'])
                <span class="block mt-0.5 text-xs leading-snug text-slate-500">{{ $item['description'] }}</span>
            @endif
        </span>
        <i class="fa-solid fa-chevron-right text-[10px] text-slate-300 shrink-0 transition-colors group-hover/link:text-brand-500" aria-hidden="true"></i>
    </a>
@else
    <span class="flex items-center gap-3 py-2 {{ $mobile ? 'px-3' : '' }}">
        @if ($item['icon'])
            <span class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 text-[13px] bg-brand-50 text-brand-600">
                <i class="{{ $item['icon'] }}" aria-hidden="true"></i>
            </span>
        @endif
        <span class="min-w-0 flex-1">
            <span class="block text-sm font-medium text-slate-700">{{ $item['label'] }}</span>
            @if ($item['description'])
                <span class="block mt-0.5 text-xs leading-snug text-slate-500">{{ $item['description'] }}</span>
            @endif
        </span>
    </span>
@endif

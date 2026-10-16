@php
    $trustStats = [
        ['value' => '10+', 'label' => 'Years Experience', 'icon' => 'fa-regular fa-clock'],
        ['value' => '5000+', 'label' => 'Patients Treated', 'icon' => 'fa-solid fa-user-group'],
        ['value' => '95%', 'label' => 'Success Rate', 'icon' => 'fa-solid fa-heart-pulse'],
        ['value' => '3+', 'label' => 'Clinics in Patna And Siwan', 'icon' => 'fa-regular fa-hospital'],
    ];
@endphp

<section class="relative -mt-16 z-20 px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-2 lg:grid-cols-4 rounded-3xl bg-white shadow-[0_20px_60px_-15px_rgba(11,20,55,0.25)] border border-slate-100 overflow-hidden"
            data-aos="fade-up">

            @foreach ($trustStats as $i => $stat)
                <div class="group flex flex-col sm:flex-row items-start sm:items-center gap-3 sm:gap-4 p-5 sm:p-6 lg:p-7 transition-colors duration-300 hover:bg-brand-50/50
                    {{ $i % 2 === 1 ? 'border-l' : '' }} {{ $i >= 2 ? 'border-t lg:border-t-0' : '' }} {{ $i === 2 ? 'lg:border-l' : '' }} border-slate-100">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0 text-white shadow-lg shadow-brand-600/25 transition-transform duration-300 group-hover:scale-110"
                        style="background: var(--gradient-brand);">
                        <i class="{{ $stat['icon'] }}"></i>
                    </div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-extrabold leading-none" style="color: var(--color-dark);">{{ $stat['value'] }}</p>
                        <p class="text-xs font-semibold mt-1.5 text-slate-500">{{ $stat['label'] }}</p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>

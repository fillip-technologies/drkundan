@php
    $conditions = [
        ['title' => 'Slip Disc', 'icon' => 'fa-solid fa-bone', 'text' => 'Comprehensive diagnosis and treatment for disc herniation and back pain relief'],
        ['title' => 'Brain Tumor', 'icon' => 'fa-solid fa-brain', 'text' => 'Advanced surgical and therapeutic interventions for brain tumor management'],
        ['title' => 'Epilepsy', 'icon' => 'fa-solid fa-bolt', 'text' => 'Medical and surgical options for seizure disorder control and management'],
        ['title' => 'Spine Injury', 'icon' => 'fa-solid fa-user-injured', 'text' => 'Specialized care for acute and chronic spinal injuries with precision treatment'],
    ];
@endphp

<section class="py-24 bg-white">

    <div class="max-w-7xl mx-auto px-6">

        <!-- Heading -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4"
                style="background: var(--color-soft); color: var(--color-primary);">
                Conditions
            </span>
            <h2 class="text-4xl font-extrabold" style="color: var(--color-dark);">
                Conditions Treated
            </h2>
            <p class="text-slate-500 mt-3">
                Expert treatment for neurological and spinal conditions
            </p>
        </div>

        <!-- Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach ($conditions as $i => $condition)
                <div class="group relative p-7 rounded-3xl border border-slate-100 bg-white transition-all duration-300 hover:-translate-y-1 hover:border-transparent hover:shadow-[0_20px_50px_-12px_rgba(61,90,254,0.25)]"
                    data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="relative w-14 h-14 flex items-center justify-center rounded-2xl mb-6 text-xl overflow-hidden transition-all duration-300 bg-brand-50 text-brand-600 group-hover:text-white group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-brand-600/30">
                        <span class="absolute inset-0 opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                            style="background: var(--gradient-brand);"></span>
                        <i class="relative {{ $condition['icon'] }}"></i>
                    </div>
                    <h3 class="font-bold text-lg" style="color: var(--color-dark);">{{ $condition['title'] }}</h3>
                    <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                        {{ $condition['text'] }}
                    </p>
                    <span class="absolute top-6 right-6 text-xs font-bold text-slate-300">0{{ $i + 1 }}</span>
                </div>
            @endforeach

        </div>

        <!-- Helper Text -->
        <div class="mt-14 flex flex-col md:flex-row items-center justify-between gap-6 rounded-3xl p-8 md:px-10"
            style="background: var(--color-light);" data-aos="fade-up">
            <div class="text-center md:text-left">
                <p class="text-lg font-bold" style="color: var(--color-dark);">
                    Not sure which condition matches your symptoms?
                </p>
                <p class="text-slate-500 mt-1 max-w-2xl">
                    If you're experiencing symptoms related to any of these conditions, consult with Dr. Kundan Kumar for
                    expert diagnosis and personalized treatment plan.
                </p>
            </div>
            <a href="{{ $site->bookingUrl() }}"
                class="shrink-0 inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl text-white font-semibold shadow-lg shadow-brand-600/30 transition hover:-translate-y-0.5"
                style="background: var(--gradient-brand);">
                Consult Now <i class="fa-solid fa-arrow-right text-sm"></i>
            </a>
        </div>

    </div>

</section>

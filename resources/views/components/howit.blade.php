@php
    $steps = [
        ['title' => 'Book Appointment', 'icon' => 'fa-regular fa-calendar-check', 'text' => 'Schedule your consultation online or via call'],
        ['title' => 'Consult Doctor', 'icon' => 'fa-solid fa-user-doctor', 'text' => 'Meet the specialist for evaluation & diagnosis'],
        ['title' => 'Diagnosis & Treatment', 'icon' => 'fa-solid fa-notes-medical', 'text' => 'Get personalized treatment plan and procedures'],
        ['title' => 'Recovery & Follow-up', 'icon' => 'fa-solid fa-heart-pulse', 'text' => 'Continuous care for faster and safe recovery'],
    ];
@endphp

<section class="relative py-24 overflow-hidden" style="background: var(--gradient-hero);">

    <!-- Background -->
    <div class="absolute inset-0 bg-grid"></div>

    <div class="relative max-w-7xl mx-auto px-6 text-white">

        <!-- Heading -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4 bg-white/10 border border-white/15"
                style="color: var(--color-secondary);">
                Process
            </span>
            <h2 class="text-4xl font-extrabold">How It <span class="text-gradient">Works</span></h2>
            <p class="text-white/65 mt-3">
                Simple steps to get expert neurological care
            </p>
        </div>

        <!-- Steps -->
        <div class="relative grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Line (desktop only) -->
            <div class="hidden lg:block absolute top-[2.75rem] left-[12%] right-[12%] border-t-2 border-dashed border-white/15"></div>

            @foreach ($steps as $i => $step)
                <div data-aos="fade-up" data-aos-delay="{{ $i * 150 }}"
                    class="relative group text-center p-7 rounded-3xl bg-white/[0.06] border border-white/10 backdrop-blur-md transition hover:bg-white/[0.1] hover:-translate-y-1">

                    <!-- Icon -->
                    <div class="relative w-14 h-14 mx-auto mb-5">
                        <div class="w-14 h-14 flex items-center justify-center rounded-2xl text-xl shadow-lg shadow-brand-600/40 transition group-hover:scale-110"
                            style="background: var(--gradient-brand);">
                            <i class="{{ $step['icon'] }}"></i>
                        </div>
                        <span class="absolute -top-2 -right-2 w-6 h-6 rounded-full flex items-center justify-center text-[11px] font-extrabold"
                            style="background: var(--color-secondary); color: var(--color-dark);">{{ $i + 1 }}</span>
                    </div>

                    <h3 class="font-bold text-lg">{{ $step['title'] }}</h3>
                    <p class="text-sm text-white/65 mt-2">
                        {{ $step['text'] }}
                    </p>
                </div>
            @endforeach

        </div>

    </div>

</section>

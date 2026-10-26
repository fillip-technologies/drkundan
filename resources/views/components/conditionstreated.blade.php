@php
    $conditionGroups = [
        [
            'title' => 'Brain Conditions',
            'conditions' => [
                ['title' => 'Brain Tumour', 'icon' => 'fa-solid fa-brain', 'description' => 'Assessment of brain tumours using symptoms, examination and scan findings.'],
                ['title' => 'Brain Injury / Trauma', 'icon' => 'fa-solid fa-head-side-virus', 'description' => 'Review after an injury to the head or brain.'],
                ['title' => 'Brain Haemorrhage', 'icon' => 'fa-solid fa-droplet', 'description' => 'Evaluation of bleeding in or around the brain.'],
                ['title' => 'Hydrocephalus', 'icon' => 'fa-solid fa-water', 'description' => 'Assessment of excess fluid build-up in the brain.'],
                ['title' => 'Epilepsy', 'icon' => 'fa-solid fa-bolt', 'description' => 'Review of seizures and related test results.'],
                ['title' => 'Tremor', 'icon' => 'fa-solid fa-hand', 'description' => 'Assessment of shaking movements and possible causes.'],
            ],
        ],
        [
            'title' => 'Spine, Nerve & Related Conditions',
            'conditions' => [
                ['title' => 'Slipped Disc', 'icon' => 'fa-solid fa-link', 'description' => 'Assessment of disc problems that may press on nearby nerves.'],
                ['title' => 'Neck & Lower-Back Pain', 'icon' => 'fa-solid fa-person-circle-exclamation', 'description' => 'Evaluation of persistent or troubling neck and lower-back pain.'],
                ['title' => 'Tingling / Pins and Needles', 'icon' => 'fa-solid fa-wave-square', 'description' => 'Review of tingling or altered sensation in the limbs.'],
                ['title' => 'Sciatica', 'icon' => 'fa-solid fa-bolt', 'description' => 'Assessment of pain that travels from the lower back into the leg.'],
                ['title' => 'Cervical & Lumbar Spondylosis', 'icon' => 'fa-solid fa-bone', 'description' => 'Evaluation of age-related changes in the neck or lower spine.'],
                ['title' => 'Spine Injury / Trauma', 'icon' => 'fa-solid fa-person-falling', 'description' => 'Review of injuries affecting the spine and nearby nerves.'],
                ['title' => 'Spine Tumour', 'icon' => 'fa-solid fa-ribbon', 'description' => 'Assessment of tumours affecting the spine or spinal cord.'],
                ['title' => 'Cauda Equina Syndrome', 'icon' => 'fa-solid fa-kit-medical', 'description' => 'Urgent assessment of symptoms affecting nerves at the base of the spine.'],
                ['title' => 'Quadriplegia / Quadriparesis', 'icon' => 'fa-solid fa-wheelchair', 'description' => 'Evaluation of weakness or paralysis affecting all four limbs.'],
                ['title' => 'Paraplegia / Paraparesis', 'icon' => 'fa-solid fa-wheelchair-move', 'description' => 'Evaluation of weakness or paralysis affecting the legs.'],
                ['title' => 'Rigidity / Spasticity', 'icon' => 'fa-solid fa-person', 'description' => 'Assessment of muscle stiffness, tightness or spasms.'],
                ['title' => 'Bowel & Bladder Control Problems', 'icon' => 'fa-solid fa-toilet', 'description' => 'Review of control changes that may be linked to nerve or spine conditions.'],
            ],
        ],
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
                Conditions We Treat
            </h2>
            <p class="text-slate-500 mt-3">
                Neurosurgical assessment and management depend on clinical evaluation; not every condition requires surgery.
            </p>
        </div>

        <!-- Grid -->
        @foreach ($conditionGroups as $group)
            <div class="mb-12 last:mb-0" data-aos="fade-up">
                <h3 class="text-2xl font-bold mb-6" style="color: var(--color-dark);">{{ $group['title'] }}</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6">
                    @foreach ($group['conditions'] as $condition)
                        <article class="group flex items-start gap-4 p-5 sm:p-6 rounded-2xl border border-slate-100 bg-white transition-all duration-300 hover:-translate-y-1 hover:border-transparent hover:shadow-[0_20px_50px_-12px_rgba(61,90,254,0.2)]">
                            <div class="relative w-11 h-11 flex items-center justify-center rounded-xl shrink-0 text-lg overflow-hidden bg-brand-50 text-brand-600 group-hover:text-white transition-colors">
                                <span class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity" style="background: var(--gradient-brand);"></span>
                                <i class="relative {{ $condition['icon'] }}" aria-hidden="true"></i>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-base leading-snug" style="color: var(--color-dark);">{{ $condition['title'] }}</h4>
                                <p class="text-sm text-slate-500 mt-1.5 leading-relaxed">{{ $condition['description'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endforeach

        <!-- Helper Text -->
        <div class="mt-14 flex flex-col md:flex-row items-center justify-between gap-6 rounded-3xl p-8 md:px-10"
            style="background: var(--color-light);" data-aos="fade-up">
            <div class="text-center md:text-left">
                <p class="text-lg font-bold" style="color: var(--color-dark);">
                    Not sure which condition matches your symptoms?
                </p>
                <p class="text-slate-500 mt-1 max-w-2xl">
                    If you're experiencing symptoms related to any of these conditions, consult with Dr. Kundan Kumar for
                    clinical assessment and guidance about suitable next steps.
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

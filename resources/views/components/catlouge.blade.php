{{--
    Homepage services section. Featured specialities and the category links come from
    resources/data/services/catalog.json ("homepage"), so this matches the header menus.
--}}
@inject('catalog', 'App\Support\ServiceCatalog')

@php
    $featured = $catalog->featured();
    $categories = $catalog->featuredCategories();
    $specialities = $catalog->category('specialities');
    $painService = $catalog->find('spine-pain');
@endphp

<section style="background: var(--color-light);" class="px-6 py-24">
<div class="max-w-7xl mx-auto">

    <!-- Heading -->
    <div class="text-center mb-16" data-aos="fade-up">
        <span class="inline-block text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4"
            style="background: var(--color-soft); color: var(--color-primary);">
            Our Services
        </span>
        <h2 class="text-4xl font-extrabold mb-3" style="color: var(--color-dark);">
            Specialities &amp; Services
        </h2>
        <p class="max-w-xl mx-auto text-base" style="color: rgba(var(--dark-rgb),0.6);">
            {{ $specialities['description'] ?? 'Precision-driven care for brain, spine, and nerve disorders' }}
        </p>
    </div>

    <!-- Featured specialities -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($featured as $i => $entry)
            {{-- The third card keeps the section's dark featured style. --}}
            @php $dark = $i === 2; @endphp
            <article data-aos="fade-up" data-aos-delay="{{ $i * 100 }}"
                class="group relative flex flex-col rounded-2xl p-6 overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                style="{{ $dark ? 'background: var(--color-dark); border: 1px solid rgba(255,255,255,0.06);' : 'background: white; border: 1px solid rgba(var(--primary-rgb),0.1);' }}">
                <div class="absolute top-0 left-0 right-0 h-1 rounded-t-2xl"
                    style="background: linear-gradient(to right, {{ $dark ? 'var(--color-secondary), var(--color-primary)' : 'var(--color-primary), var(--color-secondary)' }});"></div>
                @if ($dark)
                    <div class="absolute -bottom-8 -right-8 w-32 h-32 rounded-full opacity-10" style="background: var(--color-secondary);"></div>
                @endif

                <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5 text-lg transition-transform duration-300 group-hover:scale-110"
                    style="{{ $dark ? 'background: rgba(var(--secondary-rgb),0.15); color: var(--color-secondary);' : 'background: var(--color-soft); color: var(--color-primary);' }}">
                    <i class="{{ $entry['icon'] }}" aria-hidden="true"></i>
                </div>
                <h3 class="text-base font-bold mb-2 {{ $dark ? 'text-white' : '' }}" @unless ($dark) style="color: var(--color-dark);" @endunless>
                    {{ $entry['title'] }}
                </h3>
                <p class="text-sm mb-5 flex-1" style="color: {{ $dark ? 'rgba(var(--light-rgb),0.65)' : 'rgba(var(--dark-rgb),0.6)' }};">
                    {{ $entry['shortDescription'] }}
                </p>
                <a href="{{ $catalog->url($entry) }}"
                    class="inline-flex items-center gap-1 text-sm font-semibold transition-all group-hover:gap-2 after:absolute after:inset-0"
                    style="color: {{ $dark ? 'var(--color-secondary)' : 'var(--color-primary)' }};">
                    View Details<span class="sr-only">: {{ $entry['title'] }}</span>
                    <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i>
                </a>
            </article>
        @endforeach

        @if ($painService && $painService['isPublished'])
            <article data-aos="fade-up" data-aos-delay="{{ count($featured) * 100 }}"
                class="group relative flex flex-col rounded-2xl p-6 overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl bg-white"
                style="border: 1px solid rgba(var(--primary-rgb),0.1);">
                <div class="absolute top-0 left-0 right-0 h-1 rounded-t-2xl"
                    style="background: linear-gradient(to right, var(--color-primary), var(--color-secondary));"></div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5 text-lg"
                    style="background: var(--color-soft); color: var(--color-primary);">
                    <i class="fa-solid fa-notes-medical" aria-hidden="true"></i>
                </div>
                <h3 class="text-base font-bold mb-2" style="color: var(--color-dark);">Pain Management</h3>
                <p class="text-sm mb-5 flex-1" style="color: rgba(var(--dark-rgb),0.6);">
                    Assessment and care for spine and nerve related pain, guided by clinical evaluation.
                </p>
                <a href="{{ $catalog->url($painService) }}"
                    class="inline-flex items-center gap-1 text-sm font-semibold transition-all group-hover:gap-2 after:absolute after:inset-0"
                    style="color: var(--color-primary);">
                    View Details<span class="sr-only">: Pain Management</span>
                    <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i>
                </a>
            </article>
        @endif

        <!-- Booking card -->
        <div data-aos="fade-up" data-aos-delay="{{ count($featured) * 100 }}"
            class="group relative flex flex-col rounded-2xl p-6 overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
            style="background: var(--color-primary); border: 1px solid rgba(var(--primary-rgb),0.2);">
            <div class="absolute -bottom-8 -right-8 w-36 h-36 rounded-full opacity-10" style="background: white;"></div>

            <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5 text-lg text-white transition-transform duration-300 group-hover:scale-110"
                style="background: rgba(255,255,255,0.15);">
                <i class="fa-solid fa-user-doctor" aria-hidden="true"></i>
            </div>
            <h3 class="text-base font-bold mb-2 text-white">Not sure which service you need?</h3>
            <p class="text-sm mb-5 flex-1" style="color: rgba(var(--light-rgb),0.8);">
                Book a consultation and the doctor will advise the right care for your symptoms.
            </p>
            <div>
                <x-cta.book-appointment variant="light" size="sm" class="relative" />
            </div>
        </div>

    </div>

    <!-- Other menu categories -->
    @if ($categories)
        <div class="mt-10 grid md:grid-cols-3 gap-4" data-aos="fade-up">
            @foreach ($categories as $category)
                <a href="{{ route('services.index') }}#{{ $category['id'] }}"
                    class="group flex items-center gap-4 rounded-2xl bg-white p-5 border transition hover:-translate-y-0.5 hover:shadow-lg"
                    style="border-color: rgba(var(--primary-rgb),0.1);">
                    <span class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 text-white shadow-lg shadow-brand-600/25"
                        style="background: var(--gradient-brand);">
                        <i class="{{ $category['icon'] }}" aria-hidden="true"></i>
                    </span>
                    <span class="min-w-0 flex-1">
                        <span class="block font-bold" style="color: var(--color-dark);">{{ $category['label'] }}</span>
                        <span class="block text-sm" style="color: rgba(var(--dark-rgb),0.6);">{{ $category['count'] }} {{ $category['countLabel'] ?? 'pages' }}</span>
                    </span>
                    <i class="fa-solid fa-arrow-right text-sm transition-transform group-hover:translate-x-1" style="color: var(--color-primary);" aria-hidden="true"></i>
                </a>
            @endforeach
        </div>
    @endif

    <div class="mt-10 text-center" data-aos="fade-up">
        <a href="{{ route('services.index') }}"
            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold text-white shadow-lg shadow-brand-600/30 transition hover:-translate-y-0.5"
            style="background: var(--gradient-brand);">
            View All Services <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i>
        </a>
    </div>

</div>
</section>

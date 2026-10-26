<section class="px-6 py-24" style="background: var(--color-light);">
    <div class="max-w-7xl mx-auto">

        <!-- Heading -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4"
                style="background: var(--color-soft); color: var(--color-primary);">
                Our Locations
            </span>
            <h2 class="text-4xl font-extrabold mb-3" style="color: var(--color-dark);">
                Patna Clinic
            </h2>
            <p class="max-w-xl mx-auto text-base" style="color: rgba(var(--dark-rgb),0.6);">
                Serving patients across Bihar — visit us at a clinic near you
            </p>
        </div>

        <!-- Cards Grid -->
        <div class="grid gap-8 max-w-2xl mx-auto">

            <!-- Patna -->
            <div data-aos="fade-up" data-aos-delay="0"
                class="group relative rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                style="background: white; border: 1px solid rgba(var(--primary-rgb),0.12);">

                <!-- Top accent -->
                <div class="h-1.5 w-full"
                    style="background: linear-gradient(to right, var(--color-primary), var(--color-secondary));"></div>

                <div class="p-8 space-y-6">

                    <!-- City Badge -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0"
                                style="background: var(--color-soft);">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" style="color: var(--color-primary);" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M9 10h.01M15 10h.01" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-lg font-extrabold" style="color: var(--color-dark);">Patna</p>
                                <p class="text-xs font-semibold uppercase tracking-wide"
                                    style="color: var(--color-primary);">Clinic</p>
                            </div>
                        </div>
                        <span class="flex items-center gap-1.5 text-xs font-semibold px-3 py-1 rounded-full"
                            style="background: var(--color-soft); color: var(--color-primary);">
                            <span class="w-1.5 h-1.5 rounded-full inline-block" style="background: #22c55e;"></span>
                            Open Now
                        </span>
                    </div>

                    <!-- Divider -->
                    <div class="border-t" style="border-color: rgba(var(--primary-rgb),0.08);"></div>

                    <!-- Info -->
                    <div class="space-y-4">

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5"
                                style="background: var(--color-soft);">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" style="color: var(--color-primary);" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M17.657 16.657L13.414 20.9a2 2 0 0 1-2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0zM15 11a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold uppercase tracking-wide mb-0.5"
                                    style="color: var(--color-primary);">Address</p>
                                <p class="text-sm" style="color: var(--color-dark);">{{ $site->address() }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5"
                                style="background: var(--color-soft);">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" style="color: var(--color-primary);" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M12 6v6l4 2m5-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold uppercase tracking-wide mb-0.5"
                                    style="color: var(--color-primary);">Timing</p>
                                <p class="text-sm" style="color: var(--color-dark);">5:00 PM – 8:00 PM</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5"
                                style="background: var(--color-soft);">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" style="color: var(--color-primary);" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold uppercase tracking-wide mb-0.5"
                                    style="color: var(--color-primary);">Contact</p>
                                <p class="text-sm" style="color: var(--color-dark);">{{ $site->phoneDisplay() }}</p>
                            </div>
                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3 pt-2">
                        <a href="{{ $site->whatsappUrl() }}"
                            class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-semibold text-white transition hover:-translate-y-0.5"
                            style="background: var(--color-primary);">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Call Now
                        </a>
                        <a href="{{ $site->mapUrl() }}" target="_blank"
                            class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-semibold transition hover:-translate-y-0.5"
                            style="background: var(--color-soft); color: var(--color-primary); border: 1px solid rgba(var(--primary-rgb),0.15);">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M17.657 16.657L13.414 20.9a2 2 0 0 1-2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0zM15 11a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            </svg>
                            Get Directions
                        </a>
                    </div>

                </div>
            </div>

    </div>
</section>

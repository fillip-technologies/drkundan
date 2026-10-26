<section id="location" class="scroll-mt-20 py-24 bg-white">

    <div class="max-w-7xl mx-auto px-6">

        <!-- Heading -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4"
                style="background: var(--color-soft); color: var(--color-primary);">
                Visit Us
            </span>
            <h2 class="text-4xl font-extrabold" style="color: var(--color-dark);">
                Get Expert Neurosurgical Care
            </h2>
            <p class="text-slate-500 mt-3">
                Visit us at our conveniently located clinic in Patna
            </p>
        </div>

        <!-- Main Grid -->
        <div class="grid lg:grid-cols-2 gap-8 items-stretch">

            <!-- LEFT - Google Map -->
            <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-100 min-h-[450px]" data-aos="fade-up"
                data-aos-delay="0">
                <iframe src="{{ $site->mapEmbedUrl() }}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
            </div>

            <!-- RIGHT - Address & Timings -->
            <div class="space-y-6" data-aos="fade-up" data-aos-delay="100">

                <!-- Address Section -->
                <div class="p-7 rounded-3xl border border-brand-100" style="background: var(--color-light);">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 text-white rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-brand-600/30"
                            style="background: var(--gradient-brand);">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-2" style="color: var(--color-dark);">Clinic Address</h3>
                            <p class="text-slate-600 leading-relaxed">
                                <strong style="color: var(--color-dark);">DR KUNDAN</strong> <br>
                                {{ $site->address() }}
                            </p>
                            <a href="{{ $site->telUrl() }}"
                                class="inline-flex items-center gap-2 mt-4 font-semibold text-brand-600 hover:text-brand-700">
                                <i class="fa-solid fa-phone text-sm"></i> {{ $site->phoneDisplay() }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- OPD Timings -->
                <div class="p-7 rounded-3xl bg-white border border-slate-100 shadow-[0_10px_40px_-15px_rgba(11,20,55,0.15)]">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0 bg-brand-50 text-brand-600">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div class="w-full">
                            <h3 class="text-xl font-bold mb-4" style="color: var(--color-dark);">OPD Timings</h3>

                            <!-- Timing Grid -->
                            <div class="divide-y divide-slate-100">
                                <div class="flex justify-between items-center py-3">
                                    <span class="text-slate-600 font-medium">Consultation</span>
                                    <span class="font-semibold" style="color: var(--color-dark);">5:00 PM - 8:00 PM</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Quick Contact -->
                <div class="relative overflow-hidden text-white p-7 rounded-3xl" style="background: var(--gradient-hero);">
                    <p class="text-lg font-bold mb-4">Call the Clinic</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ $site->telUrl() }}"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-white font-semibold transition hover:-translate-y-0.5"
                            style="color: var(--color-primary);">
                            <i class="fa-solid fa-phone text-sm"></i> Call Now
                        </a>
                        <a href="{{ $site->mailtoUrl() }}"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-white/10 border border-white/20 font-semibold transition hover:bg-white/15 hover:-translate-y-0.5">
                            <i class="fa-regular fa-envelope text-sm"></i> Email Us
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>

</section>

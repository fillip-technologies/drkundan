<section id="location" class="scroll-mt-20 py-24 bg-white">

    <div class="max-w-7xl mx-auto px-6">

        <!-- Heading -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4"
                style="background: var(--color-soft); color: var(--color-primary);">
                Visit Us
            </span>
            <h2 class="text-4xl font-extrabold" style="color: var(--color-dark);">
                Location & Timing
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
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3631.2519076947615!2d85.1275!3d25.5941!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ed57f12345678%3A0x1234567890abcdef!2sPatna%2C%20Bihar%2C%20India!5e0!3m2!1sen!2sin!4v1234567890"
                    width="100%" height="100%" style="border:0; min-height: 450px;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="w-full h-full">
                </iframe>
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
                                Near Kumhrar, Patna - 800020 <br>
                                Bihar, India
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
                                    <span class="text-slate-600 font-medium">Monday - Friday</span>
                                    <span class="font-semibold" style="color: var(--color-dark);">10:00 AM - 6:00 PM</span>
                                </div>

                                <div class="flex justify-between items-center py-3">
                                    <span class="text-slate-600 font-medium">Saturday</span>
                                    <span class="font-semibold" style="color: var(--color-dark);">10:00 AM - 4:00 PM</span>
                                </div>

                                <div class="flex justify-between items-center py-3">
                                    <span class="text-slate-600 font-medium">Sunday</span>
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-600">Closed</span>
                                </div>
                            </div>

                            <!-- Emergency -->
                            <div class="mt-4 flex items-center gap-3 p-4 rounded-2xl bg-rose-50 border border-rose-100">
                                <span class="relative flex w-2.5 h-2.5">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full w-2.5 h-2.5 bg-rose-500"></span>
                                </span>
                                <p class="text-slate-700">
                                    <span class="font-bold text-rose-600">Emergency:</span> 24/7 Available
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Contact -->
                <div class="relative overflow-hidden text-white p-7 rounded-3xl" style="background: var(--gradient-hero);">
                    <p class="text-lg font-bold mb-4">Need Immediate Assistance?</p>
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

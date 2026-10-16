{{-- Shown only when "features.testimonials" is true in resources/data/site.json. --}}
@if ($site->feature('testimonials'))
<section class="py-24 bg-gradient-to-br from-slate-50 via-white to-brand-50/30 overflow-hidden">

    <div class="max-w-7xl mx-auto px-6">

        <!-- Heading -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span
                class="inline-block text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4 text-brand-600 bg-brand-50">
                Testimonials
            </span>
            <h2
                class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-gray-900 via-brand-800 to-brand-600 bg-clip-text text-transparent">
                What Our Patients Say
            </h2>
            <div class="w-20 h-1 bg-gradient-to-r from-brand-500 to-cyan-400 mx-auto mt-4 rounded-full"></div>
            <p class="text-gray-600 mt-5 max-w-2xl mx-auto text-lg">
                Real experiences from patients who trusted DR KUNDAN for Neuro and Spine care
            </p>
        </div>

        <!-- Testimonials Grid -->
        <div class="grid md:grid-cols-3 gap-8">

            <!-- Card 1 -->
            <div class="group relative bg-white/85 backdrop-blur-sm rounded-3xl p-8 border border-slate-100 shadow-[0_10px_40px_-15px_rgba(11,20,55,0.15)] hover:shadow-2xl transition-all duration-500 hover:-translate-y-2"
                data-aos="fade-up" data-aos-delay="0">
                <div class="absolute top-6 right-6 text-brand-100 group-hover:text-brand-200 transition">
                    <svg class="w-14 h-14" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M7.17 6A5.17 5.17 0 0 0 2 11.17V18h8v-8H6.3A2.3 2.3 0 0 1 8.6 7.7H10V6H7.17Zm10 0A5.17 5.17 0 0 0 12 11.17V18h8v-8h-3.7a2.3 2.3 0 0 1 2.3-2.3H20V6h-2.83Z" />
                    </svg>
                </div>

                <div class="relative">
                    <div class="flex gap-1 text-amber-400 mb-5" aria-label="5 star rating">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                <path d="M10 1.5 12.6 7l6 .8-4.3 4.2 1 6-5.3-2.8L4.7 18l1-6-4.3-4.2 6-.8L10 1.5Z" />
                            </svg>
                        @endfor
                    </div>

                    <p class="text-gray-600 leading-relaxed mb-8">
                        "Dr. Kundan Kumar explained every step clearly. The surgery was successful, recovery was smooth,
                        and the whole team made us feel confident."
                    </p>

                    <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-500 to-brand-600 text-white flex items-center justify-center font-bold shadow-lg shadow-brand-500/25">
                            RK
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Rahul Kumar</h4>
                            <p class="text-sm text-gray-500">Patna</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="group relative bg-white/85 backdrop-blur-sm rounded-3xl p-8 border border-slate-100 shadow-[0_10px_40px_-15px_rgba(11,20,55,0.15)] hover:shadow-2xl transition-all duration-500 hover:-translate-y-2"
                data-aos="fade-up" data-aos-delay="100">
                <div class="absolute top-6 right-6 text-violet-100 group-hover:text-violet-200 transition">
                    <svg class="w-14 h-14" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M7.17 6A5.17 5.17 0 0 0 2 11.17V18h8v-8H6.3A2.3 2.3 0 0 1 8.6 7.7H10V6H7.17Zm10 0A5.17 5.17 0 0 0 12 11.17V18h8v-8h-3.7a2.3 2.3 0 0 1 2.3-2.3H20V6h-2.83Z" />
                    </svg>
                </div>

                <div class="relative">
                    <div class="flex gap-1 text-amber-400 mb-5" aria-label="5 star rating">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                <path d="M10 1.5 12.6 7l6 .8-4.3 4.2 1 6-5.3-2.8L4.7 18l1-6-4.3-4.2 6-.8L10 1.5Z" />
                            </svg>
                        @endfor
                    </div>

                    <p class="text-gray-600 leading-relaxed mb-8">
                        "Very professional and caring treatment. I felt safe throughout my care journey and received
                        clear guidance at every visit."
                    </p>

                    <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-violet-500 to-violet-600 text-white flex items-center justify-center font-bold shadow-lg shadow-violet-500/25">
                            SS
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Sneha Singh</h4>
                            <p class="text-sm text-gray-500">Gaya</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="group relative bg-white/85 backdrop-blur-sm rounded-3xl p-8 border border-slate-100 shadow-[0_10px_40px_-15px_rgba(11,20,55,0.15)] hover:shadow-2xl transition-all duration-500 hover:-translate-y-2"
                data-aos="fade-up" data-aos-delay="200">
                <div class="absolute top-6 right-6 text-cyan-100 group-hover:text-cyan-200 transition">
                    <svg class="w-14 h-14" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M7.17 6A5.17 5.17 0 0 0 2 11.17V18h8v-8H6.3A2.3 2.3 0 0 1 8.6 7.7H10V6H7.17Zm10 0A5.17 5.17 0 0 0 12 11.17V18h8v-8h-3.7a2.3 2.3 0 0 1 2.3-2.3H20V6h-2.83Z" />
                    </svg>
                </div>

                <div class="relative">
                    <div class="flex gap-1 text-amber-400 mb-5" aria-label="5 star rating">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                <path d="M10 1.5 12.6 7l6 .8-4.3 4.2 1 6-5.3-2.8L4.7 18l1-6-4.3-4.2 6-.8L10 1.5Z" />
                            </svg>
                        @endfor
                    </div>

                    <p class="text-gray-600 leading-relaxed mb-8">
                        "Excellent care and support. The doctor is knowledgeable, polite, and gave us the right
                        treatment with patience."
                    </p>

                    <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-sky-600 text-white flex items-center justify-center font-bold shadow-lg shadow-cyan-500/25">
                            AV
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Amit Verma</h4>
                            <p class="text-sm text-gray-500">Patna</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>
@endif

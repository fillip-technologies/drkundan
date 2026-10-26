@extends('layouts.app')

@section('content')

<section class="relative overflow-hidden" style="background: var(--gradient-hero);">

    <!-- Background -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/scan.png') }}" class="w-full h-full object-cover opacity-[0.12] mix-blend-luminosity"
            alt="">
        <div class="absolute inset-0 bg-grid"></div>
        <!-- Glow -->
        <div class="absolute -top-32 right-0 w-[520px] h-[520px] rounded-full blur-3xl opacity-40 pointer-events-none"
            style="background: var(--color-violet);"></div>
    </div>

    <!-- Content -->
    <div class="relative max-w-7xl mx-auto px-6 lg:px-8 pt-36 pb-32 lg:pt-40 lg:pb-40">

        <div class="grid lg:grid-cols-12 gap-12 items-center">

            <!-- LEFT -->
            <div class="lg:col-span-7 text-white space-y-7" data-aos="fade-up">

                <!-- Badge -->
                <span
                    class="inline-flex items-center gap-2.5 px-4 py-2 text-sm font-medium rounded-full bg-white/10 border border-white/15 backdrop-blur">
                    <span class="relative flex w-2 h-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75"
                            style="background: var(--color-secondary);"></span>
                        <span class="relative inline-flex rounded-full w-2 h-2"
                            style="background: var(--color-secondary);"></span>
                    </span>
                    Consultant Neurosurgeon
                </span>

                <!-- Name -->
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold leading-[1.05]">
                    Dr. Kundan <span class="text-gradient">Kumar</span>
                </h1>

                <!-- Qualification -->
                <p class="text-lg sm:text-xl font-semibold text-brand-200">
                    MBBS, DNB (General Surgery), M.Ch. (Neurosurgery)
                </p>

                <!-- Description -->
                <p class="text-lg text-white/70 max-w-xl leading-relaxed">
                    Providing neurosurgical care for complex brain and spine conditions,
                    with a patient-first approach in Patna.
                </p>

                <!-- CTA -->
                <div class="flex flex-wrap gap-4 pt-1">

                    <!-- Book Appointment -->
                    <a href="{{ $site->bookingUrl() }}"
                        class="group inline-flex items-center gap-2 px-7 py-4 text-base font-semibold rounded-2xl bg-white shadow-xl shadow-black/20 transition hover:-translate-y-0.5"
                        style="color: var(--color-primary);">
                        Book Appointment
                        <i class="fa-solid fa-arrow-right text-sm transition group-hover:translate-x-1"></i>
                    </a>

                    <!-- WhatsApp -->
                    <a href="{{ $site->whatsappUrl() }}"
                        class="inline-flex items-center gap-2.5 px-7 py-4 text-base font-semibold rounded-2xl text-white bg-white/10 border border-white/20 backdrop-blur transition hover:bg-white/15 hover:-translate-y-0.5">
                        <i class="fa-brands fa-whatsapp text-xl" style="color: #25D366;"></i>
                        WhatsApp Now
                    </a>

                </div>

                <!-- Highlights -->
                <ul class="flex flex-wrap gap-x-6 gap-y-2 pt-2 text-sm text-white/75">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-circle-check"
                            style="color: var(--color-secondary);"></i> Brain Surgery</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-circle-check"
                            style="color: var(--color-secondary);"></i> Spine Surgery</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-circle-check"
                            style="color: var(--color-secondary);"></i> Complex Brain &amp; Spine Procedures</li>
                </ul>

            </div>

            <!-- RIGHT IMAGE -->
            <div class="lg:col-span-5 relative hidden lg:block" data-aos="fade-left" data-aos-delay="150">

                <div class="relative rounded-[2rem] p-2 bg-white/10 border border-white/15 backdrop-blur">
                    <img src="{{ asset('images/dr-kundan.jpeg') }}"
                        alt="Dr Kundan Kumar" class="w-full aspect-[4/5] object-cover rounded-[1.6rem]">
                </div>

                <!-- Tag -->
                <div class="absolute -bottom-6 -left-8 flex items-center gap-3 pl-3 pr-5 py-3 rounded-2xl bg-white shadow-2xl">
                    <span class="w-10 h-10 rounded-xl flex items-center justify-center text-white"
                        style="background: var(--gradient-brand);">
                        <i class="fa-solid fa-user-doctor"></i>
                    </span>
                    <span>
                        <span class="block text-sm font-bold" style="color: var(--color-dark);">Consultant
                            Neurosurgeon</span>
                        <span class="block text-xs text-slate-500">{{ $site->address() }}</span>
                    </span>
                </div>

                <!-- Timing chip -->
                <div
                    class="absolute top-8 -right-6 flex items-center gap-2 px-4 py-2.5 rounded-2xl text-sm font-semibold text-white bg-white/15 border border-white/20 backdrop-blur-md shadow-xl">
                    <i class="fa-regular fa-clock" style="color: var(--color-secondary);"></i>
                    Consultation · 5pm – 8pm
                </div>

            </div>

        </div>

    </div>

</section>

<!-- quick trust strip -->
<x-quicktruststrip />



<!-- catlouge -->
<x-catlouge />

<!-- conditions treated -->
<x-conditionstreated />

<x-whysecond />

<x-branches />

<!-- services-->
<x-services />




<!-- howit -->
<x-howit />

<!-- whychooseus-->
<x-whychooseus />

<!-- testimonials -->
<x-testimonials />

<!-- location & timing -->
<x-locationtiming />

<!--faq-->
<x-faq />


@endsection
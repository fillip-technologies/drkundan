@inject('navigation', 'App\Support\Navigation')

@php
    // About Us and Patient Resources menus (config/navigation.php); items without a page are plain text.
    $aboutLinks = $navigation->items('about');
    $patientResources = $navigation->items('patient-resources');
@endphp

<footer class="relative overflow-hidden text-white" style="background: var(--gradient-hero);">

    <div class="absolute inset-0 bg-grid pointer-events-none"></div>

    <!-- CTA band -->
    <div class="relative max-w-7xl mx-auto px-6 pt-16">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 rounded-3xl p-8 md:p-10 bg-white/[0.06] border border-white/10 backdrop-blur">
            <div class="text-center md:text-left">
                <h3 class="text-2xl md:text-3xl font-extrabold">Get in <span class="text-gradient">Touch</span></h3>
                <p class="text-white/65 mt-2">Book your consultation today for expert neurological care.</p>
            </div>
            <div class="flex flex-wrap justify-center gap-3">
                <x-cta.call-clinic variant="none"
                    class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-white/10 border border-white/20 font-semibold transition hover:bg-white/15">
                    <i class="fa-solid fa-phone text-sm"></i> {{ $site->phoneDisplay() }}
                </x-cta.call-clinic>
                <x-cta.book-appointment variant="none"
                    class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl font-semibold bg-white shadow-lg transition hover:-translate-y-0.5"
                    style="color: var(--color-primary);">
                    {{ $site->bookingLabel() }} <i class="fa-solid fa-arrow-right text-sm"></i>
                </x-cta.book-appointment>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="relative max-w-7xl mx-auto px-6 py-16">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-10">

            <!-- Column 1: Doctor Info -->
            <div class="lg:col-span-2 lg:pr-12">
                <div class="flex items-center gap-3 mb-5">
                    <img src="{{ asset('images/dr-kundan-logo.png') }}" alt="Dr. Kundan Kumar logo" class="w-11 h-11 object-contain shrink-0">
                    <h2 class="text-2xl font-bold">{{ $site->displayName() }}</h2>
                </div>

                <p class="text-white/65 mb-6 max-w-md leading-relaxed">
                    Neurosurgeon specializing in brain, spine, and nerve disorders.
                    Providing advanced surgical care with a patient-first approach.
                </p>

                <!-- Contact -->
                <div class="space-y-3 text-white/75 text-sm">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-location-dot w-4" style="color: var(--color-secondary);"></i> {{ $site->address() }}</div>
                    <x-cta.call-clinic variant="none" class="flex items-center gap-3 hover:text-white transition">
                        <i class="fa-solid fa-phone w-4" style="color: var(--color-secondary);"></i> {{ $site->phoneDisplay() }}
                    </x-cta.call-clinic>
                    <x-cta.email-clinic variant="none" class="flex items-center gap-3 hover:text-white transition">
                        <i class="fa-regular fa-envelope w-4" style="color: var(--color-secondary);"></i> {{ $site->email() }}
                    </x-cta.email-clinic>
                </div>
            </div>

            <!-- Column 2: Neurology Services -->
            <div>
                <h3 class="font-bold mb-5 text-sm uppercase tracking-widest" style="color: var(--color-secondary);">Neurology Services</h3>

                <ul class="space-y-3 text-white/70 text-sm">
                    <li>Brain Tumor Surgery</li>
                    <li>Spine Surgery</li>
                    <li>Stroke Management</li>
                    <li>Head Injury Treatment</li>
                    <li>Epilepsy Care</li>
                    <li>Neuro Consultation</li>
                </ul>
            </div>

            <!-- Column 3: Quick Links -->
            <div>
                <h3 class="font-bold mb-5 text-sm uppercase tracking-widest" style="color: var(--color-secondary);">Quick Links</h3>

                <ul class="space-y-3 text-white/70 text-sm flex flex-col items-start">
                    <li><a href="{{ url('/about') }}" class="hover:text-white hover:translate-x-1 transition inline-block">About Us</a></li>
                    <li><a href="{{ url('/services') }}" class="hover:text-white hover:translate-x-1 transition inline-block">Services</a></li>
                    <li><a href="{{ url('/clinics') }}" class="hover:text-white hover:translate-x-1 transition inline-block">Clinics</a></li>
                    <li><a href="{{ url('/contact') }}" class="hover:text-white hover:translate-x-1 transition inline-block">Contact</a></li>
                </ul>

                <!-- Social -->
                <div class="flex gap-2 mt-8">
                    @foreach (['fa-facebook-f', 'fa-instagram', 'fa-youtube', 'fa-linkedin-in'] as $social)
                        <span class="w-9 h-9 rounded-xl flex items-center justify-center bg-white/10 border border-white/10 text-white/75 hover:text-white hover:bg-white/20 transition cursor-pointer">
                            <i class="fab {{ $social }} text-sm"></i>
                        </span>
                    @endforeach
                </div>
            </div>

            <!-- Column 4: About Us -->
            <div>
                <h3 class="font-bold mb-5 text-sm uppercase tracking-widest" style="color: var(--color-secondary);">About Us</h3>

                <ul class="space-y-3 text-white/70 text-sm flex flex-col items-start">
                    @foreach ($aboutLinks as $link)
                        @if ($link['href'])
                            <li><a href="{{ $link['href'] }}" class="hover:text-white hover:translate-x-1 transition inline-block">{{ $link['label'] }}</a></li>
                        @else
                            <li>{{ $link['label'] }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <!-- Column 5: Patient Resources -->
            <div>
                <h3 class="font-bold mb-5 text-sm uppercase tracking-widest" style="color: var(--color-secondary);">Patient Resources</h3>

                <ul class="space-y-3 text-white/70 text-sm flex flex-col items-start">
                    @foreach ($patientResources as $resource)
                        @if ($resource['href'])
                            <li><a href="{{ $resource['href'] }}" class="hover:text-white hover:translate-x-1 transition inline-block">{{ $resource['label'] }}</a></li>
                        @else
                            <li>{{ $resource['label'] }}</li>
                        @endif
                    @endforeach
                </ul>

                <!-- Emergency Guidance -->
                @if ($site->emergencyTelUrl())
                    <div class="mt-6 p-3.5 rounded-xl bg-white/[0.06] border border-white/10 text-xs leading-relaxed text-white/75">
                        <p class="flex items-center gap-2 font-bold text-white">
                            <i class="fa-solid fa-truck-medical text-rose-400" aria-hidden="true"></i> Medical emergency?
                        </p>
                        <p class="mt-1">
                            Call <a href="{{ $site->emergencyTelUrl() }}" class="font-bold text-white underline underline-offset-2">{{ $site->emergencyNumber() }}</a>
                            or go to the nearest emergency department. Do not wait for an appointment.
                        </p>
                    </div>
                @endif
            </div>

        </div>

        <!-- Bottom -->
        <div class="border-t border-white/10 mt-14 pt-6 text-center text-sm text-white/50">
            <p class="mb-2">
                Designed and developed by
                <a href="http://filliptechnologies.com/" target="_blank" rel="noopener noreferrer"
                    class="font-semibold text-white/75 hover:text-white transition-colors">Fillip Technologies</a>
            </p>
            © {{ date('Y') }} {{ $site->displayName() }}. All rights reserved.
        </div>

    </div>

</footer>

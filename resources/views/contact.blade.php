@extends('layouts.app')

@section('title', '| Contact Us')

@section('content')

    {{-- Hero --}}
    <section class="pt-36 pb-16 px-6"
        style="background: var(--gradient-hero);">
        <div class="max-w-4xl mx-auto text-center">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-5"
                style="background: rgba(255,255,255,0.2); color: white;">
                Get In Touch
            </span>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-4">Contact Dr. Kundan Kumar</h1>
            <p class="text-white/80 text-lg max-w-2xl mx-auto">
                Reach out for appointments, second opinions, or emergency consultations. We're here to help you every step
                of the way.
            </p>
        </div>
    </section>

    {{-- Quick Contact Strip --}}
    <section class="py-10 px-6" style="background: var(--color-dark);">
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ $site->telUrl() }}" class="flex items-center gap-4 p-5 rounded-2xl transition hover:-translate-y-1"
                style="background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.08);">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                    style="background: var(--color-primary);">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wide mb-0.5" style="color: var(--color-secondary);">Phone
                    </p>
                    <p class="text-white font-semibold">{{ $site->phoneDisplay() }}</p>
                </div>
            </a>
            <a href="{{ $site->whatsappUrl() }}" target="_blank"
                class="flex items-center gap-4 p-5 rounded-2xl transition hover:-translate-y-1"
                style="background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.08);">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0" style="background: #25D366;">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                        <path
                            d="M12 0C5.373 0 0 5.373 0 12c0 2.117.554 4.107 1.523 5.84L.057 23.5l5.835-1.531A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-4.984-1.365l-.357-.212-3.707.972.99-3.614-.233-.37A9.818 9.818 0 1112 21.818z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wide mb-0.5" style="color: var(--color-secondary);">
                        WhatsApp</p>
                    <p class="text-white font-semibold">{{ $site->phoneDisplay() }}</p>
                </div>
            </a>
            <a href="{{ $site->mailtoUrl() }}"
                class="flex items-center gap-4 p-5 rounded-2xl transition hover:-translate-y-1"
                style="background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.08);">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                    style="background: var(--gradient-brand);">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wide mb-0.5" style="color: var(--color-secondary);">Email
                    </p>
                    <p class="text-white font-semibold">{{ $site->email() }}</p>
                </div>
            </a>
        </div>
    </section>

    {{-- Contact Form + Info --}}
    <section class="py-20 px-6" style="background: var(--color-light);">
        <div class="max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12">

                {{-- LEFT: Appointment request form (sent to the clinic on WhatsApp) --}}
                <div id="book-appointment" class="scroll-mt-28 rounded-3xl p-8 shadow-xl" style="background: white; border: 1px solid rgba(var(--primary-rgb),0.1);">
                    <div class="mb-6">
                        <span class="inline-block text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-3"
                            style="background: var(--color-soft); color: var(--color-primary);">Appointment Request</span>
                        <h2 class="text-2xl font-extrabold" style="color: var(--color-dark);">Book an Appointment</h2>
                        <p class="text-gray-500 text-sm mt-1">Fill in your details below. Your request opens in WhatsApp so you can send it to the clinic.</p>
                    </div>

                    @if ($site->whatsappNumber())
                    <form class="space-y-4" x-data="{
                            name: '', phone: '', email: '', branch: '', message: '', sent: false,
                            send() {
                                const lines = ['Hello, I would like to book an appointment.', 'Name: ' + this.name, 'Phone: ' + this.phone];
                                if (this.email) lines.push('Email: ' + this.email);
                                if (this.branch) lines.push('Preferred clinic: ' + this.branch);
                                if (this.message) lines.push('Note: ' + this.message);
                                window.open(@js('https://wa.me/' . $site->whatsappNumber()) + '?text=' + encodeURIComponent(lines.join('\n')), '_blank', 'noopener');
                                this.sent = true;
                            },
                        }" @submit.prevent="send()">
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label for="appointment-name" class="block text-xs font-bold uppercase tracking-wide mb-1.5"
                                    style="color: var(--color-dark);">Full Name</label>
                                <input id="appointment-name" type="text" name="name" x-model="name" autocomplete="name" placeholder="Your full name" required
                                    class="w-full px-4 py-3 rounded-xl text-sm outline-none transition"
                                    style="background: var(--color-soft); border: 1.5px solid transparent; color: var(--color-dark);"
                                    onfocus="this.style.borderColor='var(--color-primary)'"
                                    onblur="this.style.borderColor='transparent'">
                            </div>
                            <div>
                                <label for="appointment-phone" class="block text-xs font-bold uppercase tracking-wide mb-1.5"
                                    style="color: var(--color-dark);">Phone Number</label>
                                <input id="appointment-phone" type="tel" name="phone" x-model="phone" autocomplete="tel" placeholder="+91 XXXXX XXXXX" required
                                    class="w-full px-4 py-3 rounded-xl text-sm outline-none transition"
                                    style="background: var(--color-soft); border: 1.5px solid transparent; color: var(--color-dark);"
                                    onfocus="this.style.borderColor='var(--color-primary)'"
                                    onblur="this.style.borderColor='transparent'">
                            </div>
                        </div>
                        <div>
                            <label for="appointment-email" class="block text-xs font-bold uppercase tracking-wide mb-1.5"
                                style="color: var(--color-dark);">Email (Optional)</label>
                            <input id="appointment-email" type="email" name="email" x-model="email" autocomplete="email" placeholder="your@email.com"
                                class="w-full px-4 py-3 rounded-xl text-sm outline-none transition"
                                style="background: var(--color-soft); border: 1.5px solid transparent; color: var(--color-dark);"
                                onfocus="this.style.borderColor='var(--color-primary)'"
                                onblur="this.style.borderColor='transparent'">
                        </div>
                        <div>
                            <label for="appointment-branch" class="block text-xs font-bold uppercase tracking-wide mb-1.5"
                                style="color: var(--color-dark);">Preferred Clinic</label>
                            <select id="appointment-branch" name="branch" x-model="branch" class="w-full px-4 py-3 rounded-xl text-sm outline-none transition"
                                style="background: var(--color-soft); border: 1.5px solid transparent; color: var(--color-dark);"
                                onfocus="this.style.borderColor='var(--color-primary)'"
                                onblur="this.style.borderColor='transparent'">
                                <option value="">Select a clinic</option>
                                @foreach ($site->branches() as $branch)
                                    <option>{{ $branch['name'] }}{{ ! empty($branch['opd']) ? ' (' . $branch['opd'] . ')' : '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="appointment-message" class="block text-xs font-bold uppercase tracking-wide mb-1.5"
                                style="color: var(--color-dark);">Preferred Day or Question (Optional)</label>
                            <textarea id="appointment-message" name="message" x-model="message" rows="4" aria-describedby="appointment-privacy"
                                placeholder="For example, a preferred day or time"
                                class="w-full px-4 py-3 rounded-xl text-sm outline-none transition resize-none"
                                style="background: var(--color-soft); border: 1.5px solid transparent; color: var(--color-dark);"
                                onfocus="this.style.borderColor='var(--color-primary)'"
                                onblur="this.style.borderColor='transparent'"></textarea>
                            <p id="appointment-privacy" class="mt-1.5 text-xs text-gray-500">Please don't include detailed medical information. You can discuss your symptoms with the doctor at your appointment.</p>
                        </div>
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 py-3.5 rounded-xl text-white font-bold text-sm tracking-wide transition hover:-translate-y-0.5 hover:shadow-lg"
                            style="background: var(--gradient-brand);">
                            <i class="fa-brands fa-whatsapp text-base" aria-hidden="true"></i> Send Request on WhatsApp
                        </button>
                        <p x-show="sent" style="display: none;" role="status" class="text-sm text-gray-600">
                            WhatsApp should now be open with your request ready to send. If it did not open, you can
                            <a href="{{ $site->telUrl() }}" class="font-semibold underline" style="color: var(--color-primary);">call the clinic</a> instead.
                        </p>
                    </form>
                    @else
                        <p class="text-gray-600">To book an appointment, please call the clinic.</p>
                        <x-cta.call-clinic class="mt-4" :show-number="true" />
                    @endif
                </div>

                {{-- RIGHT: Clinic Info --}}
                <div class="space-y-6">
                    <div>
                        <span class="inline-block text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-3"
                            style="background: var(--color-soft); color: var(--color-primary);">Our Locations</span>
                        <h2 class="text-2xl font-extrabold mb-2" style="color: var(--color-dark);">Visit a Clinic Near You
                        </h2>
                        <p class="text-gray-500 text-sm">Walk-ins welcome, but appointments preferred for better service.
                        </p>
                    </div>

                    {{-- Patna --}}
                    <div class="rounded-2xl p-6 transition hover:-translate-y-1 hover:shadow-lg"
                        style="background: white; border: 1px solid rgba(var(--primary-rgb),0.12);">
                        <div class="h-1.5 w-full rounded-full mb-4"
                            style="background: linear-gradient(to right, var(--color-primary), var(--color-secondary));">
                        </div>
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0"
                                style="background: var(--color-soft);">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" style="color: var(--color-primary);" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-extrabold" style="color: var(--color-dark);">Patna – Main Branch</p>
                                <p class="text-xs" style="color: var(--color-primary);">{{ $branch['address'] }}</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500">⏰ Consultation: 5:00 PM – 8:00 PM</p>
                        <p class="text-sm text-gray-500">📞 {{ $site->phoneDisplay() }}</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Google Map + Emergency CTA --}}
    <section class="py-16 px-6" style="background: var(--color-dark);">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-extrabold text-white mb-3">Need Immediate Help?</h2>
            <p class="text-white/70 mb-8">
                For a life-threatening emergency, call <a href="{{ $site->emergencyTelUrl() }}" class="font-bold text-white underline underline-offset-2">{{ $site->emergencyNumber() }}</a>
                or go to the nearest emergency department. For urgent questions, contact the clinic.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ $site->telUrl() }}"
                    class="px-8 py-4 rounded-xl text-white font-bold text-lg shadow-lg transition hover:-translate-y-1"
                    style="background: var(--gradient-brand);">
                    📞 Call Now: {{ $site->phoneDisplay() }}
                </a>
                <a href="{{ $site->whatsappUrl() }}" target="_blank"
                    class="px-8 py-4 rounded-xl font-bold text-lg transition hover:-translate-y-1"
                    style="background: #25D366; color: white;">
                    💬 WhatsApp Us
                </a>
            </div>
        </div>
    </section>

@endsection

@php
    $faqs = [
        ['q' => 'What services does your hospital provide?', 'a' => 'We provide a wide range of services including diagnostics, emergency care, specialized treatments, and preventive healthcare programs.'],
        ['q' => 'Do you have emergency facilities?', 'a' => 'Yes, our hospital is equipped with 24x7 emergency and trauma care facilities with dedicated doctors and staff.'],
        ['q' => 'How can I book an appointment?', 'a' => 'You can book an appointment online through our website or call our helpline. Walk-ins are also welcome for urgent care.'],
        ['q' => 'Do you accept health insurance?', 'a' => 'Yes, we are partnered with multiple insurance providers and accept most major health insurance policies.'],
    ];
@endphp

<section class="py-24" style="background: var(--color-light);">
    <div class="max-w-3xl mx-auto px-6">

        <div class="text-center mb-12" data-aos="fade-up">
            <span class="inline-block text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4"
                style="background: var(--color-soft); color: var(--color-primary);">
                FAQ
            </span>
            <h2 class="text-4xl font-extrabold" style="color: var(--color-dark);">Frequently Asked Questions</h2>
        </div>

        <div class="space-y-4" x-data="{ active: 0 }">

            @foreach ($faqs as $i => $faq)
                <div class="rounded-2xl bg-white border transition-all duration-300"
                    :class="active === {{ $i }} ? 'border-brand-200 shadow-[0_10px_40px_-15px_rgba(61,90,254,0.3)]' : 'border-slate-100'"
                    data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                    <button class="w-full flex justify-between items-center gap-4 p-5 sm:px-6 text-left font-semibold focus:outline-none"
                        style="color: var(--color-dark);"
                        @click="active = (active === {{ $i }} ? null : {{ $i }})"
                        :aria-expanded="active === {{ $i }}">
                        {{ $faq['q'] }}
                        <span class="w-8 h-8 shrink-0 rounded-full flex items-center justify-center transition-all duration-300"
                            :class="active === {{ $i }} ? 'bg-brand-600 text-white rotate-180' : 'bg-brand-50 text-brand-600'">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>
                    <div x-show="active === {{ $i }}" x-transition.opacity.duration.200ms
                        class="px-5 sm:px-6 pb-5 -mt-1 text-slate-500 leading-relaxed"
                        @if ($i !== 0) style="display: none;" @endif>
                        {{ $faq['a'] }}
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>

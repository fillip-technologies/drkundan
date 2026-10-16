<!DOCTYPE html>
<html lang="en" class="overflow-x-hidden scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $site->displayName() }} @yield('title')</title>
    @hasSection('meta_description')
        <meta name="description" content="@yield('meta_description')">
    @endif
    <link rel="canonical" href="@yield('canonical', url()->current())">
    @stack('head')

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        // Brand scale (royal blue). `teal-*` classes were migrated to `brand-*`.
                        brand: {
                            50: '#EEF2FF',
                            100: '#E0E7FF',
                            200: '#C3CEFF',
                            300: '#9DAEFF',
                            400: '#6F86FF',
                            500: '#4D68FF',
                            600: '#3D5AFE',
                            700: '#2B3FD6',
                            800: '#2333A8',
                            900: '#1E2C80',
                            950: '#0B1437',
                        },
                    },
                },
            },
        };
    </script>

    {{-- Alpine.js (for dropdowns, toggles, etc.) --}}
    <script defer src="https://unpkg.com/alpinejs@3.14.1/dist/cdn.min.js"></script>

    {{-- AOS (scroll animations) --}}
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    {{-- Your custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="icon" type="image/webp" href="{{ asset('images/skyhooks-logo.webp') }}">


    <style>
        :root {
            /* PRIMARY BRAND (royal blue) */
            --color-primary: #3D5AFE;
            --primary-rgb: 61, 90, 254;
            --color-primary-dark: #2B3FD6;

            /* SECONDARY (electric cyan — highlights on dark surfaces, decorative accents) */
            --color-secondary: #22D3EE;
            --secondary-rgb: 34, 211, 238;

            /* VIOLET (gradient partner for primary) */
            --color-violet: #6A4DF4;

            /* DARK TEXT / BASE (deep navy) */
            --color-dark: #0B1437;
            --dark-rgb: 11, 20, 55;

            /* LIGHT BACKGROUND */
            --color-light: #F5F7FF;
            --light-rgb: 245, 247, 255;

            /* SOFT TINT */
            --color-soft: #EAEFFF;

            /* WARM ACCENT (ratings, highlights) */
            --color-accent: #FFB547;

            /* GRADIENTS */
            --gradient-brand: linear-gradient(135deg, var(--color-primary) 0%, var(--color-violet) 100%);
            --gradient-hero: radial-gradient(1200px 600px at 85% -10%, rgba(var(--primary-rgb), 0.55), transparent 60%),
                radial-gradient(800px 500px at 0% 110%, rgba(var(--secondary-rgb), 0.18), transparent 60%),
                linear-gradient(135deg, #0B1437 0%, #131F5C 55%, #1E2C80 100%);
            --gradient-text: linear-gradient(90deg, #8FA2FF 0%, var(--color-secondary) 100%);
        }

        body {
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1, h2, h3 {
            letter-spacing: -0.02em;
        }

        ::selection {
            background: rgba(var(--primary-rgb), 0.18);
        }

        /* Gradient-filled text for highlighted words in headings */
        .text-gradient {
            background: var(--gradient-text);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .text-gradient-brand {
            background: var(--gradient-brand);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* Subtle dotted grid used behind dark sections */
        .bg-grid {
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 22px 22px;
        }

        [data-aos] {
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>



</head>

<body class="font-sans text-slate-700 bg-white overflow-x-clip w-full">

    {{-- Include Header --}}
    @include('components.header')

    {{-- Page Content --}}
    <main class="min-h-screen ">
        @yield('content')
    </main>

    {{-- Include Footer --}}
    @include('components.footer')

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 60
        });
    </script>

    {{-- Your custom JS --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>

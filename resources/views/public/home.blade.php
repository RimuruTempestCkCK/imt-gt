@php
    use Illuminate\Support\HtmlString;

    $isEnglish = app()->isLocale('en');

    $translateValue = function (?string $value, array $map): ?string {
        if (! is_string($value) || $value === '') {
            return $value;
        }

        return $map[$value] ?? $value;
    };

    $heroTitle = data_get($siteSettings ?? [], 'hero_title', "Menghubungkan Potensi Indonesia IMT-GT dengan Kolaborasi Bisnis Regional.");
    $heroSubtitle = data_get($siteSettings ?? [], 'hero_subtitle', 'Portal resmi untuk informasi perdagangan, investasi, UMKM, dan kerja sama kawasan IMT-GT.');

    if ($isEnglish) {
        $heroTitle = $translateValue($heroTitle, [
            'Menghubungkan Potensi Indonesia IMT-GT dengan Kolaborasi Bisnis Regional.' => 'Connecting Indonesia IMT-GT Potential with Regional Business Collaboration.',
            'Portal resmi yang merangkum program, promosi kawasan, dan peluang kerja sama internasional.' => 'The official portal that brings together programs, regional promotion, and international collaboration opportunities.',
        ]);

        $heroSubtitle = $translateValue($heroSubtitle, [
            'Portal resmi untuk informasi perdagangan, investasi, UMKM, dan kerja sama kawasan IMT-GT.' => 'The official portal for trade, investment, MSMEs, and IMT-GT regional cooperation information.',
            'Dirancang untuk membantu pengunjung memahami siapa Indonesia IMT-GT, apa yang sedang dikerjakan, dan ke mana arah peluang perdagangan, investasi, pariwisata, serta penguatan UMKM kawasan.' => 'Designed to help visitors understand who Indonesia IMT-GT is, what it is working on, and where trade, investment, tourism, and regional MSME opportunities are heading.',
        ]);
    }

    $illustration = function (string $theme, string $class = 'h-full w-full') {
        $palettes = [
            'hero' => ['#0f172a', '#1d4ed8', '#22d3ee', '#fde68a'],
            'news' => ['#082f49', '#0ea5e9', '#facc15', '#f8fafc'],
            'agenda' => ['#052e16', '#16a34a', '#f0fdf4', '#facc15'],
            'profile' => ['#312e81', '#38bdf8', '#e0e7ff', '#f9a8d4'],
            'product' => ['#451a03', '#f59e0b', '#fef3c7', '#fb7185'],
            'service' => ['#083344', '#14b8a6', '#ccfbf1', '#fef08a'],
            'map' => ['#164e63', '#06b6d4', '#cffafe', '#f0abfc'],
            'contact' => ['#111827', '#2563eb', '#dbeafe', '#fdba74'],
        ];

        [$base, $accent, $soft, $pop] = $palettes[$theme] ?? $palettes['hero'];

        return new HtmlString(
            <<<HTML
            <svg viewBox="0 0 320 220" fill="none" xmlns="http://www.w3.org/2000/svg" class="$class" aria-hidden="true">
                <rect width="320" height="220" rx="28" fill="$base"/>
                <circle cx="255" cy="50" r="52" fill="$accent" fill-opacity="0.22"/>
                <circle cx="60" cy="180" r="70" fill="$soft" fill-opacity="0.12"/>
                <rect x="28" y="30" width="124" height="18" rx="9" fill="$soft" fill-opacity="0.88"/>
                <rect x="28" y="58" width="88" height="12" rx="6" fill="white" fill-opacity="0.45"/>
                <rect x="28" y="82" width="170" height="86" rx="22" fill="white" fill-opacity="0.09"/>
                <path d="M220 94c13 0 24 11 24 24v44H196v-44c0-13 11-24 24-24Z" fill="$accent"/>
                <circle cx="220" cy="84" r="18" fill="$soft"/>
                <path d="M69 120c18 0 32 14 32 32v16H37v-16c0-18 14-32 32-32Z" fill="$pop"/>
                <circle cx="69" cy="105" r="15" fill="$soft"/>
                <rect x="168" y="34" width="92" height="14" rx="7" fill="white" fill-opacity="0.22"/>
                <rect x="168" y="56" width="64" height="10" rx="5" fill="white" fill-opacity="0.18"/>
                <path d="M132 174h132" stroke="white" stroke-opacity="0.16" stroke-width="8" stroke-linecap="round"/>
                <path d="M148 192h78" stroke="$pop" stroke-width="10" stroke-linecap="round"/>
                <circle cx="265" cy="168" r="17" fill="$pop"/>
            </svg>
            HTML
        );
    };

    $heroSlides = collect($banners ?? [])->values()->map(function ($banner, $index) {
        $themes = ['hero', 'profile', 'product'];

        return [
            'eyebrow' => __('ui.home.active_banner'),
            'title' => $banner->title,
            'subtitle' => $banner->subtitle,
            'theme' => $themes[$index % count($themes)],
            'image' => $banner->media?->source_url,
        ];
    })->all();

    if ($isEnglish) {
        $heroSlides = collect($heroSlides)->map(function (array $slide) use ($translateValue) {
            $slide['title'] = $translateValue($slide['title'], [
                'Gateway Perdagangan Regional' => 'Regional Trade Gateway',
                'Forum Investasi dan Logistik' => 'Investment and Logistics Forum',
                'Showcase UMKM Unggulan' => 'Flagship MSME Showcase',
            ]);
            $slide['subtitle'] = $translateValue($slide['subtitle'], [
                'Mendorong koneksi dagang, investasi, dan promosi kawasan secara terstruktur.' => 'Driving trade connections, investment, and regional promotion in a structured way.',
                'Menyatukan agenda prioritas lintas negara dalam satu ruang promosi.' => 'Bringing cross-country priority agendas into one promotional space.',
                'Mempersiapkan etalase produk unggulan dan peluang business matching.' => 'Preparing a showcase for flagship products and business matching opportunities.',
            ]);

            return $slide;
        })->all();
    }

    if ($heroSlides === []) {
        $heroSlides = trans('ui.home.hero_slides');
    }

    $headlineNews = collect($featuredNews ?? [])->map(function ($item) {
        return [
            'tag' => $item->category?->name ?? 'Berita',
            'title' => $item->title,
            'meta' => optional($item->published_at)->format('d M Y') ?: 'Draft',
        ];
    })->all();

    if ($isEnglish) {
        $headlineNews = collect($headlineNews)->map(function (array $item) use ($translateValue) {
            $item['tag'] = $translateValue($item['tag'], [
                'Kerja Sama' => 'Cooperation',
                'Program' => 'Programs',
                'UMKM' => 'MSMEs',
                'Berita' => 'News',
            ]);
            $item['title'] = $translateValue($item['title'], [
                'IMT-GT BC Indonesia membuka promosi investasi kawasan semester II 2026' => 'IMT-GT BC Indonesia launches regional investment promotion for the second semester of 2026',
                'Forum perdagangan lintas batas mempertemukan pemerintah dan pelaku usaha' => 'Cross-border trade forum brings together government and business actors',
                'Kurasi produk unggulan ekspor menargetkan sektor pangan dan kriya' => 'Export flagship product curation targets food and craft sectors',
            ]);

            return $item;
        })->all();
    }

    if ($headlineNews === []) {
        $headlineNews = trans('ui.home.headline_fallback');
    }

    $upcomingAgenda = trans('ui.home.upcoming_agenda');

    $profileCards = collect($profileSections ?? [])->map(function ($section) {
        return [
            'key' => $section->section_key,
            'title' => $section->title,
            'text' => $section->summary ?: \Illuminate\Support\Str::limit(strip_tags($section->body), 170),
        ];
    })->all();

    if ($isEnglish) {
        $profileCards = collect($profileCards)->map(function (array $card) {
            $byKey = [
                'sejarah' => ['title' => 'History', 'text' => 'Institutional background'],
                'visi' => ['title' => 'Vision', 'text' => 'Long-term direction'],
                'misi' => ['title' => 'Mission', 'text' => 'Service strengthening focus'],
                'mitra' => ['title' => 'Partners & Network', 'text' => 'Cross-stakeholder cooperation'],
            ];

            if (isset($byKey[$card['key'] ?? ''])) {
                $card['title'] = $byKey[$card['key']]['title'];
                $card['text'] = $byKey[$card['key']]['text'];
            }

            return $card;
        })->all();
    }

    if ($profileCards === []) {
        $profileCards = trans('ui.home.profile_cards');
    }

    $leaders = $isEnglish
        ? [
            ['name' => 'Dr. Arya Pratama', 'role' => 'Advisor', 'accent' => 'from-cyan-400 to-blue-500'],
            ['name' => 'Maya Lestari, SE', 'role' => 'Head of Secretariat', 'accent' => 'from-emerald-400 to-teal-500'],
            ['name' => 'Rizki Andhika', 'role' => 'Program Coordinator', 'accent' => 'from-amber-400 to-orange-500'],
            ['name' => 'Nadia Putri', 'role' => 'Promotion Coordinator', 'accent' => 'from-fuchsia-400 to-rose-500'],
        ]
        : [
            ['name' => 'Dr. Arya Pratama', 'role' => 'Pembina', 'accent' => 'from-cyan-400 to-blue-500'],
            ['name' => 'Maya Lestari, SE', 'role' => 'Kepala Secretariat', 'accent' => 'from-emerald-400 to-teal-500'],
            ['name' => 'Rizki Andhika', 'role' => 'Koordinator Program', 'accent' => 'from-amber-400 to-orange-500'],
            ['name' => 'Nadia Putri', 'role' => 'Koordinator Promosi', 'accent' => 'from-fuchsia-400 to-rose-500'],
        ];

    $projects = $isEnglish
        ? [
            ['title' => 'Cross-Border Trade', 'copy' => 'Supply chain consolidation, logistics, and regional market promotion.'],
            ['title' => 'Integrated Tourism', 'copy' => 'Destination narratives, events, and creative economy connectivity.'],
            ['title' => 'Priority Investment', 'copy' => 'A list of flagship projects and strategic partnership opportunities.'],
            ['title' => 'MSMEs Go Regional', 'copy' => 'Product curation, business matching, and flagship catalog promotion.'],
        ]
        : [
            ['title' => 'Perdagangan Lintas Batas', 'copy' => 'Konsolidasi rantai pasok, logistik, dan promosi pasar regional.'],
            ['title' => 'Pariwisata Terpadu', 'copy' => 'Narasi destinasi, event, dan konektivitas ekonomi kreatif.'],
            ['title' => 'Investasi Prioritas', 'copy' => 'Daftar proyek unggulan dan peluang kemitraan strategis.'],
            ['title' => 'UMKM Go Regional', 'copy' => 'Kurasi produk, business matching, dan promosi katalog unggulan.'],
        ];

    $publications = $isEnglish
        ? [
            ['type' => 'News', 'title' => 'The Malaysian business delegation visit to Indonesia focuses on food supply chains and logistics.', 'theme' => 'news'],
            ['type' => 'Gallery', 'title' => 'Documentation of trade forums, commitment signing, and regional product showcases.', 'theme' => 'agenda'],
            ['type' => 'Documents', 'title' => 'Annual reports, MoUs, policy briefs, and regulations available for public download.', 'theme' => 'profile'],
            ['type' => 'Newsletter', 'title' => 'A periodic e-magazine summarizing programs, agendas, and cooperation results.', 'theme' => 'service'],
        ]
        : [
            ['type' => 'Berita', 'title' => 'Kunjungan delegasi bisnis Malaysia ke Indonesia fokus pada rantai pasok pangan dan logistik.', 'theme' => 'news'],
            ['type' => 'Galeri', 'title' => 'Dokumentasi forum perdagangan, penandatanganan komitmen, dan showcase produk daerah.', 'theme' => 'agenda'],
            ['type' => 'Dokumen', 'title' => 'Laporan tahunan, MoU, policy brief, dan regulasi yang dapat diunduh publik.', 'theme' => 'profile'],
            ['type' => 'Newsletter', 'title' => 'E-magazine berkala untuk ringkasan program, agenda, dan hasil kerja sama.', 'theme' => 'service'],
        ];

    $potentials = $isEnglish
        ? [
            ['title' => 'Fisheries and Marine Sector', 'copy' => 'Potential for downstream marine products, cold chain, and derivative exports.'],
            ['title' => 'Plantation and Food', 'copy' => 'Investment opportunities in palm, coconut, sago, and processed food industries.'],
            ['title' => 'Tourism and Culture', 'copy' => 'Destinations, events, and creative products that strengthen the region’s image.'],
            ['title' => 'Energy and Infrastructure', 'copy' => 'Connectivity projects, supporting energy, and strategic industrial zones.'],
        ]
        : [
            ['title' => 'Perikanan dan Kelautan', 'copy' => 'Potensi hilirisasi hasil laut, cold chain, dan ekspor produk turunan.'],
            ['title' => 'Perkebunan dan Pangan', 'copy' => 'Peluang investasi pada pengolahan sawit, kelapa, sagu, dan pangan olahan.'],
            ['title' => 'Pariwisata dan Budaya', 'copy' => 'Destinasi, event, dan produk kreatif yang memperkaya citra kawasan.'],
            ['title' => 'Energi dan Infrastruktur', 'copy' => 'Proyek konektivitas, energi pendukung, dan kawasan industri strategis.'],
        ];

    $featuredProducts = $isEnglish
        ? [
            ['name' => 'Indonesia Liberica Coffee', 'category' => 'MSME Export', 'theme' => 'product'],
            ['name' => 'Malay Songket and Textiles', 'category' => 'Craft & Fashion', 'theme' => 'profile'],
            ['name' => 'Modern Sago Products', 'category' => 'Food Innovation', 'theme' => 'agenda'],
        ]
        : [
            ['name' => 'Kopi Liberika Indonesia', 'category' => 'Ekspor UMKM', 'theme' => 'product'],
            ['name' => 'Songket dan Wastra Melayu', 'category' => 'Kriya & Fesyen', 'theme' => 'profile'],
            ['name' => 'Olahan Sagu Modern', 'category' => 'Pangan Inovatif', 'theme' => 'agenda'],
        ];

    $jointPrograms = $isEnglish
        ? [
            ['title' => 'Trade Facilitation Desk', 'copy' => 'Initial assistance for business actors who want to understand regional market opportunities.'],
            ['title' => 'Joint Promotion Calendar', 'copy' => 'Synchronization of cross-region and cross-country promotional events.'],
            ['title' => 'Regional Success Stories', 'copy' => 'Partnership success stories that strengthen prospective partner confidence.'],
        ]
        : [
            ['title' => 'Trade Facilitation Desk', 'copy' => 'Pendampingan awal untuk pelaku usaha yang ingin memahami peluang pasar kawasan.'],
            ['title' => 'Joint Promotion Calendar', 'copy' => 'Sinkronisasi event promosi lintas daerah dan lintas negara.'],
            ['title' => 'Regional Success Stories', 'copy' => 'Cerita sukses kemitraan untuk memperkuat kepercayaan calon mitra.'],
        ];

    $faqItems = $isEnglish
        ? [
            ['q' => 'How do I register for an event?', 'a' => 'Visitors can fill in the event registration form, which will later connect to the registration module.'],
            ['q' => 'Can partnership proposals be submitted through the website?', 'a' => 'Yes. Partnership proposals can be submitted through the available form and will be followed up by the management team.'],
            ['q' => 'Can public documents be downloaded freely?', 'a' => 'Public documents will be available for download, while restricted documents will later be governed by permission settings.'],
        ]
        : [
            ['q' => 'Bagaimana cara mendaftar event?', 'a' => 'Pengunjung dapat mengisi formulir pendaftaran event yang akan dihubungkan ke modul registrasi.'],
            ['q' => 'Apakah proposal kemitraan bisa dikirim dari website?', 'a' => 'Ya. Proposal kemitraan dapat dikirim melalui formulir yang tersedia dan akan ditindaklanjuti oleh tim pengelola.'],
            ['q' => 'Apakah dokumen publik bisa diunduh bebas?', 'a' => 'Dokumen yang bersifat publik akan tersedia untuk unduh, sementara dokumen terbatas akan diatur lewat permission.'],
        ];
@endphp

@extends('layouts.public')

@section('title', data_get($siteSettings ?? [], 'app_name', 'IMT-GT').' | '.data_get($siteSettings ?? [], 'app_tagline', 'Indonesia IMT-GT Business Centre'))

@section('content')
    <main id="beranda" class="relative">
        <section class="relative isolate overflow-hidden pb-16 pt-10 lg:pb-24 lg:pt-16">
            <div class="pointer-events-none absolute inset-x-0 top-0 h-[46rem] bg-[radial-gradient(circle_at_10%_10%,rgba(34,211,238,0.18),transparent_18rem),radial-gradient(circle_at_90%_20%,rgba(56,189,248,0.18),transparent_14rem)]"></div>
            <div class="mx-auto grid max-w-7xl gap-10 px-6 lg:grid-cols-[1.1fr_0.9fr] lg:px-8">
                <div class="relative z-10">
                    <div class="reveal inline-flex rounded-full border border-cyan-300/20 bg-white/6 px-4 py-2 text-xs font-semibold uppercase tracking-[0.32em] text-cyan-100/85 backdrop-blur">
                        {{ __('ui.home.badge') }}
                    </div>
                    <h1 class="reveal mt-7 max-w-5xl font-['Playfair_Display'] text-5xl leading-[1.02] text-white sm:text-6xl lg:text-7xl">
                        {{ $heroTitle }}
                    </h1>
                    <p class="reveal mt-6 max-w-2xl text-lg leading-8 text-slate-200/78">
                        {{ $heroSubtitle }}
                    </p>

                    <div class="reveal mt-8 flex flex-col gap-4 sm:flex-row">
                        <a href="#profil" class="imtgt-button imtgt-button-primary">{{ __('ui.home.explore_profile') }}</a>
                        <a href="#program" class="imtgt-button imtgt-button-secondary">{{ __('ui.home.view_programs') }}</a>
                        <a href="{{ route('registration.create') }}" class="imtgt-button imtgt-button-secondary">{{ $isEnglish ? 'Register Supplier / Buyer' : 'Registrasi Supplier / Buyer' }}</a>
                    </div>

                    <div class="reveal mt-10 grid gap-4 sm:grid-cols-3">
                        <div class="imtgt-card p-5">
                            <p class="text-xs uppercase tracking-[0.26em] text-cyan-200/70">{{ __('ui.home.coverage') }}</p>
                            <p class="mt-3 text-3xl font-bold text-white">{{ __('ui.home.coverage_value') }}</p>
                            <p class="mt-2 text-sm leading-6 text-slate-300/78">{{ __('ui.home.coverage_text') }}</p>
                        </div>
                        <div class="imtgt-card p-5">
                            <p class="text-xs uppercase tracking-[0.26em] text-cyan-200/70">{{ __('ui.home.focus') }}</p>
                            <p class="mt-3 text-3xl font-bold text-white">{{ __('ui.home.focus_value') }}</p>
                            <p class="mt-2 text-sm leading-6 text-slate-300/78">{{ __('ui.home.focus_text') }}</p>
                        </div>
                        <div class="imtgt-card p-5">
                            <p class="text-xs uppercase tracking-[0.26em] text-cyan-200/70">{{ __('ui.home.ux_direction') }}</p>
                            <p class="mt-3 text-3xl font-bold text-white">{{ __('ui.home.ux_direction_value') }}</p>
                            <p class="mt-2 text-sm leading-6 text-slate-300/78">{{ __('ui.home.ux_direction_text') }}</p>
                        </div>
                    </div>
                </div>

                <div class="relative flex items-center justify-center lg:justify-end">
                    <div class="hero-stage w-full max-w-2xl">
                        <div class="parallax-layer absolute -left-8 top-6 h-24 w-24 rounded-full bg-cyan-300/20 blur-3xl" data-parallax="0.08"></div>
                        <div class="parallax-layer absolute right-2 top-10 h-28 w-28 rounded-full bg-fuchsia-300/14 blur-3xl" data-parallax="0.11"></div>
                        <div class="reveal parallax-layer imtgt-card relative overflow-hidden rounded-[2rem] p-5 shadow-[0_40px_100px_rgba(2,6,23,0.5)]" data-parallax="0.06">
                            <div class="absolute inset-0 bg-[linear-gradient(135deg,rgba(255,255,255,0.04),rgba(34,211,238,0.12),transparent_55%)]"></div>
                            <div class="relative space-y-4">
                                <div class="flex items-center justify-between">
                                    <p class="text-xs uppercase tracking-[0.3em] text-cyan-200/70">{{ __('ui.home.latest_banner') }}</p>
                                    <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-200">{{ __('ui.home.dummy_data') }}</span>
                                </div>

                                <div class="grid gap-4">
                                    @foreach ($heroSlides as $slide)
                                        <article class="rounded-[1.7rem] border border-white/10 bg-slate-950/35 p-4">
                                            <div class="grid gap-4 md:grid-cols-[1fr_1.1fr] md:items-center">
                                                <div class="overflow-hidden rounded-[1.4rem] border border-white/10 bg-white/5">
                                                    @if (! empty($slide['image']))
                                                        <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}" class="h-52 w-full object-cover">
                                                    @else
                                                        {!! $illustration($slide['theme'], 'h-52 w-full') !!}
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="text-xs uppercase tracking-[0.28em] text-cyan-200/75">{{ $slide['eyebrow'] ?: __('ui.home.active_banner') }}</p>
                                                    <h2 class="mt-3 text-2xl font-semibold leading-tight text-white">{{ $slide['title'] }}</h2>
                                                    <p class="mt-3 text-sm leading-7 text-slate-300/78">{{ $slide['subtitle'] ?: __('ui.home.default_slide_copy') }}</p>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-6 py-8 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-[0.9fr_1.1fr]">
                <div class="reveal rounded-[2rem] border border-white/10 bg-[linear-gradient(135deg,rgba(34,211,238,0.14),rgba(255,255,255,0.04))] p-7">
                    <p class="text-sm uppercase tracking-[0.35em] text-cyan-200/75">{{ __('ui.home.greeting_label') }}</p>
                    <h2 class="mt-4 font-['Playfair_Display'] text-4xl text-white">{{ $isEnglish ? $translateValue($greeting?->headline, ['Menyajikan wajah IMT-GT BC Indonesia yang lebih tenang, kredibel, dan mudah dipahami.' => 'Presenting a calmer, more credible, and easier-to-understand face of Indonesia IMT-GT.']) : ($greeting?->headline ?? __('ui.home.greeting_fallback_title')) }}</h2>
                    <p class="mt-5 text-base leading-8 text-slate-200/76">
                        {{ $isEnglish ? $translateValue($greeting?->message, ['Halaman publik ini dibuat dengan fokus pada orientasi pengguna: pengunjung langsung melihat konteks, lalu diarahkan ke profil, program, publikasi, potensi daerah, dan layanan tanpa harus menebak alur informasi.' => 'This public page presents key information on profile, programs, publications, regional potential, and services in a clear and structured way.']) : ($greeting?->message ?? __('ui.home.greeting_fallback_text')) }}
                    </p>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    @foreach ($headlineNews as $item)
                        <article class="reveal imtgt-card p-5">
                            <div class="flex items-center justify-between gap-3">
                                <span class="rounded-full bg-cyan-300/12 px-3 py-1 text-xs font-semibold uppercase tracking-[0.22em] text-cyan-100">{{ $item['tag'] }}</span>
                                <span class="text-xs text-slate-400">{{ $item['meta'] }}</span>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold leading-7 text-white">{{ $item['title'] }}</h3>
                        </article>
                    @endforeach
                    <div class="reveal imtgt-card p-5">
                        <p class="text-xs uppercase tracking-[0.22em] text-emerald-200/75">{{ __('ui.home.upcoming_agenda_label') }}</p>
                        <div class="mt-4 space-y-3">
                            @foreach (array_slice($upcomingAgenda, 0, 2) as $agenda)
                                <div class="rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3">
                                    <p class="text-sm font-semibold text-white">{{ $agenda['title'] }}</p>
                                    <p class="mt-1 text-xs text-slate-400">{{ $agenda['date'] }} • {{ $agenda['time'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="profil" class="relative overflow-hidden py-20 bg-white">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
                    <div class="reveal">
                        <p class="text-sm uppercase tracking-[0.38em] text-cyan-700/70">{{ $isEnglish ? 'Profile' : 'Profil' }}</p>
                        <h2 class="mt-3 font-['Playfair_Display'] text-4xl text-slate-900">{{ $isEnglish ? 'About Indonesia IMT-GT Business Centre' : 'Tentang Indonesia IMT-GT Business Centre' }}</h2>
                        <p class="mt-5 text-base leading-8 text-slate-600">
                            {{ $isEnglish ? 'Indonesia IMT-GT Business Centre is dedicated to facilitating trade, investment, tourism, and MSME growth across the region. We aim to foster seamless cooperation between members and drive sustainable economic development.' : 'Indonesia IMT-GT Business Centre didedikasikan untuk memfasilitasi perdagangan, investasi, pariwisata, dan pertumbuhan UMKM di seluruh kawasan. Kami bertujuan untuk mendorong kerja sama yang mulus antar anggota dan mendorong pembangunan ekonomi yang berkelanjutan.' }}
                        </p>
                        <div class="mt-8 flex gap-4">
                            <a href="#kerjasama" class="imtgt-button imtgt-button-primary text-white">{{ $isEnglish ? 'Learn More' : 'Pelajari Lebih Lanjut' }}</a>
                        </div>
                    </div>
                    <div class="reveal overflow-hidden rounded-[2rem] border border-slate-200 bg-slate-50 shadow-sm">
                        {!! $illustration('profile', 'h-80 w-full') !!}
                    </div>
                </div>
            </div>
        </section>

        <section id="program" class="relative overflow-hidden border-y border-slate-200 bg-slate-50 py-20">
            <div class="pointer-events-none absolute inset-y-0 right-0 w-1/2 bg-[radial-gradient(circle_at_center,_rgba(45,212,191,0.16),_transparent_60%)]"></div>
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mb-10 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                    <div class="reveal max-w-3xl">
                        <p class="text-sm uppercase tracking-[0.38em] text-emerald-200/70">{{ $isEnglish ? 'Programs & Activities' : 'Program & Kegiatan' }}</p>
                        <h2 class="mt-3 font-['Playfair_Display'] text-4xl text-white">{{ $isEnglish ? 'Agenda activities, reports, and flagship projects.' : 'Agenda kegiatan, laporan, dan proyek unggulan.' }}</h2>
                    </div>
                </div>

                <div class="grid gap-6 xl:grid-cols-[0.95fr_1.05fr]">
                    <div class="space-y-4">
                        <div class="reveal imtgt-card p-6">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.28em] text-cyan-200/75">{{ $isEnglish ? 'Event Agenda' : 'Agenda Kegiatan' }}</p>
                                    <h3 class="mt-2 text-2xl font-semibold text-white">{{ $isEnglish ? 'Upcoming event calendar' : 'Kalender event mendatang' }}</h3>
                                </div>
                                <span class="rounded-full border border-white/10 px-3 py-1 text-xs text-slate-300">{{ $isEnglish ? 'Dummy Calendar' : 'Dummy Calendar' }}</span>
                            </div>
                            <div class="mt-5 space-y-4">
                                @foreach ($upcomingAgenda as $agenda)
                                    <article class="rounded-[1.4rem] border border-white/10 bg-slate-950/40 p-4">
                                        <div class="flex items-start gap-4">
                                            <div class="min-w-18 rounded-2xl bg-cyan-300/12 px-4 py-3 text-center text-cyan-100">
                                                <p class="text-xs uppercase tracking-[0.2em]">{{ $isEnglish ? 'Date' : 'Tanggal' }}</p>
                                                <p class="mt-1 text-xl font-bold">{{ $agenda['date'] }}</p>
                                            </div>
                                            <div class="flex-1">
                                                <p class="font-semibold text-white">{{ $agenda['title'] }}</p>
                                                <p class="mt-2 text-sm text-slate-400">{{ $agenda['time'] }} • {{ $agenda['place'] }}</p>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>

                        <div class="reveal imtgt-card overflow-hidden p-5">
                            <div class="grid gap-4 md:grid-cols-[1fr_1.1fr] md:items-center">
                                <div class="overflow-hidden rounded-[1.5rem] border border-white/10 bg-white/5">
                                    {!! $illustration('agenda', 'h-52 w-full') !!}
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-[0.28em] text-emerald-200/75">{{ $isEnglish ? 'Activity Reports' : 'Laporan Kegiatan' }}</p>
                                    <h3 class="mt-3 text-2xl font-semibold text-white">{{ $isEnglish ? 'Program achievements and forum outcomes are documented as part of institutional reporting and public information.' : 'Capaian program dan hasil forum didokumentasikan sebagai bagian dari laporan kelembagaan dan informasi publik.' }}</h3>
                                    <p class="mt-3 text-sm leading-7 text-slate-300/76">{{ $isEnglish ? 'Visitors can follow updates on strategic activities, cross-border forums, and key outcomes from each cooperation agenda.' : 'Pengunjung dapat mengikuti perkembangan kegiatan strategis, forum lintas negara, dan hasil utama dari setiap agenda kerja sama.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach ($projects as $project)
                            <article class="reveal imtgt-card p-5">
                                <div class="overflow-hidden rounded-[1.4rem] border border-white/10 bg-white/5">
                                    {!! $illustration('service', 'h-44 w-full') !!}
                                </div>
                                <p class="mt-4 text-xs uppercase tracking-[0.28em] text-cyan-200/72">{{ $isEnglish ? 'Flagship Projects' : 'Proyek Unggulan' }}</p>
                                <h3 class="mt-2 text-xl font-semibold text-white">{{ $project['title'] }}</h3>
                                <p class="mt-3 text-sm leading-7 text-slate-300/76">{{ $project['copy'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section id="publikasi" class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
            <div class="mb-10 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <div class="reveal max-w-3xl">
                    <p class="text-sm uppercase tracking-[0.38em] text-cyan-200/70">{{ $isEnglish ? 'News & Publications' : 'Berita & Publikasi' }}</p>
                    <h2 class="mt-3 font-['Playfair_Display'] text-4xl text-white">{{ $isEnglish ? 'News, galleries, documents, and newsletters present the latest updates from activities and regional cooperation initiatives.' : 'Berita, galeri, dokumen, dan newsletter menyajikan perkembangan terbaru dari kegiatan dan inisiatif kerja sama kawasan.' }}</h2>
                </div>
                <a href="#kontak" class="reveal imtgt-button imtgt-button-secondary">{{ $isEnglish ? 'Request Full Material' : 'Minta Materi Lengkap' }}</a>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                @foreach ($publications as $publication)
                    <article class="reveal imtgt-card overflow-hidden p-5">
                        <div class="grid gap-4 md:grid-cols-[0.95fr_1.05fr] md:items-center">
                            <div class="overflow-hidden rounded-[1.5rem] border border-white/10 bg-white/5">
                                {!! $illustration($publication['theme'], 'h-52 w-full') !!}
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.28em] text-cyan-200/75">{{ $publication['type'] }}</p>
                                <h3 class="mt-3 text-2xl font-semibold leading-tight text-white">{{ $publication['title'] }}</h3>
                                <p class="mt-3 text-sm leading-7 text-slate-300/76">{{ $isEnglish ? 'Available publication formats include news, galleries, documents, and newsletters that support public information needs.' : 'Jenis publikasi yang tersedia mencakup berita, galeri, dokumen, dan newsletter untuk mendukung kebutuhan informasi publik.' }}</p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section id="potensi" class="relative overflow-hidden py-20">
            <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(180deg,rgba(14,165,233,0.08),transparent_35%,rgba(20,184,166,0.08))]"></div>
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mb-10 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                    <div class="reveal max-w-3xl">
                        <p class="text-sm uppercase tracking-[0.38em] text-cyan-200/70">{{ $isEnglish ? 'Regional Potential' : 'Potensi Daerah' }}</p>
                        <h2 class="mt-3 font-['Playfair_Display'] text-4xl text-white">{{ $isEnglish ? 'Investment potential, flagship products, and business opportunities highlight sectors that are open for collaboration and market expansion.' : 'Potensi investasi, produk unggulan, dan peluang bisnis menyoroti sektor-sektor yang terbuka untuk kolaborasi dan pengembangan pasar.' }}</h2>
                    </div>
                    <div class="reveal rounded-[1.5rem] border border-white/10 bg-white/5 px-5 py-4 text-sm leading-7 text-slate-300/75">
                        {{ $isEnglish ? 'Regional opportunities are presented concisely to help visitors identify sectors with the strongest growth potential.' : 'Peluang kawasan disajikan secara ringkas untuk membantu pengunjung mengenali sektor-sektor dengan potensi pertumbuhan yang paling kuat.' }}
                    </div>
                </div>

                <div class="grid gap-6 xl:grid-cols-[1.05fr_0.95fr]">
                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach ($potentials as $potential)
                            <article class="reveal imtgt-card p-5">
                                <p class="text-xs uppercase tracking-[0.28em] text-cyan-200/74">{{ $isEnglish ? 'Priority Sector' : 'Sektor Unggulan' }}</p>
                                <h3 class="mt-3 text-2xl font-semibold text-white">{{ $potential['title'] }}</h3>
                                <p class="mt-3 text-sm leading-7 text-slate-300/76">{{ $potential['copy'] }}</p>
                            </article>
                        @endforeach
                    </div>

                    <div class="space-y-6">
                        <div class="reveal imtgt-card overflow-hidden p-5">
                            <div class="overflow-hidden rounded-[1.6rem] border border-white/10 bg-white/5">
                                {!! $illustration('map', 'h-64 w-full') !!}
                            </div>
                            <div class="mt-5">
                                <p class="text-xs uppercase tracking-[0.28em] text-fuchsia-200/72">{{ $isEnglish ? 'Business Opportunity Map' : 'Peta Peluang Bisnis' }}</p>
                                <h3 class="mt-2 text-2xl font-semibold text-white">{{ $isEnglish ? 'Placeholder for an interactive regional map.' : 'Placeholder untuk interactive map kawasan.' }}</h3>
                                <p class="mt-3 text-sm leading-7 text-slate-300/76">{{ $isEnglish ? 'This area is prepared to present business opportunity mapping and can be expanded with regional data in the next stage.' : 'Area ini disiapkan untuk menampilkan peta peluang bisnis dan dapat dikembangkan lebih lanjut dengan data kawasan pada tahap berikutnya.' }}</p>
                            </div>
                        </div>

                        <div class="grid gap-4 md:grid-cols-3">
                            @foreach ($featuredProducts as $product)
                                <article class="reveal imtgt-card overflow-hidden p-4">
                                    <div class="overflow-hidden rounded-[1.2rem] border border-white/10 bg-white/5">
                                        {!! $illustration($product['theme'], 'h-36 w-full') !!}
                                    </div>
                                    <p class="mt-4 text-xs uppercase tracking-[0.24em] text-cyan-200/72">{{ $product['category'] }}</p>
                                    <h3 class="mt-2 text-lg font-semibold text-white">{{ $product['name'] }}</h3>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="kerjasama" class="relative overflow-hidden border-y border-slate-200 bg-slate-50 py-20">
            <div class="mx-auto grid max-w-7xl gap-8 px-6 lg:grid-cols-[0.9fr_1.1fr] lg:px-8">
                <div class="reveal lg:sticky lg:top-28 lg:self-start">
                    <p class="text-sm uppercase tracking-[0.38em] text-cyan-200/70">{{ $isEnglish ? 'International Cooperation' : 'Kerjasama Internasional' }}</p>
                    <h2 class="mt-3 font-['Playfair_Display'] text-4xl text-white">{{ $isEnglish ? 'IMT-GT, joint programs, relations among member countries, and examples of cooperation outcomes are presented here in one integrated overview.' : 'IMT-GT, program bersama, hubungan antarnegara anggota, serta contoh hasil kerja sama ditampilkan dalam satu gambaran yang utuh.' }}</h2>
                    <p class="mt-5 text-base leading-8 text-slate-300/76">
                        {{ $isEnglish ? 'International cooperation, joint programs, and success stories within the IMT-GT framework are presented to show the direction and impact of regional collaboration.' : 'Konteks kerja sama internasional, program bersama, dan kisah keberhasilan dalam kerangka IMT-GT disajikan untuk menunjukkan arah serta dampak kolaborasi kawasan.' }}
                    </p>
                </div>

                <div class="space-y-5">
                    <article class="reveal imtgt-card overflow-hidden p-5">
                        <div class="grid gap-4 md:grid-cols-[0.9fr_1.1fr] md:items-center">
                            <div class="overflow-hidden rounded-[1.5rem] border border-white/10 bg-white/5">
                                {!! $illustration('hero', 'h-52 w-full') !!}
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.28em] text-cyan-200/74">{{ $isEnglish ? 'About IMT-GT' : 'Tentang IMT-GT' }}</p>
                                <h3 class="mt-3 text-2xl font-semibold text-white">Indonesia - Malaysia - Thailand Growth Triangle</h3>
                                <p class="mt-3 text-sm leading-7 text-slate-300/76">{{ $isEnglish ? 'The regional cooperation framework, development priorities, and the role of the Business Centre are described to help visitors understand how collaboration is coordinated.' : 'Kerangka kerja sama kawasan, prioritas pengembangan, dan peran Business Centre dijelaskan untuk membantu pengunjung memahami bagaimana kolaborasi dijalankan.' }}</p>
                            </div>
                        </div>
                    </article>

                    <div class="grid gap-4 md:grid-cols-3">
                        @foreach ($jointPrograms as $program)
                            <article class="reveal imtgt-card p-5">
                                <p class="text-xs uppercase tracking-[0.28em] text-cyan-200/72">Joint Program</p>
                                <h3 class="mt-3 text-xl font-semibold text-white">{{ $program['title'] }}</h3>
                                <p class="mt-3 text-sm leading-7 text-slate-300/76">{{ $program['copy'] }}</p>
                            </article>
                        @endforeach
                    </div>

                    <article class="reveal imtgt-card p-6">
                        <p class="text-xs uppercase tracking-[0.28em] text-cyan-200/72">{{ $isEnglish ? 'Success Story' : 'Cerita Sukses' }}</p>
                        <h3 class="mt-3 text-2xl font-semibold text-white">{{ $isEnglish ? 'Sample success story: a local food product successfully entered a regional promotion network.' : 'Simulasi success story: produk pangan lokal berhasil masuk jaringan promosi regional.' }}</h3>
                        <p class="mt-4 text-sm leading-7 text-slate-300/76">{{ $isEnglish ? 'Success stories show how collaboration can create tangible results for business actors, institutions, and regional development.' : 'Cerita sukses menunjukkan bagaimana kolaborasi dapat menghasilkan manfaat nyata bagi pelaku usaha, institusi, dan pengembangan kawasan.' }}</p>
                    </article>
                </div>
            </div>
        </section>

        <section id="layanan" class="relative overflow-hidden py-20 bg-slate-50 border-t border-slate-200">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mb-12 text-center reveal">
                    <p class="text-sm uppercase tracking-[0.38em] text-cyan-700/70">{{ $isEnglish ? 'Our Services' : 'Layanan Kami' }}</p>
                    <h2 class="mt-3 font-['Playfair_Display'] text-4xl text-slate-900">{{ $isEnglish ? 'What We Offer' : 'Apa yang Kami Tawarkan' }}</h2>
                    <p class="mt-4 mx-auto max-w-2xl text-base leading-8 text-slate-600">
                        {{ $isEnglish ? 'Explore the various support systems and services provided by the Business Centre to help you navigate and succeed in the regional market.' : 'Jelajahi berbagai sistem dukungan dan layanan yang disediakan oleh Business Centre untuk membantu Anda menavigasi dan sukses di pasar regional.' }}
                    </p>
                </div>
                <div class="grid gap-6 md:grid-cols-3">
                    <div class="reveal rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="h-12 w-12 rounded-xl bg-cyan-100 flex items-center justify-center text-cyan-600 mb-5">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900">{{ $isEnglish ? 'Business Matching' : 'Pencocokan Bisnis' }}</h3>
                        <p class="mt-3 text-sm text-slate-600">{{ $isEnglish ? 'Connect with potential partners and investors across the IMT-GT region.' : 'Terhubung dengan calon mitra dan investor di seluruh kawasan IMT-GT.' }}</p>
                    </div>
                    <div class="reveal rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="h-12 w-12 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600 mb-5">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900">{{ $isEnglish ? 'Market Intelligence' : 'Informasi Pasar' }}</h3>
                        <p class="mt-3 text-sm text-slate-600">{{ $isEnglish ? 'Access up-to-date data and research on market trends and opportunities.' : 'Akses data dan riset terkini mengenai tren pasar dan berbagai peluang usaha.' }}</p>
                    </div>
                    <div class="reveal rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="h-12 w-12 rounded-xl bg-amber-100 flex items-center justify-center text-amber-600 mb-5">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900">{{ $isEnglish ? 'Policy Advocacy' : 'Advokasi Kebijakan' }}</h3>
                        <p class="mt-3 text-sm text-slate-600">{{ $isEnglish ? 'Support in navigating regulations and advocating for business-friendly policies.' : 'Dukungan navigasi regulasi dan advokasi kebijakan yang mendukung dunia usaha.' }}</p>
                    </div>
                </div>
            </div>
        </section>


    </main>

    <footer id="kontak" class="border-t border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
            <div class="mb-10 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <div class="reveal max-w-3xl">
                    <p class="text-sm uppercase tracking-[0.38em] text-cyan-200/70">{{ $isEnglish ? 'Contact Us' : 'Kontak Kami' }}</p>
                    <h2 class="mt-3 font-['Playfair_Display'] text-4xl text-white">{{ $isEnglish ? 'Find the official address, contact information, and communication channels for further coordination.' : 'Temukan alamat resmi, informasi kontak, dan saluran komunikasi untuk kebutuhan koordinasi lebih lanjut.' }}</h2>
                </div>
                <div class="reveal rounded-[1.5rem] border border-white/10 bg-white/5 px-5 py-4 text-sm leading-7 text-slate-300/75">
                    {{ $isEnglish ? 'If you need more information, you can contact the secretariat, visit the office location, or send a message through the available form.' : 'Jika Anda membutuhkan informasi lebih lanjut, silakan hubungi sekretariat, kunjungi lokasi kantor, atau kirim pesan melalui formulir yang tersedia.' }}
                </div>
            </div>

            <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="reveal imtgt-card p-6">
                        <p class="text-xs uppercase tracking-[0.28em] text-cyan-200/72">{{ $isEnglish ? 'Office Address' : 'Alamat Kantor' }}</p>
                        <p class="mt-4 text-base leading-8 text-slate-200/76">Indonesia IMT-GT Business Centre<br>{{ $isEnglish ? 'Indonesia IMT-GT' : 'Indonesia IMT-GT' }}<br>Indonesia</p>
                    </div>
                    <div class="reveal imtgt-card p-6">
                        <p class="text-xs uppercase tracking-[0.28em] text-cyan-200/72">{{ $isEnglish ? 'Email & Phone' : 'Email & Telepon' }}</p>
                        <p class="mt-4 text-base leading-8 text-slate-200/76">info@indonesia-imtgt.test<br>partnership@indonesia-imtgt.test<br>+62 21 000 000</p>
                    </div>
                    <div class="reveal imtgt-card overflow-hidden p-5 sm:col-span-2">
                        <div class="overflow-hidden rounded-[1.5rem] border border-white/10 bg-white/5">
                            {!! $illustration('contact', 'h-56 w-full') !!}
                        </div>
                        <p class="mt-4 text-sm leading-7 text-slate-300/76">{{ $isEnglish ? 'The office location area can be connected with an interactive map to help visitors plan visits more easily.' : 'Area lokasi kantor dapat dihubungkan dengan peta interaktif untuk membantu pengunjung merencanakan kunjungan dengan lebih mudah.' }}</p>
                    </div>
                </div>

                <div class="reveal imtgt-card p-6">
                    <p class="text-xs uppercase tracking-[0.28em] text-cyan-200/72">{{ $isEnglish ? 'Contact Form' : 'Formulir Kontak' }}</p>
                    <form class="mt-5 grid gap-4">
                        <input type="text" class="imtgt-input" placeholder="{{ $isEnglish ? 'Full name' : 'Nama lengkap' }}">
                        <input type="email" class="imtgt-input" placeholder="Email">
                        <input type="text" class="imtgt-input" placeholder="{{ $isEnglish ? 'Subject' : 'Subjek' }}">
                        <textarea class="imtgt-input min-h-40" placeholder="{{ $isEnglish ? 'Write your message' : 'Tulis pesan Anda' }}"></textarea>
                        <button type="button" class="imtgt-button imtgt-button-primary w-full">{{ $isEnglish ? 'Send Dummy Message' : 'Kirim Pesan Dummy' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </footer>
@endsection

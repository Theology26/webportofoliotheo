<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theo | Fullstack Developer</title>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Aurora 3D Effect */
        .aurora-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
            background-color: #000; /* Pure Black Background */
        }
        
        .aurora {
            position: absolute;
            width: 200vw;
            height: 200vh;
            top: -50vh;
            left: -50vw;
            background: radial-gradient(circle at 50% 50%, rgba(56, 189, 248, 0.4) 0%, rgba(37, 99, 235, 0.3) 30%, transparent 60%);
            filter: blur(100px);
            opacity: 0.8;
            transform: skew(-20deg) rotate(-20deg);
            animation: undulatingAurora 20s ease-in-out infinite alternate;
            mix-blend-mode: screen;
        }

        .aurora:nth-child(2) {
            background: radial-gradient(circle at 40% 60%, rgba(14, 165, 233, 0.3) 0%, rgba(79, 70, 229, 0.2) 40%, transparent 70%);
            animation-duration: 25s;
            animation-delay: -5s;
            transform: skew(15deg) rotate(15deg) scale(1.2);
        }

        @keyframes undulatingAurora {
            0% {
                transform: skew(-20deg) rotate(-20deg) translate(0%, 0%) scale(1);
            }
            50% {
                transform: skew(-15deg) rotate(-15deg) translate(-10%, 10%) scale(1.1);
            }
            100% {
                transform: skew(-25deg) rotate(-25deg) translate(10%, -10%) scale(0.9);
            }
        }

        /* Shooting Stars */
        .stars-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            z-index: 1;
            pointer-events: none;
        }

        .shooting-star {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 100px;
            height: 2px;
            background: linear-gradient(90deg, #06b6d4 0%, transparent 100%);
            border-radius: 999px;
            filter: drop-shadow(0 0 6px #06b6d4);
            animation: shoot 4s linear infinite;
            opacity: 0;
            transform: rotate(-45deg);
        }

        .shooting-star::before {
            content: '';
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 4px;
            background: #06b6d4;
            border-radius: 50%;
            box-shadow: 0 0 10px 2px rgba(6, 182, 212, 0.8);
        }

        @keyframes shoot {
            0% {
                transform: rotate(-45deg) translateX(0);
                opacity: 1;
            }
            70% {
                opacity: 1;
            }
            100% {
                transform: rotate(-45deg) translateX(-1500px);
                opacity: 0;
            }
        }
        
        /* Star Variations */
        .star-1 { top: 10%; right: -10%; animation-delay: 0s; animation-duration: 3s; }
        .star-2 { top: 30%; right: -20%; animation-delay: 1.5s; animation-duration: 4s; }
        .star-3 { top: 50%; right: 0%; animation-delay: 3s; animation-duration: 3.5s; }
        .star-4 { top: 70%; right: -5%; animation-delay: 0.5s; animation-duration: 4.5s; }
        .star-5 { top: -10%; right: 20%; animation-delay: 2.5s; animation-duration: 3s; }

        /* Mobile Optimization: Sembunyikan Aurora di layar HP */
        @media (max-width: 768px) {
            .aurora-container, .stars-container {
                display: none !important;
            }
        }

        /* Particles JS Network Canvas */
        #particles-js {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 1; /* Di atas aurora tapi di bawah content */
            pointer-events: auto; /* Agar interaktif */
        }

        /* Efek Grayscale Hover */
        .interactive-grayscale {
            filter: grayscale(100%);
            transition: filter 0.8s ease-in-out;
            position: relative;
            overflow: hidden;
        }

        .interactive-container:hover .interactive-grayscale {
            filter: grayscale(0%);
        }

        /* Hover Spotlight Overlay */
        .spotlight-overlay {
            position: absolute;
            inset: 0;
            pointer-events: none;
            background: radial-gradient(600px circle at var(--x) var(--y), rgba(255, 255, 255, 0.15), transparent 40%);
            opacity: 0;
            transition: opacity 0.3s;
            z-index: 5;
        }

        .interactive-container:hover .spotlight-overlay {
            opacity: 1;
        }
    </style>
</head>
<body class="font-sans antialiased relative selection:bg-cyan-500 selection:text-white bg-black text-white">

    <!-- 3D Aurora Background -->
    <div class="aurora-container">
        <div class="aurora"></div>
        <div class="aurora"></div>
    </div>

    <!-- Particles Point-to-Point Canvas -->
    <div id="particles-js"></div>

    <!-- Shooting Stars Background -->
    <div class="stars-container">
        <div class="shooting-star star-1"></div>
        <div class="shooting-star star-2"></div>
        <div class="shooting-star star-3"></div>
        <div class="shooting-star star-4"></div>
        <div class="shooting-star star-5"></div>
    </div>

    <div class="relative z-10 flex flex-col min-h-screen pt-20">
        
        <!-- Header -->
        <header class="w-full px-8 py-6 flex justify-between items-center fixed top-0 backdrop-blur-md border-b border-white/5 z-50">
            <div class="flex items-center">
                @if(isset($profile) && $profile->logo_image)
                    <img src="{{ asset('storage/' . $profile->logo_image) }}" alt="Logo" class="h-10 object-contain">
                @else
                    <div class="text-2xl font-bold tracking-tighter text-white flex items-center gap-3">
                        <div class="relative w-10 h-10 flex items-center justify-center">
                            <div class="absolute inset-0 bg-gradient-to-tr from-cyan-400 to-blue-600 rounded-xl transform rotate-45 blur-sm opacity-60 animate-pulse"></div>
                            <div class="absolute inset-0 bg-gradient-to-tr from-cyan-400 to-blue-600 rounded-xl transform rotate-45 border border-white/30 shadow-[0_0_20px_rgba(56,189,248,0.6)]"></div>
                            <span class="relative z-10 text-white text-sm font-extrabold tracking-widest drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">TH</span>
                        </div>
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400 text-3xl font-extrabold drop-shadow-[0_2px_10px_rgba(255,255,255,0.2)]">Theo<span class="text-cyan-400">.</span></span>
                    </div>
                @endif
            </div>
            <nav class="hidden md:flex gap-8 text-sm font-medium text-gray-300">
                <a href="#about" class="hover:text-cyan-400 transition-colors">About Me</a>
                <a href="#pengalaman" class="hover:text-cyan-400 transition-colors">Pengalaman</a>
                <a href="#projek" class="hover:text-cyan-400 transition-colors">Projek</a>
                <a href="#galeri" class="hover:text-cyan-400 transition-colors">Galeri</a>
                <a href="#contact" class="hover:text-cyan-400 transition-colors">Discuss</a>
            </nav>
        </header>

        <!-- Hero Section -->
        <section class="container mx-auto px-8 md:px-16 min-h-[85vh] flex flex-col items-center justify-center pt-12 md:pt-0 text-center relative z-10">
            <div class="max-w-4xl flex flex-col items-center relative z-10">
                <div class="text-cyan-400 font-mono tracking-widest text-sm mb-6 uppercase flex items-center gap-3">
                    <span class="w-12 h-[1px] bg-cyan-400"></span> Welcome <span class="w-12 h-[1px] bg-cyan-400"></span>
                </div>
                <h1 class="text-[4rem] md:text-[6rem] lg:text-[7rem] font-extrabold leading-[0.9] tracking-tighter mb-6 mx-auto">
                    <span class="block">{{ $profile->hero_title_1 ?? 'Digital' }}</span>
                    <span class="block text-cyan-400 drop-shadow-[0_0_15px_rgba(56,189,248,0.3)]">{{ $profile->hero_title_highlight ?? 'solutions' }}</span>
                    <span class="block text-outline">{{ $profile->hero_title_outline ?? 'made easy.' }}</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-400 max-w-2xl mx-auto mb-10 font-light leading-relaxed">
                    {{ $profile->hero_subtitle }}
                </p>
                <a href="#projek" class="glass-button w-auto inline-flex items-center gap-2 relative z-10">
                    Eksplorasi Portofolio 
                    <svg class="w-5 h-5 animate-bounce mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                </a>
            </div>
        </section>

        <!-- About Me Section -->
        <section id="about" class="container mx-auto px-8 md:px-16 py-32 border-t border-white/5 bg-[#020617]/50 backdrop-blur-sm rounded-t-[4rem] relative z-10 mt-20">
            <h2 class="text-4xl md:text-5xl font-bold mb-16 tracking-tighter border-b border-white/10 pb-6">About <span class="text-cyan-400">Me</span></h2>
            
            <div class="glass-panel p-10 md:p-16 rounded-[2rem] flex flex-col lg:flex-row gap-16 lg:gap-20 items-center">
                
                <!-- Foto 3D Kiri -->
                <div class="w-64 h-64 md:w-80 md:h-80 shrink-0 relative interactive-container">
                    <div class="spotlight-overlay rounded-full"></div>
                    @if(isset($profile) && $profile->profile_photo)
                        <img src="{{ asset('storage/' . $profile->profile_photo) }}" alt="Theo" class="w-full h-full object-cover rounded-[4rem] md:rounded-[4rem_2rem_4rem_6rem] border border-white/10 shadow-2xl interactive-grayscale">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-cyan-400 to-blue-600 rounded-[4rem] md:rounded-[4rem_2rem_4rem_6rem] flex items-center justify-center text-4xl font-bold border border-white/10 shadow-2xl interactive-grayscale">TH</div>
                    @endif
                    <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-cyan-500/20 rounded-full blur-2xl"></div>
                </div>

                <!-- Detail Profile Kanan -->
                <div class="w-full lg:w-2/3 flex flex-col text-left">
                    <h3 class="text-4xl font-extrabold text-white mb-2">{{ $profile->full_name ?? 'Yosia Gracetheo Boimau' }}</h3>
                    <p class="text-cyan-400 font-mono text-lg mb-8">{{ $profile->job_title ?? 'Fullstack Developer' }}</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8 text-gray-300 mb-10">
                        <div>
                            <span class="text-gray-500 text-xs uppercase tracking-wider block mb-1">Tempat, Tanggal Lahir</span>
                            <span class="font-medium text-white">{{ $profile->birth_place_date ?? 'Malang, 26 April 2006' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 text-xs uppercase tracking-wider block mb-1">Email</span>
                            <span class="font-medium text-white">{{ $profile->email ?? 'yosiagracetheo0@gmail.com' }}</span>
                        </div>
                        <div class="md:col-span-2">
                            <span class="text-gray-500 text-xs uppercase tracking-wider block mb-1">Alamat Domisili</span>
                            <span class="font-medium text-white leading-relaxed">{{ $profile->address ?? 'JL.S.Supriadi VII 3, Malang, Jawa Timur, Indonesia' }}</span>
                        </div>
                    </div>

                    <!-- Social Media Links -->
                    <div class="flex flex-wrap gap-4 pt-6 border-t border-white/10">
                        <a href="{{ route('cv.download') }}" target="_blank" class="px-6 py-2 rounded-full glass-panel flex items-center gap-2 hover:bg-cyan-500/20 hover:border-cyan-400 text-cyan-300 font-bold hover:text-white transition group shadow-[0_0_15px_rgba(56,189,248,0.2)]">
                            <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Download CV
                        </a>
                        @foreach($socialMedias as $sm)
                            <a href="{{ $sm->url }}" target="_blank" class="px-4 py-2 rounded-full glass-panel flex items-center gap-3 hover:text-cyan-400 hover:border-cyan-400 transition group" title="{{ $sm->platform }}">
                                <!-- SVG Icon based on Platform -->
                                @if(strtolower($sm->platform) == 'github')
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0112 6.836c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.161 22 16.418 22 12c0-5.523-4.477-10-10-10z"/></svg>
                                @elseif(strtolower($sm->platform) == 'instagram')
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.849.07 1.366.062 2.633.344 3.608 1.319.975.975 1.257 2.242 1.319 3.608.058 1.265.07 1.645.07 4.849s-.012 3.584-.07 4.849c-.062 1.366-.344 2.633-1.319 3.608-.975.975-2.242 1.257-3.608 1.319-1.265.058-1.645.07-4.849.07s-3.584-.012-4.849-.07c-1.366-.062-2.633-.344-3.608-1.319-.975-.975-1.257-2.242-1.319-3.608-.058-1.265-.07-1.645-.07-4.849s.012-3.584.07-4.849c.062-1.366.344-2.633 1.319-3.608.975-.975 2.242-1.257 3.608-1.319 1.265-.058 1.645-.07 4.849-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.358 2.618 6.78 6.98 6.98 1.281.059 1.689.073 4.948.073s3.667-.014 4.947-.072c4.358-.2 6.78-2.618 6.98-6.98.059-1.281.073-1.689.073-4.948s-.014-3.667-.072-4.947c-.2-4.358-2.618-6.78-6.98-6.98-1.281-.059-1.689-.073-4.948-.073zM12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a4 4 0 110-8 4 4 0 010 8zm3.931-11.233a1.44 1.44 0 110 2.881 1.44 1.44 0 010-2.881z"/></svg>
                                @elseif(strtolower($sm->platform) == 'linkedin')
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                @elseif(strtolower($sm->platform) == 'twitter')
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.962-.689 1.8-1.56 2.46-2.548l-.047-.02z"/></svg>
                                @else
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2.001 13.999l-3.999-4 1.414-1.414 2.585 2.585 5.586-5.586 1.414 1.414-7 7z"/></svg>
                                @endif
                                <span class="font-medium text-sm text-gray-300 group-hover:text-white">{{ $sm->username }}</span>
                            </a>
                        @endforeach
                        
                        @if($socialMedias->isEmpty())
                            <p class="text-sm text-gray-500 italic">Belum ada tautan sosial media ditambahkan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Tech Stack & Percentage (Task 1 & 3) -->
        <section id="tech-stack" class="container mx-auto px-8 md:px-16 py-32 border-t border-white/5 bg-[#020617]/50 backdrop-blur-sm relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-outline tracking-tighter mb-4">Tech <span class="text-cyan-400" style="-webkit-text-stroke: 0;">Stack</span></h2>
                <p class="text-gray-400 max-w-xl mx-auto">Bahasa pemrograman yang paling sering saya gunakan berdasarkan data riwayat public repository GitHub.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                @if(isset($githubData['languages']) && !empty($githubData['languages']))
                    @foreach($githubData['languages'] as $lang => $percentage)
                        <div class="glass-panel p-8 rounded-[2.5rem] flex flex-col justify-center transform hover:scale-105 transition duration-300">
                            <div class="flex justify-between items-end mb-4">
                                <h3 class="text-2xl font-bold text-white">{{ $lang }}</h3>
                                <span class="text-cyan-400 font-mono text-xl">{{ $percentage }}%</span>
                            </div>
                            <div class="w-full bg-gray-800 rounded-full h-3 mb-2 overflow-hidden border border-white/5">
                                <div class="bg-gradient-to-r from-cyan-400 to-blue-500 h-3 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="col-span-1 border border-dashed border-gray-700 py-12 text-center text-gray-500 rounded-3xl w-full">Loading data GitHub...</p>
                @endif
            </div>
        </section>

        <!-- Pengalaman Section -->
        <section id="pengalaman" class="container mx-auto px-8 md:px-16 py-32 border-t border-white/5 bg-[#020617]/50 backdrop-blur-sm">
            <h2 class="text-4xl md:text-5xl font-bold mb-16 text-outline tracking-tighter">Pengalaman <span class="text-cyan-400" style="-webkit-text-stroke: 0;">& Pekerjaan</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($experiences as $exp)
                <div class="glass-panel p-10 rounded-[2.5rem] cursor-pointer" onclick="openModal('modal-exp-{{ $exp->id }}')">
                    <span class="text-sm font-mono text-cyan-400 mb-2 block">{{ $exp->year }}</span>
                    <h3 class="text-2xl font-bold mb-3 text-white">{{ $exp->title }}</h3>
                    <p class="text-gray-400 leading-relaxed line-clamp-3">{{ $exp->description }}</p>
                    <div class="mt-4 text-cyan-400 text-sm font-semibold flex items-center gap-2">Baca Detail <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></div>
                </div>
                @endforeach

                @if($experiences->isEmpty())
                <p class="col-span-1 border border-dashed border-gray-700 py-12 text-center text-gray-500 rounded-3xl">Coming Soon.</p>
                @endif
            </div>
        </section>

        <!-- Projek Section -->
        <section id="projek" class="container mx-auto px-8 md:px-16 py-32 bg-[#020617]/50 backdrop-blur-sm border-t border-white/5">
            <div class="flex flex-col items-end text-right mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-outline tracking-tighter">Projek <span class="text-blue-500" style="-webkit-text-stroke: 0;">Terbaru</span></h2>
                <p class="text-gray-400 mt-4 max-w-md">Karya yang saya bangun dari nol hingga menjadi solusi nyata.</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @foreach($projects as $proj)
                <div class="glass-panel rounded-[2.5rem] overflow-hidden group hover:-translate-y-2 hover:shadow-[0_0_25px_rgba(56,189,248,0.5)] transition-all interactive-container relative cursor-pointer" onclick="openModal('modal-proj-{{ $proj->id }}')">
                    <div class="spotlight-overlay"></div>
                    <div class="h-72 bg-gray-900 relative overflow-hidden">
                        @if($proj->image)
                            <img src="{{ asset('storage/' . $proj->image) }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 interactive-grayscale">
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-cyan-600/40 to-blue-900/40 group-hover:scale-110 transition-transform duration-500 interactive-grayscale"></div>
                        @endif
                    </div>
                    <div class="p-8 relative z-10">
                        <h3 class="text-xl font-bold mb-2 text-white">{{ $proj->title }}</h3>
                        <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $proj->description }}</p>
                        @if($proj->tags)
                        <span class="px-3 py-1 bg-white/10 rounded-full text-xs text-cyan-300 border border-white/10">{{ $proj->tags }}</span>
                        @endif
                    </div>
                </div>
                @endforeach

                @if($projects->isEmpty())
                <p class="col-span-3 border border-dashed border-gray-700 py-16 text-center text-gray-500 rounded-3xl">Belum ada karya ditambahkan.</p>
                @endif
            </div>
        </section>

        <!-- Galeri Section -->
        <section id="galeri" class="container mx-auto px-8 md:px-16 py-32 bg-[#020617]/50 backdrop-blur-sm border-t border-white/5">
            <h2 class="text-4xl md:text-5xl font-bold mb-16 text-outline tracking-tighter">Galeri <span class="text-purple-400" style="-webkit-text-stroke: 0;">Kegiatan</span></h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($activities as $act)
                <div class="glass-panel h-48 md:h-56 rounded-2xl relative overflow-hidden group interactive-container hover:shadow-[0_0_20px_rgba(168,85,247,0.4)] transition-all">
                    <div class="spotlight-overlay"></div>
                    <img src="{{ asset('storage/' . $act->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500 interactive-grayscale">
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center p-4 z-10">
                        <span class="text-white text-xs font-semibold text-center">{{ $act->caption }}</span>
                    </div>
                </div>
                @endforeach
                @if($activities->isEmpty())
                <div class="col-span-4 border border-dashed border-gray-700 py-16 text-center text-gray-500 rounded-3xl">Galeri masih kosong.</div>
                @endif
            </div>
        </section>

        <!-- Discuss a Project / Contact Form -->
        <section id="contact" class="container mx-auto px-8 md:px-16 py-32 bg-[#020617]/50 backdrop-blur-sm rounded-b-[4rem] border-t border-white/5 pb-40">
            <div class="glass-panel p-10 md:p-16 rounded-[3rem] border border-cyan-400/20 shadow-[0_0_50px_rgba(56,189,248,0.1)] max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold mb-8 text-outline tracking-tighter">Bahas <span class="text-emerald-400" style="-webkit-text-stroke: 0;">Projek Anda</span></h2>
                    <p class="text-gray-400 mb-8 max-w-lg mx-auto">Punya ide aplikasi atau butuh website profesional? Mari diskusikan kebutuhan Anda. Isi form di bawah dan saya akan merespon melalui email secepatnya.</p>
                </div>

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-400 mb-2">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="w-full bg-gray-900/50 border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-400 mb-2">Email Anda</label>
                        <input type="email" id="email" name="email" class="w-full bg-gray-900/50 border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" required>
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-400 mb-2">Tulis Daftar Projek / Ide Anda</label>
                        <textarea id="message" name="message" rows="5" class="w-full bg-gray-900/50 border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" required></textarea>
                    </div>
                    <button type="submit" class="w-full glass-button py-4 text-center justify-center flex hover:bg-emerald-500 hover:shadow-[0_0_20px_rgba(16,185,129,0.5)]">
                        Kirim Permintaan Diskusi
                    </button>
                </form>
            </div>
            
            @if(session('contact_success'))
            <!-- Toast Notification -->
            <div id="toast" class="fixed bottom-10 right-10 z-50 flex items-center glass-panel border-emerald-500/50 p-4 rounded-xl shadow-[0_0_20px_rgba(16,185,129,0.3)] animate-bounce">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-emerald-500 bg-emerald-100 rounded-lg">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                </div>
                <div class="ms-3 text-sm font-normal text-white">{{ session('contact_success') }}</div>
            </div>
            <script>
                setTimeout(function() {
                    let toast = document.getElementById('toast');
                    if(toast) {
                        toast.style.opacity = '0';
                        toast.style.transition = 'opacity 1s ease';
                        setTimeout(() => toast.remove(), 1000);
                    }
                }, 4000);
            </script>
            @endif
        </section>

        <!-- Footer -->
        <footer class="border-t border-white/10 py-8 relative z-10 text-center">
            <p class="text-sm text-gray-300 font-medium">Copyright &copy; {{ date('Y') }} Theo. All rights reserved.</p>
            <p class="text-xs text-gray-400 mt-2 hover:text-white transition"><a href="{{ route('login') }}">Access Admin</a></p>
        </footer>
    </div>

    <!-- Modals untuk Pengalaman -->
    @foreach($experiences as $exp)
    <div id="modal-exp-{{ $exp->id }}" class="fixed inset-0 z-[100] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm cursor-pointer" onclick="closeModal('modal-exp-{{ $exp->id }}')"></div>
        <div class="bg-[#020617]/70 backdrop-blur-3xl border border-white/10 rounded-[2.5rem] shadow-2xl p-8 md:p-12 max-w-2xl w-full mx-4 relative transform scale-95 transition-transform duration-300 max-h-[85vh] overflow-y-auto z-10 custom-scrollbar">
            <button class="absolute top-6 right-6 text-gray-400 hover:text-white transition" onclick="closeModal('modal-exp-{{ $exp->id }}')">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <span class="text-sm font-mono text-cyan-400 mb-2 block">{{ $exp->year }}</span>
            <h3 class="text-3xl font-bold mb-6 text-white">{{ $exp->title }}</h3>
            <p class="text-gray-300 leading-relaxed text-lg whitespace-pre-wrap">{{ $exp->long_description ?: $exp->description }}</p>
        </div>
    </div>
    @endforeach

    <!-- Modals untuk Projek -->
    @foreach($projects as $proj)
    <div id="modal-proj-{{ $proj->id }}" class="fixed inset-0 z-[100] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm cursor-pointer" onclick="closeModal('modal-proj-{{ $proj->id }}')"></div>
        <div class="bg-[#020617]/70 backdrop-blur-3xl border border-white/10 rounded-[2.5rem] shadow-2xl p-8 md:p-12 max-w-3xl w-full mx-4 relative transform scale-95 transition-transform duration-300 max-h-[85vh] overflow-y-auto z-10 custom-scrollbar">
            <button class="absolute top-6 right-6 text-gray-400 hover:text-white transition z-20" onclick="closeModal('modal-proj-{{ $proj->id }}')">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            
            @if($proj->image)
                <img src="{{ asset('storage/' . $proj->image) }}" class="w-full h-64 object-cover rounded-[1.5rem] mb-8 border border-white/10">
            @else
                <div class="w-full h-48 bg-gradient-to-br from-cyan-600/40 to-blue-900/40 rounded-[1.5rem] mb-8 border border-white/10 flex items-center justify-center text-gray-500">No Image</div>
            @endif
            
            <h3 class="text-3xl font-bold mb-4 text-white">{{ $proj->title }}</h3>
            @if($proj->tags)
            <div class="mb-6"><span class="px-3 py-1 bg-white/10 rounded-full text-sm text-cyan-300 border border-white/10">{{ $proj->tags }}</span></div>
            @endif
            <p class="text-gray-300 leading-relaxed text-lg whitespace-pre-wrap">{{ $proj->description }}</p>
            @if($proj->link)
            <div class="mt-8">
                <a href="{{ $proj->link }}" target="_blank" class="glass-button w-auto inline-flex items-center gap-2 text-sm px-6 py-2">Lihat Projek <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg></a>
            </div>
            @endif
        </div>
    </div>
    @endforeach

    <script>
        // Modal Handlers
        function openModal(id) {
            const modal = document.getElementById(id);
            if(modal) {
                modal.classList.remove('hidden');
                // Trigger reflow
                void modal.offsetWidth;
                modal.classList.remove('opacity-0');
                const content = modal.querySelector('.transform');
                if(content) {
                    content.classList.remove('scale-95');
                    content.classList.add('scale-100');
                }
                document.body.style.overflow = 'hidden';
            }
        }
        function closeModal(id) {
            const modal = document.getElementById(id);
            if(modal) {
                modal.classList.add('opacity-0');
                const content = modal.querySelector('.transform');
                if(content) {
                    content.classList.remove('scale-100');
                    content.classList.add('scale-95');
                }
                setTimeout(() => {
                    modal.classList.add('hidden');
                    document.body.style.overflow = '';
                }, 300);
            }
        }

        // Custom Cursor Trail Effect
        document.addEventListener('mousemove', (e) => {
            const trail = document.createElement('div');
            trail.className = 'cursor-trail';
            trail.style.left = e.pageX + 'px';
            trail.style.top = e.pageY + 'px';
            document.body.appendChild(trail);

            setTimeout(() => {
                trail.style.opacity = '0';
                trail.style.transform = 'scale(0.5)';
                setTimeout(() => trail.remove(), 500);
            }, 50);
        });

        // Spotlight Mouse tracking untuk semua interactive container
        document.querySelectorAll('.interactive-container').forEach(container => {
            container.addEventListener('mousemove', (e) => {
                const rect = container.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                container.style.setProperty('--x', `${x}px`);
                container.style.setProperty('--y', `${y}px`);
            });
        });

        // Setup Point-to-Point Network (Constellation Web)
        if(window.particlesJS && window.innerWidth > 768) {
            particlesJS('particles-js', {
                particles: {
                    number: { value: 60, density: { enable: true, value_area: 800 } },
                    color: { value: ["#38bdf8", "#818cf8"] }, // cyan and indigo
                    shape: { type: "circle" },
                    opacity: { value: 0.5, random: true, anim: { enable: true, speed: 1, opacity_min: 0.1, sync: false } },
                    size: { value: 3, random: true, anim: { enable: false } },
                    line_linked: {
                        enable: true,
                        distance: 150,
                        color: "#38bdf8",
                        opacity: 0.4,
                        width: 1.5
                    },
                    move: {
                        enable: true,
                        speed: 1.5,
                        direction: "none",
                        random: true,
                        straight: false,
                        out_mode: "out",
                        bounce: false,
                    }
                },
                interactivity: {
                    detect_on: "canvas",
                    events: {
                        onhover: { enable: true, mode: "grab" },
                        onclick: { enable: true, mode: "push" },
                        resize: true
                    },
                    modes: {
                        grab: { distance: 200, line_linked: { opacity: 0.8 } },
                        push: { particles_nb: 4 }
                    }
                },
                retina_detect: true
            });
        }
    </script>
    
    <style>
        .cursor-trail {
            position: absolute;
            width: 8px;
            height: 8px;
            background: rgba(56, 189, 248, 0.4);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            transition: opacity 0.5s ease, transform 0.5s ease;
            box-shadow: 0 0 10px rgba(56, 189, 248, 0.4);
            backdrop-filter: blur(2px);
        }
    </style>
</body>
</html>
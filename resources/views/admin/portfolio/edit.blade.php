<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Profil & Konten Depan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 glass-panel sm:rounded-[2rem]">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-white">Hero Section</h2>
                            <p class="mt-1 text-sm text-gray-400">Sesuaikan kalimat pembuka di halaman depan.</p>
                        </header>

                        <form method="post" action="{{ route('admin.portfolio.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div><x-input-label for="hero_title_1" value="Baris 1" /><x-text-input id="hero_title_1" name="hero_title_1" type="text" class="mt-1 block w-full glass-input" :value="old('hero_title_1', $profile->hero_title_1)" /></div>
                            <div><x-input-label for="hero_title_highlight" value="Baris 2 (Glow Cyan)" /><x-text-input id="hero_title_highlight" name="hero_title_highlight" type="text" class="mt-1 block w-full glass-input text-cyan-400" :value="old('hero_title_highlight', $profile->hero_title_highlight)" /></div>
                            <div><x-input-label for="hero_title_outline" value="Baris 3 (Outline)" /><x-text-input id="hero_title_outline" name="hero_title_outline" type="text" class="mt-1 block w-full glass-input" :value="old('hero_title_outline', $profile->hero_title_outline)" /></div>
                            <div>
                                <x-input-label for="hero_subtitle" value="Sub Judul (Deskripsi)" />
                                <textarea id="hero_subtitle" name="hero_subtitle" class="mt-1 block w-full glass-input rounded-md px-4 py-2" rows="3">{{ old('hero_subtitle', $profile->hero_subtitle) }}</textarea>
                            </div>

                            <hr class="border-gray-600 my-8">

                            <header>
                                <h2 class="text-lg font-medium text-white">Foto Profil 3D (Hero Banner)</h2>
                                <p class="mt-1 text-sm text-gray-400">Harap unggah foto dengan latar transparan (PNG) atau foto yang akan diubah ke efek kaca.</p>
                            </header>

                            <div>
                                <x-input-label for="profile_photo" value="Upload Foto Baru" />
                                @if($profile->profile_photo)
                                    <div class="mt-2 mb-4">
                                        <p class="text-sm text-gray-500 mb-1">Foto saat ini:</p>
                                        <img src="{{ asset('storage/' . $profile->profile_photo) }}" alt="Profile" class="w-32 h-32 object-cover rounded-xl border border-gray-600 shadow-lg">
                                    </div>
                                @endif
                                <img id="preview_profile" src="#" alt="Preview" class="hidden w-32 h-32 object-cover rounded-xl border border-cyan-500 mt-4 shadow-[0_0_15px_rgba(56,189,248,0.5)]">
                                <input id="profile_photo" name="profile_photo" type="file" onchange="previewImage(this, 'preview_profile')" class="mt-1 block w-full text-sm text-gray-300 border border-gray-600 rounded-md cursor-pointer bg-gray-800" />
                            </div>

                            <hr class="border-gray-600 my-8">

                            <header>
                                <h2 class="text-lg font-medium text-white">Logo Custom (Pojok Kiri Atas)</h2>
                                <p class="mt-1 text-sm text-gray-400">Kosongkan jika ingin menggunakan logo template bawaan.</p>
                            </header>
                            
                            <div>
                                <x-input-label for="logo_image" value="Upload Logo Kustom (PNG/JPG/SVG)" />
                                @if($profile->logo_image)
                                    <div class="mt-2 mb-4">
                                        <p class="text-sm text-gray-500 mb-1">Logo saat ini:</p>
                                        <img src="{{ asset('storage/' . $profile->logo_image) }}" alt="Logo" class="max-h-16 object-contain rounded border border-gray-600 bg-gray-900 p-2">
                                    </div>
                                @endif
                                <img id="preview_logo" src="#" alt="Preview Logo" class="hidden max-h-16 object-contain rounded border border-cyan-500 mt-4 bg-gray-900 p-2 shadow-[0_0_15px_rgba(56,189,248,0.5)]">
                                <input id="logo_image" name="logo_image" type="file" onchange="previewImage(this, 'preview_logo')" class="mt-1 block w-full text-sm text-gray-300 border border-gray-600 rounded-md cursor-pointer bg-gray-800" />
                            </div>

                            <hr class="border-gray-600 my-8">

                            <header>
                                <h2 class="text-lg font-medium text-white">About Me Section & CV</h2>
                                <p class="mt-1 text-sm text-gray-400">Data diri lengkap Anda untuk ditampilkan di Dashboard.</p>
                            </header>

                            <div><x-input-label for="full_name" value="Nama Lengkap" /><x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full glass-input" :value="old('full_name', $profile->full_name)" /></div>
                            <div><x-input-label for="job_title" value="Job Title / Profesi" /><x-text-input id="job_title" name="job_title" type="text" class="mt-1 block w-full glass-input" :value="old('job_title', $profile->job_title)" placeholder="Fullstack Developer" /></div>
                            <div><x-input-label for="birth_place_date" value="Tempat, Tanggal Lahir (TTL)" /><x-text-input id="birth_place_date" name="birth_place_date" type="text" class="mt-1 block w-full glass-input" :value="old('birth_place_date', $profile->birth_place_date)" /></div>
                            <div><x-input-label for="address" value="Alamat" /><textarea id="address" name="address" class="mt-1 block w-full glass-input rounded-md px-4 py-2" rows="3">{{ old('address', $profile->address) }}</textarea></div>
                            <div><x-input-label for="email" value="Email Publik" /><x-text-input id="email" name="email" type="email" class="mt-1 block w-full glass-input" :value="old('email', $profile->email)" /></div>
                            
                            <div class="mt-6 pt-6 border-t border-gray-700">
                                <x-input-label for="cv_file" value="Curriculum Vitae (PDF ATS-Friendly)" />
                                <div class="mt-2 mb-4 p-4 border border-cyan-500/30 bg-cyan-500/10 rounded-xl flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-cyan-400 mb-1">Fitur CV Auto-Generate Berbasis Database Aktif</p>
                                        <p class="text-xs text-gray-400 mb-3">Sistem otomatis menyusun dokumen PDF CV Anda berdasarkan data About Me, Pengalaman, dan Projek terbaru.</p>
                                        <a href="{{ route('cv.download') }}" target="_blank" class="text-white font-medium hover:underline text-sm flex items-center gap-2 inline-flex border border-gray-600 bg-gray-900 px-4 py-2 rounded-lg transition hover:bg-gray-800">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Generate & Download CV Sekarang
                                        </a>
                                    </div>
                                </div>
                                
                                <p class="text-xs text-gray-500 mt-2 italic">*Catatan: Upload manual CV ditiadakan karena PDF sudah dirender otomatis 100% dari data portofolio agar kompatibel dengan standar mesin ATS HRD.</p>
                            </div>
                            
                            <p class="text-sm text-cyan-400 mt-6 italic">*Untuk mengatur akun social media (Github, LinkedIn, IG, dll) silakan gunakan menu <b>Social Media</b> di navbar.</p>

                            <div class="flex items-center gap-4 pt-6 mt-6 border-t border-gray-600">
                                <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-300"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- Live Preview Script -->
    <script>
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var previewElement = document.getElementById(previewId);
                    previewElement.src = e.target.result;
                    previewElement.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
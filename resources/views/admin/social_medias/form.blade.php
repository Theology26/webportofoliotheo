<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ isset($socialMedia) ? 'Edit Social Media' : 'Tambah Social Media Baru' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-panel p-6 sm:p-8 sm:rounded-[2rem] text-white">
                <form action="{{ isset($socialMedia) ? route('admin.social_medias.update', $socialMedia) : route('admin.social_medias.store') }}" method="POST" class="space-y-6">
                    @csrf
                    @if(isset($socialMedia)) @method('PUT') @endif

                    <div>
                        <x-input-label for="platform" value="Platform (cth: Github, Instagram, Linkedin, Twitter)" />
                        <select id="platform" name="platform" class="mt-1 block w-full glass-input rounded-md px-4 py-2" required>
                            <option value="github" {{ (old('platform', $socialMedia->platform ?? '') == 'github') ? 'selected' : '' }} class="bg-gray-800 text-white">Github</option>
                            <option value="instagram" {{ (old('platform', $socialMedia->platform ?? '') == 'instagram') ? 'selected' : '' }} class="bg-gray-800 text-white">Instagram</option>
                            <option value="linkedin" {{ (old('platform', $socialMedia->platform ?? '') == 'linkedin') ? 'selected' : '' }} class="bg-gray-800 text-white">LinkedIn</option>
                            <option value="twitter" {{ (old('platform', $socialMedia->platform ?? '') == 'twitter') ? 'selected' : '' }} class="bg-gray-800 text-white">Twitter / X</option>
                            <option value="facebook" {{ (old('platform', $socialMedia->platform ?? '') == 'facebook') ? 'selected' : '' }} class="bg-gray-800 text-white">Facebook</option>
                        </select>
                    </div>

                    <div>
                        <x-input-label for="username" value="Username / Teks Label (cth: @theoxcyro)" />
                        <x-text-input id="username" name="username" type="text" class="mt-1 block w-full glass-input" value="{{ old('username', $socialMedia->username ?? '') }}" required />
                    </div>

                    <div>
                        <x-input-label for="url" value="URL Tautan / Link" />
                        <x-text-input id="url" name="url" type="url" class="mt-1 block w-full glass-input" value="{{ old('url', $socialMedia->url ?? '') }}" placeholder="https://..." required />
                    </div>

                    <div class="flex items-center gap-4 border-t border-gray-600 pt-6">
                        <x-primary-button>Simpan Data</x-primary-button>
                        <a href="{{ route('admin.social_medias.index') }}" class="text-gray-400 hover:text-white">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

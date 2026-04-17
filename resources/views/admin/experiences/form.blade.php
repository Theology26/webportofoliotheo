<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ isset($experience) ? 'Edit Pengalaman' : 'Tambah Pengalaman Baru' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-panel p-6 sm:p-8 sm:rounded-[2rem] text-white">
                <form action="{{ isset($experience) ? route('admin.experiences.update', $experience) : route('admin.experiences.store') }}" method="POST" class="space-y-6">
                    @csrf
                    @if(isset($experience)) @method('PUT') @endif

                    <div>
                        <x-input-label for="year" value="Tahun (cth: 2024 - 2025)" />
                        <x-text-input id="year" name="year" type="text" class="mt-1 block w-full glass-input" value="{{ old('year', $experience->year ?? '') }}" required />
                    </div>

                    <div>
                        <x-input-label for="title" value="Judul/Posisi (cth: Fullstack Developer)" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full glass-input" value="{{ old('title', $experience->title ?? '') }}" required />
                    </div>

                    <div>
                        <x-input-label for="description" value="Deskripsi Singkat" />
                        <textarea id="description" name="description" class="mt-1 block w-full glass-input rounded-md px-4 py-2" rows="2" required>{{ old('description', $experience->description ?? '') }}</textarea>
                    </div>

                    <div>
                        <x-input-label for="long_description" value="Deskripsi Panjang (Penjelasan Pas Diklik)" />
                        <textarea id="long_description" name="long_description" class="mt-1 block w-full glass-input rounded-md px-4 py-2" rows="6">{{ old('long_description', $experience->long_description ?? '') }}</textarea>
                    </div>

                    <div class="flex items-center gap-4 border-t border-gray-600 pt-6">
                        <x-primary-button>Simpan Data</x-primary-button>
                        <a href="{{ route('admin.experiences.index') }}" class="text-gray-400 hover:text-white">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

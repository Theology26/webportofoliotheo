<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ isset($project) ? 'Edit Projek' : 'Tambah Projek Baru' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-panel p-6 sm:p-8 sm:rounded-[2rem] text-white">
                <form action="{{ isset($project) ? route('admin.projects.update', $project) : route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @if(isset($project)) @method('PUT') @endif

                    <div>
                        <x-input-label for="title" value="Judul Projek" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full glass-input" value="{{ old('title', $project->title ?? '') }}" required />
                    </div>

                    <div>
                        <x-input-label for="tags" value="Teknologi / Label (cth: Laravel, Tailwind)" />
                        <x-text-input id="tags" name="tags" type="text" class="mt-1 block w-full glass-input" value="{{ old('tags', $project->tags ?? '') }}" />
                    </div>

                    <div>
                        <x-input-label for="description" value="Deskripsi Projek" />
                        <textarea id="description" name="description" class="mt-1 block w-full glass-input rounded-md px-4 py-2" rows="4" required>{{ old('description', $project->description ?? '') }}</textarea>
                    </div>

                    <div>
                        <x-input-label for="image" value="Thumbnail / Gambar Projek" />
                        @if(isset($project) && $project->image)
                            <div class="mt-2 mb-4">
                                <img src="{{ asset('storage/' . $project->image) }}" alt="Projek Image" class="w-48 h-32 object-cover rounded-xl border border-gray-600">
                            </div>
                        @endif
                        <input id="image" name="image" type="file" class="mt-1 block w-full text-sm text-gray-300 border border-gray-600 rounded-md cursor-pointer bg-gray-800" {{ isset($project) ? '' : 'required' }} />
                    </div>

                    <div class="flex items-center gap-4 border-t border-gray-600 pt-6">
                        <x-primary-button>Simpan Data</x-primary-button>
                        <a href="{{ route('admin.projects.index') }}" class="text-gray-400 hover:text-white">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

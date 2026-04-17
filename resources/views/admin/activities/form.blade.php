<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ isset($activity) ? 'Edit Foto Galeri' : 'Tambah Foto Galeri Baru' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-panel p-6 sm:p-8 sm:rounded-[2rem] text-white">
                <form action="{{ isset($activity) ? route('admin.activities.update', $activity) : route('admin.activities.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @if(isset($activity)) @method('PUT') @endif

                    <div>
                        <x-input-label for="image" value="Upload Foto" />
                        @if(isset($activity) && $activity->image)
                            <div class="mt-2 mb-4">
                                <img src="{{ asset('storage/' . $activity->image) }}" alt="Galeri" class="w-48 h-32 object-cover rounded-xl border border-gray-600">
                            </div>
                        @endif
                        <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-300 border border-gray-600 rounded-md cursor-pointer bg-gray-800" {{ isset($activity) ? '' : 'required' }} />
                    </div>

                    <div>
                        <x-input-label for="caption" value="Caption (Tambahan tulisan di foto, opsional)" />
                        <x-text-input id="caption" name="caption" type="text" class="mt-1 block w-full glass-input" value="{{ old('caption', $activity->caption ?? '') }}" />
                    </div>

                    <div class="flex items-center gap-4 border-t border-gray-600 pt-6">
                        <x-primary-button>Simpan Data</x-primary-button>
                        <a href="{{ route('admin.activities.index') }}" class="text-gray-400 hover:text-white">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

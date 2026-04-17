<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center text-white">
            <h2 class="font-semibold text-xl leading-tight">Projek Portofolio</h2>
            <a href="{{ route('admin.projects.create') }}" class="glass-button py-2 px-4 shadow-sm text-sm">Tambah Baru</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-panel p-6 sm:p-8 sm:rounded-[2rem] overflow-x-auto text-white">
                @if(session('success'))
                    <div class="mb-4 text-cyan-400">{{ session('success') }}</div>
                @endif
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-600">
                            <th class="py-3 px-4 w-24">Gambar</th>
                            <th class="py-3 px-4">Judul Projek</th>
                            <th class="py-3 px-4">Deskripsi</th>
                            <th class="py-3 px-4">Tags (Teknologi)</th>
                            <th class="py-3 px-4 w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $proj)
                        <tr class="border-b border-gray-700 hover:bg-white/5 transition">
                            <td class="py-3 px-4">
                                @if($proj->image) <img src="{{ asset('storage/' . $proj->image) }}" class="w-16 h-12 object-cover rounded"> @else <div class="w-16 h-12 bg-gray-800 rounded"></div> @endif
                            </td>
                            <td class="py-3 px-4 font-semibold">{{ $proj->title }}</td>
                            <td class="py-3 px-4 text-gray-400 text-sm">{{ Str::limit($proj->description, 50) }}</td>
                            <td class="py-3 px-4"><span class="px-2 py-1 bg-white/10 rounded text-xs">{{ $proj->tags }}</span></td>
                            <td class="py-3 px-4 flex gap-2 items-center h-full mt-2">
                                <a href="{{ route('admin.projects.edit', $proj) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                                <form action="{{ route('admin.projects.destroy', $proj) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if($projects->isEmpty())
                        <tr><td colspan="5" class="text-center py-16 text-gray-400">
                            <div class="flex flex-col items-center justify-center bg-gray-900/30 rounded-xl p-8 border border-white/5 mx-auto max-w-md">
                                <svg class="w-16 h-16 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                <p class="text-lg font-medium text-white mb-1">Belum ada data projek.</p>
                                <p class="text-sm">Klik 'Tambah Baru' di pojok kanan atas untuk mulai mengunggah karya pertama Anda.</p>
                            </div>
                        </td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

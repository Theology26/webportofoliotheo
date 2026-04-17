<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center text-white">
            <h2 class="font-semibold text-xl leading-tight">Galeri Kegiatan</h2>
            <a href="{{ route('admin.activities.create') }}" class="glass-button py-2 px-4 shadow-sm text-sm">Tambah Gambar</a>
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
                            <th class="py-3 px-4 w-32">Gambar</th>
                            <th class="py-3 px-4">Caption/Teks (Opsional)</th>
                            <th class="py-3 px-4 w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $act)
                        <tr class="border-b border-gray-700 hover:bg-white/5 transition">
                            <td class="py-3 px-4">
                                @if($act->image) <img src="{{ asset('storage/' . $act->image) }}" class="w-24 h-16 object-cover rounded"> @endif
                            </td>
                            <td class="py-3 px-4 text-gray-400 text-sm">{{ $act->caption ?? '-' }}</td>
                            <td class="py-3 px-4 flex gap-2 items-center h-full mt-4">
                                <a href="{{ route('admin.activities.edit', $act) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                                <form action="{{ route('admin.activities.destroy', $act) }}" method="POST" onsubmit="return confirm('Yakin hapus gambar ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if($activities->isEmpty())
                        <tr><td colspan="4" class="text-center py-16 text-gray-400">
                            <div class="flex flex-col items-center justify-center bg-gray-900/30 rounded-xl p-8 border border-white/5 mx-auto max-w-md">
                                <svg class="w-16 h-16 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="text-lg font-medium text-white mb-1">Belum ada foto galeri.</p>
                                <p class="text-sm">Klik 'Tambah Baru' di pojok kanan atas untuk mulai mengunggah memori kegiatan Anda.</p>
                            </div>
                        </td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center text-white">
            <h2 class="font-semibold text-xl leading-tight">Pengalaman & Karir</h2>
            <a href="{{ route('admin.experiences.create') }}" class="glass-button py-2 px-4 shadow-sm text-sm">Tambah Baru</a>
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
                            <th class="py-3 px-4">Tahun</th>
                            <th class="py-3 px-4">Judul/Posisi</th>
                            <th class="py-3 px-4">Deskripsi</th>
                            <th class="py-3 px-4 w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($experiences as $exp)
                        <tr class="border-b border-gray-700 hover:bg-white/5 transition">
                            <td class="py-3 px-4">{{ $exp->year }}</td>
                            <td class="py-3 px-4">{{ $exp->title }}</td>
                            <td class="py-3 px-4 text-gray-400 text-sm">{{ Str::limit($exp->description, 50) }}</td>
                            <td class="py-3 px-4 flex gap-2">
                                <a href="{{ route('admin.experiences.edit', $exp) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                                <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if($experiences->isEmpty())
                        <tr><td colspan="5" class="text-center py-16 text-gray-400">
                            <div class="flex flex-col items-center justify-center bg-gray-900/30 rounded-xl p-8 border border-white/5 mx-auto max-w-md">
                                <svg class="w-16 h-16 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <p class="text-lg font-medium text-white mb-1">Belum ada data pengalaman.</p>
                                <p class="text-sm">Klik 'Tambah Baru' di pojok kanan atas untuk mulai menulis riwayat karir Anda.</p>
                            </div>
                        </td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

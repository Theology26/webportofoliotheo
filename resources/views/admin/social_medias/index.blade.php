<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center text-white">
            <h2 class="font-semibold text-xl leading-tight">Pengaturan Social Media</h2>
            <a href="{{ route('admin.social_medias.create') }}" class="glass-button py-2 px-4 shadow-sm text-sm">Tambah Links</a>
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
                            <th class="py-3 px-4 w-32">Platform</th>
                            <th class="py-3 px-4">Username Tampil</th>
                            <th class="py-3 px-4">Link / URL URL</th>
                            <th class="py-3 px-4 w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($socialMedias as $sm)
                        <tr class="border-b border-gray-700 hover:bg-white/5 transition">
                            <td class="py-3 px-4 capitalize font-semibold text-cyan-300">{{ $sm->platform }}</td>
                            <td class="py-3 px-4">{{ $sm->username }}</td>
                            <td class="py-3 px-4 text-gray-400 text-sm"><a href="{{ $sm->url }}" target="_blank" class="hover:text-white underline">{{ $sm->url }}</a></td>
                            <td class="py-3 px-4 flex gap-2 items-center h-full">
                                <a href="{{ route('admin.social_medias.edit', $sm) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                                <form action="{{ route('admin.social_medias.destroy', $sm) }}" method="POST" onsubmit="return confirm('Yakin hapus tautan ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if($socialMedias->isEmpty())
                        <tr><td colspan="4" class="text-center py-16 text-gray-400">
                            <div class="flex flex-col items-center justify-center bg-gray-900/30 rounded-xl p-8 border border-white/5 mx-auto max-w-md">
                                <svg class="w-16 h-16 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                <p class="text-lg font-medium text-white mb-1">Daftar tautan masih kosong.</p>
                                <p class="text-sm">Silakan pilih platform andalan Anda dan tunjukkan eksistensi digital Anda kepada dunia.</p>
                            </div>
                        </td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

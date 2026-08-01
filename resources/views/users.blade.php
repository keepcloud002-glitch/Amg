<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen User / Pengguna
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="overflow-x-auto border border-gray-200 rounded-lg">
                    <table class="w-full text-left border-collapse whitespace-nowrap min-w-max">
                        <thead>
                            <tr class="bg-gray-100 border-b-2 border-gray-200">
                                <th class="py-3 px-4">ID</th>
                                <th class="py-3 px-4">Nama</th>
                                <th class="py-3 px-4">Email</th>
                                <th class="py-3 px-4">Role Saat Ini</th>
                                <th class="py-3 px-4 text-center">Ubah Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $u)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4">{{ $u->id }}</td>
                                <td class="py-3 px-4 font-bold">{{ $u->name }}</td>
                                <td class="py-3 px-4">{{ $u->email }}</td>
                                <td class="py-3 px-4">
                                    @if ($u->role === 'admin')
                                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">Admin</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded">Kasir</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @if ($u->id !== Auth::id())
                                        <form action="{{ route('users.updateRole', $u->id) }}" method="POST" class="inline-flex items-center gap-2 m-0">
                                            @csrf
                                            @method('PUT')
                                            <select name="role" class="border border-gray-300 rounded px-2 py-1 text-sm focus:outline-none">
                                                <option value="kasir" {{ $u->role === 'kasir' ? 'selected' : '' }}>Kasir</option>
                                                <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                            <button type="submit" class="bg-warna-utama hover:opacity-80 text-white py-1 px-3 rounded text-sm font-bold">
                                                Simpan
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-gray-400 italic">(Akun Anda)</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    <a href="{{ route('barang') }}" class="text-blue-600 hover:underline text-sm font-bold">&larr; Kembali ke Data Barang</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

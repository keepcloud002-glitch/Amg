<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Barang
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
  <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
    
    <form action="{{ route('barang') }}" method="GET" class="flex w-full sm:w-auto gap-2">
        <input type="text" name="cari" value="{{ request()->get('cari') }}" 
               placeholder="Cari nama barang..." 
               class="border border-gray-300 rounded px-3 py-2 text-sm w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded text-sm font-bold">
            Cari
        </button>
        @if(request()->get('cari'))
            <a href="{{ route('barang') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-3 py-2 rounded text-sm flex items-center">
                Reset
            </a>
        @endif
    </form>

    <div>
        <a href="{{ route('barang.tambah') }}" 
           class="inline-block bg-warna-utama hover:opacity-80 text-white font-bold py-2 px-4 rounded shadow text-sm">
            + Tambah Barang Baru
        </a>
    </div>
  </div>


                <div class="overflow-x-auto border border-gray-200 rounded-lg">
                    <table class="w-full text-left border-collapse whitespace-nowrap min-w-max">
                        <thead>
                            <tr class="bg-gray-100 border-b-2 border-gray-200">
                                <th class="py-3 px-4">ID</th>
                                <th class="py-3 px-4">Nama Barang</th>
                                <th class="py-3 px-4">Foto</th>
                                <th class="py-3 px-4">Kategori</th>
                                <th class="py-3 px-4">Harga</th>
                                <th class="py-3 px-4">Stok</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_barang as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4">{{ $item->id }}</td>
                                <td class="py-3 px-4">{{ $item->nama_barang }}</td>
                              <td class="py-3 px-4">
    @if($item->foto)
        <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" class="w-16 h-16 object-cover rounded border border-gray-200">
    @else
        <span class="text-gray-400 text-xs italic">Tanpa Foto</span>
    @endif
</td>

                                <td class="py-3 px-4">
    @if($item->kategori)
        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded">
       {{ $item->kategori->nama_kategori }}
        </span>
    @else
        <span class="text-gray-400 italic">Tanpa Kategori</span>
    @endif
                                </td>

                                <td class="py-3 px-4">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="py-3 px-4">{{ $item->stok }}</td>
                                
                                <td class="py-3 px-4 text-center whitespace-nowrap">
    <a href="{{ route('barang.edit', $item->id) }}" 
       class="inline-block bg-yellow-500 hover:opacity-80 text-white py-1 px-3 rounded font-bold mr-2 text-decoration-none">
        Edit
    </a>

    @if (Auth::user()->role === 'admin')
        <form action="{{ route('barang.hapus', $item->id) }}" method="POST" class="inline-block m-0">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="bg-warna-hapus hover:opacity-80 text-white py-1 px-3 rounded font-bold"
                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                Hapus
            </button>
        </form>
    @endif
                                  </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

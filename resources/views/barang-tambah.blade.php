<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Barang Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

              @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Berhasil!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
              @endif
              
                <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <strong class="font-bold">Oops! Ada yang salah:</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Barang:</label>
    <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                  
                    <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">Kategori Barang:</label>
    <select name="kategori_id" class="border border-gray-300 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    <option value="">-- Pilih Kategori --</option>
        @foreach($kategoris as $k)
    <option value="{{ $k->id }}">{{ $k->nama_kategori }}
    </option>
        @endforeach
    </select>
                    </div>

                    <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">Harga (Angka saja):</label>
    <input type="number" name="harga" value="{{ old('harga') }}" class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">Stok:</label>
    <input type="number" name="stok" value="{{ old('stok') }}" class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                     <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">Foto Barang (Opsional):</label>
    <input type="file" name="foto" accept="image/*" class="border border-gray-300 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
     
                    <div>
    <button type="submit" class="bg-warna-utama hover:opacity-60 text-white font-bold py-2 px-4 rounded transition duration-200 shadow">
                            Simpan Data
    </button>
                        
<a href="{{ route('barang') }}" class="ml-4 text-red-600 hover:underline">Batal</a>
                      
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

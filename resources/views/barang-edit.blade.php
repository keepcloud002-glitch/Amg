<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Data Barang
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
              
@if ($errors->any())
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
        <strong class="font-bold">Gagal Menyimpan!</strong>
        <ul class="list-disc pl-5 mt-2 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf 
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Barang:</label>
                        <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" class="border rounded w-full py-2 px-3 text-gray-700" required>
                    </div>

                     <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">Kategori Barang:</label>
    <select name="kategori_id" class="border border-gray-300 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategoris as $k)
            <option value="{{ $k->id }}" {{ $barang->kategori_id == $k->id ? 'selected' : '' }}>
                {{ $k->nama_kategori }}
            </option>
        @endforeach
    </select>
                    </div>
   
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Harga:</label>
                        <input type="number" name="harga" value="{{ $barang->harga }}" class="border rounded w-full py-2 px-3 text-gray-700" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Stok:</label>
                        <input type="number" name="stok" value="{{ $barang->stok }}" class="border rounded w-full py-2 px-3 text-gray-700" required>
                    </div>
                  
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Foto Barang:</label>
    @if($barang->foto)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $barang->foto) }}" alt="Foto Lama" class="w-20 h-20 object-cover rounded border border-gray-300">
            <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
        </div>
    @endif
    <input type="file" id="inputFoto" name="foto" accept="image/*" onchange="previewImage()" class="border border-gray-300 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
    <p class="text-xs text-gray-500 mt-1 italic">Biarkan kosong jika tidak ingin mengubah foto.</p>
    <img id="previewBaru" src="" alt="Preview Baru" class="hidden w-20 h-20 mt-2 object-cover rounded border border-blue-500 shadow-sm">
                    </div>

                    <div>
                        <button type="submit" class="bg-warna-utama hover:opacity-80 text-white font-bold py-2 px-4 rounded shadow">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('barang') }}" class="ml-4 text-red-600 hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
    function previewImage() {
        const input = document.getElementById('inputFoto');
        const preview = document.getElementById('previewBaru');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden'); // Memunculkan gambar yang disembunyikan
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</x-app-layout>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko AMG</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="h-screen flex items-center justify-center p-4">
        
        <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md text-center border border-gray-100">
            
            <div class="mb-4 inline-flex items-center justify-center w-16 h-16 bg-blue-100 text-blue-600 rounded-full text-2xl font-bold">
                🏪
            </div>

            @auth
                <!-- Tampilan Judul Jika Sudah Login (Memanggil Nama User) -->
                <h1 class="text-lg font-semibold text-gray-600 mb-1">
                    Selamat Datang Kembali,
                </h1>
                <h1 class="text-2xl font-extrabold text-blue-600 mb-2 uppercase">
                    {{ Auth::user()->name }}
                </h1>
            @else
                <!-- Tampilan Judul Jika Belum Login -->
                <h1 class="text-2xl font-extrabold text-gray-800 mb-2">
                    Selamat Datang di Toko Saya
                </h1>
            @endauth
            
            <p class="text-gray-600 text-sm mb-6">
                Sistem Manajemen Inventaris Barang Berbasis Laravel & Tailwind CSS.
            </p>

            <div class="flex flex-col gap-3">
                @auth
                    <!-- Tampilan Jika Pengguna Sudah Login -->
                    <a href="{{ url('/barang') }}" 
                       class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow transition duration-200">
                          Masuk Dashboard
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-bold py-2.5 px-4 rounded-xl transition duration-200 text-sm">
                          Logout (Keluar)
                        </button>
                    </form>
                @else
                    <!-- Tampilan Jika Pengguna Belum Login -->
                    <a href="{{ route('login') }}" 
                       class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow transition duration-200">
                        🔑 Login (Masuk)
                    </a>

                    <a href="{{ route('register') }}" 
                       class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-3 px-4 rounded-xl transition duration-200">
                        📝 Register (Daftar)
                    </a>
                @endauth
            </div>

            <p class="text-xs text-gray-500 mt-6">
                Awal Belajar Memakai Termux & Acode 🚀
            </p>

        </div>
    </div>

</body>
</html>

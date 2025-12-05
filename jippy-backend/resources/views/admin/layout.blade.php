<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>JIPPY Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50">

    <!-- NAVBAR ADMIN -->
   <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto flex items-center justify-between p-4">

        <div class="flex items-center gap-4">
            <img src="/frontend/assets/LOGO.png" alt="Jippy" class="w-[64px] h-[64px]">
            <h2 class="text-xl font-bold text-gray-700">JIPPY Admin</h2>
        </div>

        <nav class="flex gap-8 items-center">
            <a href="http://127.0.0.1:8000/admin/preorder" class="text-black font-medium hover:bg-[#fff2c9] px-4 py-1 rounded-lg transition">
                Dashboard
            </a>

            <a href="http://127.0.0.1:8000/admin/product/add"
               class="text-black font-medium hover:bg-[#fff2c9] px-4 py-1 rounded-lg transition">
                Tambah Produk
            </a>

            <a href="http://127.0.0.1:8000/admin/orders#"
               class="bg-[#FDE7A1] px-4 py-1 rounded-lg font-medium border border-black">
                Daftar Pesanan
            </a>
        </nav>
        
        <div class="flex gap-4 items-center">
            <img src="/frontend/assets/notif.png" class="w-[22px]">
            <img src="/frontend/assets/profil.png" class="w-[24px]">
        </div>

    </div>
</header>

    <!-- PAGE CONTENT -->
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow pt-10 mt-5">

        @yield('content')
    </div>

</body>
</html>

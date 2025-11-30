<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jippy Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="{{ asset('menu.css') }}">
</head>

<body class="bg-white">

<div class="min-h-screen flex flex-col">

    <!-- ⭐ HEADER -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto flex items-center justify-between p-4">

            <img src="{{ asset('assets/LOGO.png') }}" alt="Jippy" class="w-[64px] h-[64px]">

            <nav class="flex gap-10 items-center">
                <a href="/dashboard" class="bg-[#FDE7A1] px-4 py-1 rounded-lg font-medium border border-black">Dashboard</a>
                <a href="/preorder" class="hover:bg-[#fff2c9] px-4 py-1 rounded-lg">Pre-Order</a>
                <a href="/orders" class="hover:bg-[#fff2c9] px-4 py-1 rounded-lg">My Order</a>
                <a href="/chat" class="hover:bg-[#fff2c9] px-4 py-1 rounded-lg">Live Chat</a>
            </nav>

            <div class="flex gap-4 items-center">
                <img src="{{ asset('assets/notif.png') }}" class="w-[22px]">
                <img src="{{ asset('assets/profil.png') }}" class="w-[24px]">
            </div>

        </div>
    </header>

    <!-- ⭐ SEARCH BAR -->
    <div class="max-w-7xl mx-auto my-6 flex justify-end">
        <div class="relative">
            <input 
                type="text" 
                class="px-5 py-2 w-[280px] border border-black rounded-full focus:outline-none"
                placeholder="Search product">
            <img src="{{ asset('assets/search.png') }}" 
                 class="w-[20px] absolute right-4 top-2.5 opacity-70">
        </div>
    </div>

    <!-- ⭐ BANNER (BUTTON CENTER TURUN) -->
    <div class="max-w-7xl mx-auto px-4 mt-6">
        <div class="relative w-full">
            
            <img src="{{ asset('assets/new-arrival2.png') }}"
                 class="w-full h-[420px] object-cover rounded-lg shadow">

            <a href="/products"
               class="absolute inset-0 flex items-end justify-center pb-14">
                <button class="bg-pink-500 text-white px-8 py-3 rounded-xl shadow-lg 
                               text-lg font-semibold hover:bg-pink-600 transition">
                    Explore Now
                </button>
            </a>

        </div>
    </div>

    <!-- ⭐ CATEGORIES (HOVER GAMBAR SAJA) -->
    <div class="max-w-7xl mx-auto my-12 grid grid-cols-2 sm:grid-cols-4 gap-8 text-center">

        <!-- Korean Beauty -->
        <a href="/products?category=1" class="block">
            <div class="w-full">
                <img src="{{ asset('assets/beauty-category.png') }}" 
                     class="rounded-lg w-full transform hover:-translate-y-1 hover:scale-[1.05] hover:shadow-xl transition">
            </div>
            <div class="font-semibold mt-2">Korean Beauty</div>
        </a>

        <!-- Korean Fashion -->
        <a href="/products?category=2" class="block">
            <div class="w-full">
                <img src="{{ asset('assets/koreanfashion-category.png') }}" 
                     class="rounded-lg w-full transform hover:-translate-y-1 hover:scale-[1.05] hover:shadow-xl transition">
            </div>
            <div class="font-semibold mt-2">Korean Fashion</div>
        </a>

        <!-- K-Pop Merch -->
        <a href="/products?category=3" class="block">
            <div class="w-full">
                <img src="{{ asset('assets/kpop-category.png') }}" 
                     class="rounded-lg w-full transform hover:-translate-y-1 hover:scale-[1.05] hover:shadow-xl transition">
            </div>
            <div class="font-semibold mt-2">K-Pop Merch</div>
        </a>

        <!-- Korean Food -->
        <a href="/products?category=4" class="block">
            <div class="w-full">
                <img src="{{ asset('assets/koreanfood-category.png') }}" 
                     class="rounded-lg w-full transform hover:-translate-y-1 hover:scale-[1.05] hover:shadow-xl transition">
            </div>
            <div class="font-semibold mt-2">Korean Food</div>
        </a>

    </div>

    <!-- ⭐ NEW BEAUTIES -->
    <div class="max-w-7xl mx-auto my-10">
        <img src="{{ asset('assets/new-beauties.svg') }}" class="mx-auto">
    </div>

    <!-- ⭐ FOOTER -->
    <footer class="bg-[#FF96B5] py-6 mt-auto">
        <div class="max-w-6xl mx-auto text-sm text-white flex justify-between items-center">

            <div class="flex items-center space-x-3">
                <img src="{{ asset('assets/LOGO.png') }}" class="w-[35px]">
                <p>© Jippy 2025 - All Rights Reserved</p>
            </div>

            <div class="flex flex-col items-end space-y-3">
                <div class="flex gap-6">
                    <a href="/dashboard" class="hover:underline">Home</a>
                    <a href="/about" class="hover:underline">About Us</a>
                    <a href="/contact" class="hover:underline">Contact Person</a>
                </div>
                <div class="flex gap-4 text-xs">
                    <p>Terms of Use</p>
                    <p>Privacy Policy</p>
                    <p>Agreement</p>
                </div>
            </div>

        </div>
    </footer>

</div>

<script src="{{ asset('menu.js') }}"></script>
<script src="{{ asset('app.js') }}" defer></script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – Jippy</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="{{ asset('menu.css') }}">
</head>

<body class="bg-white">

<div class="min-h-screen flex flex-col">

    <!-- ⭐ HEADER -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto flex items-center justify-between p-4">

            <a href="/dashboard">
                <img src="{{ asset('assets/LOGO.png') }}" class="w-[64px] h-[64px]">
            </a>

            <nav class="hidden md:flex gap-10 items-center">
                <a href="/dashboard" class="bg-[#FDE7A1] px-4 py-1 rounded-lg border border-black">Dashboard</a>
                <a href="/preorder" class="hover:bg-[#fff2c9] px-4 py-1 rounded-lg">Pre-Order</a>
                <a href="/orders" class="hover:bg-[#fff2c9] px-4 py-1 rounded-lg">My Order</a>
                <a href="/chat" class="hover:bg-[#fff2c9] px-4 py-1 rounded-lg">Live Chat</a>
            </nav>

            <div class="flex items-center gap-6">
                <div class="relative">
                    <input 
                        type="text"
                        placeholder="Search product"
                        class="px-5 py-2 w-[280px] border border-black rounded-full focus:outline-none"
                    >
                    <img src="{{ asset('assets/search.png') }}" 
                         class="w-[20px] absolute right-4 top-2.5 opacity-70">
                </div>

                <img src="{{ asset('assets/notif.png') }}" class="w-[22px]">
                <img src="{{ asset('assets/profil.png') }}" class="w-[24px]">
            </div>

        </div>
    </header>

    <!-- ⭐ BANNER (BUTTON TURUN) -->
<div class="max-w-7xl mx-auto px-4 mt-6">
    <div class="relative w-full">

        <img src="{{ asset('assets/new-arrival2.png') }}" 
             class="w-full h-[500px] object-cover rounded-xl">

        <!-- BUTTON AGAK TURUN -->
        <a href="/products"
           class="absolute left-1/2 -translate-x-1/2 bottom-12">
            <span class="bg-pink-500 text-white px-8 py-3 
                         rounded-xl text-lg font-semibold 
                         shadow-lg hover:bg-pink-600 transition">
                Explore Now
            </span>
        </a>

    </div>
</div>


    <!-- ⭐ CATEGORIES -->
    <div class="max-w-7xl mx-auto px-4 mt-10 grid grid-cols-2 sm:grid-cols-4 gap-6">

        <a href="/products?category=1" class="text-center">
            <img src="{{ asset('assets/beauty-category.png') }}" class="rounded-lg w-full">
            <div class="mt-2 font-semibold">Korean Beauty</div>
        </a>

        <a href="/products?category=2" class="text-center">
            <img src="{{ asset('assets/koreanfashion-category.png') }}" class="rounded-lg w-full">
            <div class="mt-2 font-semibold">Korean Fashion</div>
        </a>

        <a href="/products?category=3" class="text-center">
            <img src="{{ asset('assets/kpop-category.png') }}" class="rounded-lg w-full">
            <div class="mt-2 font-semibold">K-Pop Merch</div>
        </a>

        <a href="/products?category=4" class="text-center">
            <img src="{{ asset('assets/koreanfood-category.png') }}" class="rounded-lg w-full">
            <div class="mt-2 font-semibold">Korean Food</div>
        </a>

    </div>

    <!-- ⭐ FOOTER -->
    <footer class="bg-[#FF96B5] py-4 mt-12 text-white">
        <div class="max-w-6xl mx-auto flex justify-between items-center">

            <div class="flex items-center space-x-3">
                <img src="{{ asset('assets/LOGO.png') }}" class="w-[35px]">
                <p class="text-xs">© Jippy 2025 - All Rights Reserved</p>
            </div>

            <div class="flex flex-col items-end space-y-3">
                <div class="flex gap-6 text-sm">
                    <a href="/dashboard" class="hover:underline">Home</a>
                    <a href="/about" class="hover:underline">About Us</a>
                    <a href="/contact" class="hover:underline">Contact Person</a>
                </div>
                <div class="flex gap-4 text-xs">
                    <p>Terms</p>
                    <p>Privacy</p>
                    <p>Agreement</p>
                </div>
            </div>

        </div>
    </footer>

</div>

<script src="{{ asset('menu.js') }}"></script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products – Jippy</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="{{ asset('menu.css') }}">

    @livewireStyles
</head>

<body class="bg-white">

<div class="min-h-screen flex flex-col">

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto flex items-center justify-between p-4">

            <a href="/dashboard">
                <img src="{{ asset('assets/LOGO.png') }}" class="w-[64px] h-[64px]">
            </a>

            <nav class="hidden md:flex gap-10 items-center">
                <a href="/dashboard" class="hover:bg-[#fff2c9] px-4 py-1 rounded-lg">Dashboard</a>
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


    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="relative">
            <input 
                type="text" 
                wire:model.live="search"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-300"
                placeholder="Search product">

            <img src="{{ asset('assets/search.png') }}" class="absolute right-4 top-3 w-5 opacity-60">
        </div>
    </div>


    <div class="flex-1">

        <div class="max-w-7xl mx-auto px-4 py-6">
            <h1 class="text-2xl font-bold">
                @if(request('category'))
                    {{ $categories->find(request('category'))->name ?? 'Products' }}
                @else
                    All Products
                @endif
            </h1>
        </div>


        <div class="max-w-7xl mx-auto px-4 pb-12 flex gap-6">


            <div class="w-64 shrink-0">
                <div class="border rounded-lg p-4 sticky top-24">

                    <h3 class="font-bold text-lg mb-4">Categories</h3>

                    <a 
                        href="/products"
                        class="block w-full text-left px-3 py-2 rounded-lg mb-2 transition
                        {{ !request('category') 
                            ? 'bg-pink-500 text-white font-semibold shadow-sm scale-[1.02]' 
                            : 'bg-white hover:bg-gray-100' }}">
                        All Products
                    </a>

                    @foreach($categories as $category)
                        <a 
                            href="/products?category={{ $category->id }}"
                            class="block w-full text-left px-3 py-2 rounded-lg mb-2 transition
                            {{ request('category') == $category->id
                                ? 'bg-pink-500 text-white font-semibold shadow-sm scale-[1.02]'
                                : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                            
                            {{ $category->name }}
                            <span class="text-xs text-gray-500">({{ $category->products_count }})</span>
                        </a>
                    @endforeach

                </div>
            </div>


            <div class="flex-1">

                @if ($products->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        @foreach ($products as $product)
                        <a href="#" class="block">
                            <div class="bg-white border rounded-lg overflow-hidden hover:shadow-lg transition">

                                <!-- Image -->
                                <div class="w-full h-48 bg-gray-100 flex items-center justify-center overflow-hidden">
                                    @if($product->image)
                                        <img src="{{ asset('storage/'.$product->image) }}"
                                             class="object-cover w-full h-full">
                                    @else
                                        <span class="text-gray-400">No Image</span>
                                    @endif
                                </div>

                                <div class="p-4">

                                    @if($product->category)
                                    <span class="text-xs bg-pink-100 text-pink-600 px-2 py-1 rounded">
                                        {{ $product->category->name }}
                                    </span>
                                    @endif

                                    <h3 class="text-lg mt-2 font-semibold text-gray-800">
                                        {{ $product->name }}
                                    </h3>

                                    @if($product->description)
                                    <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                                        {{ $product->description }}
                                    </p>
                                    @endif

                                    <div class="mt-4 flex justify-between items-center">
                                        <span class="text-xl font-bold text-pink-500">
                                            IDR {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                        <button class="bg-pink-500 text-white px-3 py-1 rounded-lg hover:bg-pink-600">
                                            Add
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </a>
                        @endforeach

                    </div>
                @else
                    <p class="text-center text-gray-500 py-12">No products available yet.</p>
                @endif

            </div>

        </div>

    </div>


    <!-- ⭐ FOOTER -->
    <footer class="bg-[#FF96B5] py-4 text-white mt-auto">
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

@livewireScripts
<script src="{{ asset('menu.js') }}"></script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jippy Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
   
    <link rel="stylesheet" href="{{ asset('menu.css') }}">
    <style>
.scrollbar-hide::-webkit-scrollbar { display: none; }
.scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
html {
        scroll-padding-top: 250px; /* Atur jarak sesuai keinginan, misal 80–160px */
    }
</style>

</head>

<body class="bg-white">

<div class="min-h-screen flex flex-col">

 <header class="bg-white shadow">
    <div class="max-w-7xl  mx-auto flex items-center justify-between p-4">
      <img src="/frontend/assets/LOGO.png" alt="Jippy" class="w-[64px] h-[64px]">
      <nav class="flex gap-10 items-center">
        <a href="http://127.0.0.1:8001/" class="bg-[#FDE7A1] px-4 py-1 rounded-lg font-medium border border-black">Dashboard</a>
        <a href="http://127.0.0.1:8000/preorder.html" class="text-black font-medium cursor-pointer hover:bg-[#fff2c9] hover:text-black rounded-lg transition duration-300 px-4 py-1">Pre-Order</a>
        <a href="http://127.0.0.1:8000/tracking" class="text-black font-medium cursor-pointer hover:bg-[#fff2c9] hover:text-black rounded-lg transition duration-300 px-4 py-1">My Order</a>
        <a href="/frontend/LiveChat.html" class="text-black font-medium cursor-pointer hover:bg-[#fff2c9] hover:text-black rounded-lg transition duration-300 px-4 py-1">Live Chat</a>
      </nav>
      <div class="flex gap-4 items-center">
        <button><img src="/frontend/assets/notif.png" alt="Notifikasi" class="w-[22px]"></button>
        <button><img src="/frontend/assets/profil.png" alt="Akun" class="w-[24px]"></button>
      </div>
    </div>
  </header>



    <div class="max-w-7xl mx-auto px-4 mt-6">
        <div class="relative w-full">
            
            <img src="{{ asset('assets/new-arrival2.png') }}"
                 class="w-full h-[420px] object-cover rounded-lg shadow">

            <a href="#new-arrivals"

               class="absolute inset-0 flex items-end justify-center pb-14">
                <button class="bg-pink-500 text-white px-8 py-3 rounded-xl shadow-lg 
                               text-lg font-semibold hover:bg-pink-600 transition">
                    Explore Now
                </button>
            </a>

        </div>
    </div>

    <div class="max-w-7xl mx-auto my-12 grid grid-cols-2 sm:grid-cols-4 gap-8 text-center">

        <a href="#beauty" class="block">
            <div class="w-full">
                <img src="{{ asset('assets/beauty-category.png') }}" 
                     class="rounded-lg w-full transform hover:-translate-y-1 hover:scale-[1.05] hover:shadow-xl transition">
            </div>
            <div class="font-semibold mt-2">Korean Beauty</div>
        </a>

        <a href="#fashion" class="block">
            <div class="w-full">
                <img src="{{ asset('assets/koreanfashion-category.png') }}" 
                     class="rounded-lg w-full transform hover:-translate-y-1 hover:scale-[1.05] hover:shadow-xl transition">
            </div>
            <div class="font-semibold mt-2">Korean Fashion</div>
        </a>

        <a href="#kpop" class="block">
            <div class="w-full">
                <img src="{{ asset('assets/kpop-category.png') }}" 
                     class="rounded-lg w-full transform hover:-translate-y-1 hover:scale-[1.05] hover:shadow-xl transition">
            </div>
            <div class="font-semibold mt-2">K-Pop Merch</div>
        </a>

        <a href="#food" class="block">
            <div class="w-full">
                <img src="{{ asset('assets/koreanfood-category.png') }}" 
                     class="rounded-lg w-full transform hover:-translate-y-1 hover:scale-[1.05] hover:shadow-xl transition">
            </div>
            <div class="font-semibold mt-2">Korean Food</div>
        </a>

    </div>

    <div class="max-w-7xl mx-auto my-10">
        <img src="{{ asset('assets/new-beauties.svg') }}" class="mx-auto">
    </div>
 <!-- ⭐ NEW ARRIVALS — HORIZONTAL SLIDER -->
<div id="new-arrivals" class="max-w-7xl mx-auto px-4 mt-10 mb-16">

    <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">New Arrivals</h2>

    <div class="flex justify-center gap-6 overflow-x-auto pb-4 scrollbar-hide">
        @foreach($featuredProducts as $product)
        <a href="http://127.0.0.1:8000//detailpo.html?id={{ $product->id }}" 
   class="min-w-[180px] group block">

            <div class="w-full h-[220px] bg-gray-100 rounded-2xl overflow-hidden shadow-sm 
                        group-hover:shadow-lg transition-all duration-300 group-hover:scale-[1.03]">
                
                @if($product->image)
                    <img src="{{ asset('storage/products/'.$product->image) }}"

                         class="w-full h-full object-cover">
                @else
                    <div class="flex items-center justify-center h-full text-gray-400">
                        No Image
                    </div>
                @endif
            </div>

            <div class="mt-2 text-center">
                <p class="text-sm font-medium text-gray-700 group-hover:text-pink-500 transition">
                    {{ $product->name }}
                </p>
                <p class="text-sm text-gray-900">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>
            </div>

        </a>
        @endforeach

    </div>
</div>
{{-- KOREAN BEAUTY --}}
<div id="beauty" class="max-w-7xl mx-auto px-4 mt-20 mb-10">
    <h2 class="text-2xl font-bold mb-6 text-center">Korean Beauty</h2>

    <div class="flex justify-center gap-6 overflow-x-auto pb-3 scrollbar-hide">
        @foreach($beautyProducts as $product)
            <a href="http://127.0.0.1:8000//detailpo.html?id={{ $product->id }}" 
   class="min-w-[180px] group block">

                <div class="h-[220px] w-full bg-gray-100 rounded-xl overflow-hidden group-hover:scale-[1.03] transition">
                    <img src="{{ asset('storage/products/'.$product->image) }}" class="object-cover w-full h-full">
                </div>
                <p class="text-sm text-center font-semibold mt-2">{{ $product->name }}</p>
                <p class="text-center text-gray-700">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </a>
        @endforeach
    </div>
</div>

{{-- KOREAN FASHION --}}
<div id="fashion" class="max-w-7xl mx-auto px-4 mt-20 mb-10">
    <h2 class="text-2xl font-bold mb-6 text-center">Korean Fashion</h2>

    <div class="flex justify-center gap-6 overflow-x-auto pb-3 scrollbar-hide">
        @foreach($fashionProducts as $product)
            <a href="http://127.0.0.1:8000//detailpo.html?id={{ $product->id }}" 
   class="min-w-[180px] group block">

                <div class="h-[220px] w-full bg-gray-100 rounded-xl overflow-hidden group-hover:scale-[1.03] transition">
                    <img src="{{ asset('storage/products/'.$product->image) }}" class="object-cover w-full h-full">
                </div>
                <p class="text-sm text-center font-semibold mt-2">{{ $product->name }}</p>
                <p class="text-center text-gray-700">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </a>
        @endforeach
    </div>
</div>

{{-- K-POP MERCH --}}
<div id="kpop" class="max-w-7xl mx-auto px-4 mt-20 mb-10">
    <h2 class="text-2xl font-bold mb-6 text-center">K-Pop Merch</h2>

    <div class="flex justify-center gap-6 overflow-x-auto pb-3 scrollbar-hide">
        @foreach($kpopProducts as $product)
            <a href="http://127.0.0.1:8000//detailpo.html?id={{ $product->id }}" 
   class="min-w-[180px] group block">

                <div class="h-[220px] w-full bg-gray-100 rounded-xl overflow-hidden group-hover:scale-[1.03] transition">
                    <img src="{{ asset('storage/products/'.$product->image) }}" class="object-cover w-full h-full">
                </div>
                <p class="text-sm text-center font-semibold mt-2">{{ $product->name }}</p>
                <p class="text-center text-gray-700">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </a>
        @endforeach
    </div>
</div>

{{-- KOREAN FOOD --}}
<div id="food" class="max-w-7xl mx-auto px-4 mt-20 mb-40">

    <h2 class="text-2xl font-bold mb-6 text-center">Korean Food</h2>

    <div class="flex justify-center gap-6 overflow-x-auto pb-3 scrollbar-hide">
        @foreach($foodProducts as $product)
            <a href="http://127.0.0.1:8000//detailpo.html?id={{ $product->id }}" 
   class="min-w-[180px] group block">

                <div class="h-[220px] w-full bg-gray-100 rounded-xl overflow-hidden group-hover:scale-[1.03] transition">
                    <img src="{{ asset('storage/products/'.$product->image) }}" class="object-cover w-full h-full">
                </div>
                <p class="text-sm text-center font-semibold mt-2">{{ $product->name }}</p>
                <p class="text-center text-gray-700">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </a>
        @endforeach
    </div>
</div>



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
<script>
    // ⚡ Explore Now dengan offset kecil
    document.querySelector('a[href="#new-arrivals"]').addEventListener("click", function(e){
        e.preventDefault();
        const target = document.getElementById("new-arrivals");

        const y = target.getBoundingClientRect().top + window.scrollY - 20; // offset kecil

        window.scrollTo({
            top: y,
            behavior: "smooth"
        });
    });

    // ⚡ Semua kategori: Beauty, Fashion, Kpop, Food → offset lebih besar
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        const id = link.getAttribute("href");

        if (id !== "#new-arrivals") {  
            link.addEventListener("click", function(e){
                e.preventDefault();

                const target = document.querySelector(id);
                if (!target) return;

                const y = target.getBoundingClientRect().top + window.scrollY - 200;

                window.scrollTo({
                    top: y,
                    behavior: "smooth"
                });
            });
        }
    });
</script>

</body>
</html>

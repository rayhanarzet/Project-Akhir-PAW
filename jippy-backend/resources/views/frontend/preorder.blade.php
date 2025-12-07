<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Order - JIPPY</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="{{ asset('frontend/style.css') }}" rel="stylesheet">
    <style>
        .container input { appearance: none; width: 15px; height: 15px; border: 2px solid #ccc; border-radius: 4px; background-color: white; display: inline-block; position: relative; cursor: pointer; transition: all 0.2s ease-in-out; }
        .container input:checked { border-color: #FF96B5; }
        .container input:checked::after { content: ""; position: absolute; left: 4px; top: 1px; width: 4px; height: 8px; border: solid #FF96B5; border-width: 0 2px 2px 0; transform: rotate(45deg); }
        
        .range-slider { -webkit-appearance: none; height: 6px; background: linear-gradient(to right, #FF96B5 0%, #FF96B5 100%, #e5e7eb 100%, #e5e7eb 100%); border-radius: 5px; outline: none; transition: background 450ms ease-in; }
        .range-slider::-webkit-slider-thumb { -webkit-appearance: none; height: 16px; width: 16px; border-radius: 50%; background: #FF96B5; cursor: pointer; border: 2px solid white; box-shadow: 0 0 2px rgba(0, 0, 0, 0.3); position: relative; z-index: 2; }
        
        #loading-overlay { position: fixed; inset: 0; background: rgba(255, 255, 255, 0.9); display: flex; flex-direction: column; align-items: center; justify-content: center; z-index: 9999; font-family: sans-serif; }
        .loader { border: 4px solid #f3f3f3; border-top: 4px solid #FF96B5; border-radius: 50%; width: 45px; height: 45px; animation: spin 1s linear infinite; margin-bottom: 16px; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>

<body>
  <div id="loading-overlay">
    <div class="loader"></div>
    <p class="text-gray-600 text-sm mt-2">Memuat Produk...</p>
  </div>

  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto flex items-center justify-between p-4">
      <img src="{{ asset('frontend/assets/LOGO.png') }}" alt="Jippy" class="w-[64px] h-[64px]">
      <nav class="flex gap-10 items-center">
        <a href="/" class="text-black font-medium cursor-pointer hover:bg-[#fff2c9] hover:text-black rounded-lg transition duration-300 px-4 py-1">Home</a>
        <a href="{{ route('preorder') }}" class="bg-[#FDE7A1] px-4 py-1 rounded-lg font-medium border border-black">Pre-Order</a>
        <a href="{{ route('track.order') }}" class="text-black font-medium cursor-pointer hover:bg-[#fff2c9] hover:text-black rounded-lg transition duration-300 px-4 py-1">My Order</a>
        <a href="{{ route('livechat') }}" class="text-black font-medium cursor-pointer hover:bg-[#fff2c9] hover:text-black rounded-lg transition duration-300 px-4 py-1">Live Chat</a>
      </nav>
      <div class="flex gap-4 items-center">
        <button><img src="{{ asset('frontend/assets/notif.png') }}" alt="Notifikasi" class="w-[22px]"></button>
        <button><img src="{{ asset('frontend/assets/profil.png') }}" alt="Akun" class="w-[24px]"></button>
      </div>
    </div>
  </header>

    <section class="flex items-center justify-between py-6 max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold">Produk Pre-Order</h1>
        <div class="relative w-5/7">
            <input id="searchInput" type="search" placeholder="Cari Produk" class="w-full h-10 rounded-lg border border-gray-300 pl-10 pr-10 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-400" />
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
            </svg>
        </div>
    </section>

    <section class="flex pb-10 max-w-6xl mx-auto justify-between ">
        <aside class="w-64 space-y-6 flex-shrink-0">
            <div class="bg-white rounded-lg border border-[#706E6E] p-4">
                <h3 class="text-black font-semibold text-xl mb-3 mt-1">Kategori</h3>
                <label class="flex items-center mb-2 container text-sm">
                    <input type="checkbox" class="category-checkbox mr-2" data-category="beauty"> <span class="ml-2">Korean Beauty</span>
                </label>
                <label class="flex items-center mb-2 container text-sm">
                    <input type="checkbox" class="category-checkbox mr-2" data-category="fashion"> <span class="ml-2">Korean Fashion</span>
                </label>
                <label class="flex items-center mb-2 container text-sm">
                    <input type="checkbox" class="category-checkbox mr-2" data-category="food"> <span class="ml-2">Korean Food</span>
                </label>
                <label class="flex items-center mb-2 container text-sm">
                    <input type="checkbox" class="category-checkbox mr-2" data-category="kpop"> <span class="ml-2">KPOP Merchandise</span>
                </label>

                <h3 class="text-black font-semibold text-xl mb-1 mt-7">Harga Maksimum</h3>
                <input type="range" id="priceRange" min="50000" max="2000000" step="10000" value="2000000" class="w-full range-slider">
                <div class="flex justify-end text-sm text-gray-600 mt-2">
                    <span>Max: <span id="priceValue">Rp 2.000.000</span></span>
                </div>
            </div>
            
            <div class="bg-[#FFE8EF] p-4 rounded-lg relative mt-10">
                <div class="flex relative top-[-30px] left-[-30px]">
                    <img src="{{ asset('frontend/assets/icon.png') }}" class="w-fit">
                    <div class="bg-[#E2F8FF] absolute left-10 py-2 px-3 rounded-full font-bold text-sm">Cara Pre-Order</div>
                </div>
                <ul class="space-y-3 text-gray-800 text-xs relative top-[-15px]">
                    <li class="flex items-start"><span class="text-[#B29FFF] mr-2">✿</span>Pilih produk yang diinginkan</li>
                    <li class="flex items-start"><span class="text-[#B29FFF] mr-2">✿</span>Klik tombol "Lihat Detail"</li>
                    <li class="flex items-start"><span class="text-[#B29FFF] mr-2">✿</span>Lakukan pembayaran</li>
                </ul>
            </div>
        </aside>

        <main id="product-list" class="flex-1 ml-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 content-start">
            </main>
    </section>

    <footer class="bg-[#FF96B5] py-4 mt-auto">
        <div class="max-w-6xl container mx-auto text-sm text-white flex justify-between items-center">
            <div class="flex item-center space-x-4">
                <img src="{{ asset('frontend/assets/LOGO.png') }}" alt="Jippy" class="w-[35px] h-[35px]">
                <p class="mt-2">© Jippy 2025</p>
            </div>
            <div class="text-right space-y-1">
                <p>Privacy Policy • Terms of Use</p>
            </div>
        </div>
    </footer>

<script>

const overlay = document.getElementById("loading-overlay");
const container = document.getElementById("product-list");

const productsFromLaravel = @json($products); 

let allProducts = [];
let filteredProducts = [];

document.addEventListener("DOMContentLoaded", () => {
    overlay.style.display = "none";
    allProducts = productsFromLaravel;
    filteredProducts = productsFromLaravel;
    
    const urlParams = new URLSearchParams(window.location.search);
    const categoryParam = urlParams.get('category');
    
    if(categoryParam) {
        document.querySelectorAll(`.category-checkbox[data-category="${categoryParam}"]`).forEach(cb => cb.checked = true);
        applyFilters(); 
    } else {
        renderProducts(allProducts);
    }
});


function renderProducts(list) {
  container.innerHTML = "";

  if(list.length === 0) {
      container.innerHTML = `<div class="col-span-3 text-center py-20 text-gray-500">Produk tidak ditemukan.</div>`;
      return;
  }

  list.forEach(p => {
    const imgSrc = p.image ? `/uploads/products/${p.image}` : '/frontend/assets/LOGO.png';
    container.innerHTML += `
    <article class="w-[240px] bg-white rounded-xl shadow border border-gray-200 overflow-hidden hover:shadow-lg transition-transform duration-300 hover:-translate-y-1 mx-auto flex flex-col">
        
        <div class="h-[180px] w-full bg-gray-50 overflow-hidden">
            <img 
                src="${imgSrc}" 
                alt="${p.name}"
                class="w-full h-full object-cover"
                onerror="this.src='/frontend/assets/logo.png'"
            />
        </div>

        <div class="p-4 flex-1 flex flex-col">
            <p class="text-[10px] text-blue-500 font-bold uppercase mb-1 tracking-wide">
                ${p.category || 'General'}
            </p>

            <h3 class="text-gray-800 font-bold text-sm mb-2 line-clamp-2 h-[40px] leading-tight">
                ${p.name}
            </h3>

            <div class="mt-auto mb-3 text-xs text-gray-500 italic">
                Close PO: ${p.close_po_date || '-'}
            </div>

            <a href="/product/${p.id}" 
               class="block w-full bg-[#FF96B5] hover:bg-[#ff7da4] text-white text-center font-bold py-2 rounded-lg text-xs transition-colors">
               Lihat Detail
            </a>
        </div>
    </article>
    `;
  });
}

const checkboxes = document.querySelectorAll(".category-checkbox");
const priceRange = document.getElementById("priceRange");
const priceValue = document.getElementById("priceValue");
const searchInput = document.getElementById("searchInput");

checkboxes.forEach(cb => cb.addEventListener("change", applyFilters));
searchInput.addEventListener("input", applyFilters);
priceRange.addEventListener("input", () => {
    priceValue.textContent = "Rp " + parseInt(priceRange.value).toLocaleString("id-ID");
    applyFilters();
});

function applyFilters() {
    const selectedCategories = Array.from(checkboxes)
        .filter(cb => cb.checked)
        .map(cb => cb.getAttribute("data-category").toLowerCase());

    const maxPrice = parseInt(priceRange.value);
    const searchQuery = searchInput.value.toLowerCase();

    filteredProducts = allProducts.filter(prod => {
        const prodCat = (prod.category || "").toLowerCase();
        const categoryMatch = selectedCategories.length === 0 || 
                              selectedCategories.some(c => prodCat.includes(c));

        const priceMatch = prod.price <= maxPrice;

        const searchMatch = prod.name.toLowerCase().includes(searchQuery);

        return categoryMatch && priceMatch && searchMatch;
    });

    renderProducts(filteredProducts);
}
</script>
</body>
</html>

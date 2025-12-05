<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout - {{ $product->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="Mid-client-78zFNz_sO6aycR-B">
    </script>
    <style>
        /* Spinner Loading */
        #loading-overlay { position: fixed; inset: 0; background: rgba(255, 255, 255, 0.95); display: flex; flex-direction: column; align-items: center; justify-content: center; z-index: 9999; display: none; }
        .loader { border: 4px solid #f3f3f3; border-top: 4px solid #FF96B5; border-radius: 50%; width: 45px; height: 45px; animation: spin 1s linear infinite; margin-bottom: 12px; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>

<body class="bg-white font-sans text-gray-800">

<div id="loading-overlay">
    <div class="loader"></div>
    <p class="text-gray-600 text-sm">Memproses Pesanan...</p>
</div>

<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto flex items-center justify-between p-4">
      <img src="{{ asset('frontend/assets/LOGO.png') }}" alt="Jippy" class="w-[64px] h-[64px]">
      <nav class="flex gap-10 items-center">
        <a href="{{ route('dashboard') }}" class="text-black font-medium cursor-pointer hover:bg-[#fff2c9] hover:text-black rounded-lg transition duration-300 px-4 py-1">Dashboard</a>
        <a href="{{ route('preorder') }}" class="bg-[#FDE7A1] px-4 py-1 rounded-lg font-medium border border-black">Pre-Order</a>
        <a href="{{ route('track.order') }}" class="text-black font-medium cursor-pointer hover:bg-[#fff2c9] hover:text-black rounded-lg transition duration-300 px-4 py-1">My Order</a>
        <a href="{{ route('livechat') }}" class="text-black font-medium cursor-pointer hover:bg-[#fff2c9] hover:text-black rounded-lg transition duration-300 px-4 py-1">Live Chat</a>
      </nav>
      <div class="flex gap-4 items-center">
        <button><img src="{{ asset('frontend/assets/notif.png') }}" class="w-[22px]"></button>
        <button><img src="{{ asset('frontend/assets/profil.png') }}" class="w-[24px]"></button>
      </div>
    </div>
</header>

<div class="max-w-6xl mx-auto px-4 py-4 text-black text-sm">
    <a href="{{ route('preorder') }}" class="hover:text-pink-400">Pre-Order</a> >
    <span class="font-semibold">Checkout</span>
</div>

<h1 class="text-center text-2xl font-bold mt-4">Checkout</h1>

<div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 mt-6 mb-20 px-4">

    <div class="bg-[#FFE8EF] rounded-xl p-6 border border-[#FFC6D5] h-fit">
        <h2 class="font-bold text-lg mb-6 mt-2 flex items-center gap-2">
            <span>📦</span> Rincian Pesanan
        </h2>

        <div class="bg-white p-4 rounded-xl border">
            <div class="flex gap-4">
                <img src="{{ asset('uploads/products/' . $product->image) }}" 
                     class="w-28 h-28 rounded-lg border object-cover"
                     onerror="this.src='{{ asset('frontend/assets/logo.png') }}'">

                <div class="flex-1">
                    <h3 class="font-bold text-lg">{{ $product->name }}</h3>
                    
                    <p class="text-sm text-gray-700 mt-1 border w-fit px-2 py-[2px] rounded">
                        Kategori: {{ ucfirst($product->category) }}
                    </p>
                    
                    <p class="text-sm text-pink-600 mt-3">Close PO: {{ $product->close_po_date ?? 'Segera' }}</p>
                </div>
            </div>

            <div class="mt-5 flex items-center justify-between">
                <p>Jumlah:</p>
                <div class="flex items-center gap-3">
                    <button id="minus-btn" class="w-8 h-8 bg-white border rounded text-lg flex items-center justify-center hover:bg-gray-100">−</button>
                    <span id="qty-display" class="font-semibold w-4 text-center">{{ $quantity }}</span>
                    <button id="plus-btn" class="w-8 h-8 bg-white border rounded text-lg flex items-center justify-center hover:bg-gray-100">+</button>
                </div>

                <div class="text-right">
                    <p class="text-sm text-gray-600">Harga per item</p>
                    <p class="font-bold text-pink-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="mt-6 bg-white p-4 rounded-xl border">
            <div class="flex justify-between text-sm mb-2">
                <p>Subtotal</p>
                <p id="display-subtotal">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
            </div>

            <div class="flex justify-between text-sm mb-2">
                <p>Biaya admin</p>
                <p>Rp 5.000</p>
            </div>

            <div class="flex justify-between text-sm">
                <p>Biaya Pengiriman</p>
                <p>Rp 25.000</p>
            </div>

            <hr class="my-3">

            <div class="flex justify-between font-bold text-lg">
                <p>Total</p>
                <p id="display-total" class="text-pink-600">Rp {{ number_format($subtotal + 30000, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="bg-[#FFF3F7] text-sm p-3 rounded-xl mt-6 border border-pink-200 flex items-start gap-3">
            <span class="text-lg">📮</span>
            <div>
                <p class="font-semibold text-pink-700">Estimasi Pengiriman</p>
                <p class="text-gray-600 mt-1">15–20 hari kerja setelah PO ditutup</p>
            </div>
        </div>
    </div>

    <div class="space-y-6">

        <div class="bg-[#FFE8EF] p-6 rounded-xl border border-[#FFC6D5]">
            <h2 class="font-bold text-lg mb-4 flex items-center gap-2">📍 Shipping Information</h2>

            <label class="text-sm mb-2 block font-medium">Nama Lengkap</label>
            <input id="ship-name" type="text" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm mb-4 focus:ring-2 focus:ring-pink-400 outline-none" placeholder="Masukkan nama lengkap">

            <label class="text-sm mb-2 block font-medium">Nomor Telepon</label>
            <input id="ship-phone" type="text" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm mb-4 focus:ring-2 focus:ring-pink-400 outline-none" placeholder="08xxxxxxxx">

            <label class="text-sm mb-2 block font-medium">Alamat Pengiriman</label>
            <textarea id="ship-address" rows="3" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm mb-4 focus:ring-2 focus:ring-pink-400 outline-none" placeholder="Masukkan alamat lengkap"></textarea>

            <label class="text-sm mb-2 block font-medium">Catatan (Optional)</label>
            <textarea id="ship-note" rows="2" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-pink-400 outline-none" placeholder="Catatan untuk pesanan"></textarea>
        </div>

        <div class="bg-[#FFE8EF] p-6 rounded-xl border border-[#FFC6D5]">
            <h2 class="font-bold text-lg mb-4 flex items-center gap-2">💳 Metode Pembayaran</h2>
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-white p-3 rounded-lg border text-center text-sm font-medium text-gray-600 cursor-pointer hover:border-pink-500">QRIS</div>
                <div class="bg-white p-3 rounded-lg border text-center text-sm font-medium text-gray-600 cursor-pointer hover:border-pink-500">GoPay</div>
                <div class="bg-white p-3 rounded-lg border text-center text-sm font-medium text-gray-600 cursor-pointer hover:border-pink-500">ShopeePay</div>
                <div class="bg-white p-3 rounded-lg border text-center text-sm font-medium text-gray-600 cursor-pointer hover:border-pink-500">Virtual Account</div>
            </div>
            <p class="text-xs text-gray-500 mt-3 text-center">*Metode pembayaran lengkap dipilih setelah klik tombol bayar.</p>
        </div>

        <button id="pay-btn" class="w-full bg-[#F65C89] text-white py-3.5 rounded-full font-bold text-lg shadow-lg hover:bg-[#FAABC2] transition transform hover:-translate-y-1">
            Bayar Sekarang
        </button>

    </div>
</div>

<footer class="bg-[#FF96B5] py-4">
    <div class="max-w-6xl container mx-auto text-sm text-white flex justify-between items-center px-4">
        <div class="flex item-center space-x-4">
            <img src="{{ asset('frontend/assets/LOGO.png') }}" class="w-[35px] h-[35px]">
            <p class="mt-2">© Jippy 2025</p>
        </div>
    </div>
</footer>

<script>
    // Data dari PHP Laravel
    const productId = "{{ $product->id }}";
    const pricePerItem = {{ $product->price }};
    let qty = {{ $quantity }};
    
    // Update Tampilan Harga
    function updateDisplay() {
        document.getElementById('qty-display').innerText = qty;
        
        let subtotal = pricePerItem * qty;
        let total = subtotal + 5000 + 25000; // Admin + Ongkir

        document.getElementById('display-subtotal').innerText = "Rp " + subtotal.toLocaleString('id-ID');
        document.getElementById('display-total').innerText = "Rp " + total.toLocaleString('id-ID');
    }

    // Tombol Plus Minus
    document.getElementById('plus-btn').onclick = () => { qty++; updateDisplay(); };
    document.getElementById('minus-btn').onclick = () => { if(qty > 1) qty--; updateDisplay(); };

    // LOGIKA BAYAR (MIDTRANS)
    document.getElementById('pay-btn').addEventListener('click', function () {
        
        // Ambil data form
        const name = document.getElementById('ship-name').value;
        const phone = document.getElementById('ship-phone').value;
        const address = document.getElementById('ship-address').value;
        const note = document.getElementById('ship-note').value;

        // Validasi Sederhana
        if(!name || !phone || !address) {
            alert('Mohon lengkapi Nama, Telepon, dan Alamat!');
            return;
        }

        // Tampilkan Loading
        document.getElementById('loading-overlay').style.display = 'flex';

        // Hitung Total Akhir untuk dikirim ke server
        const finalTotal = (pricePerItem * qty) + 30000; 

        // Kirim ke Laravel
        fetch("{{ route('checkout.process') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: qty,
                total_price: finalTotal,
                customer_name: name,
                customer_phone: phone,
                customer_address: address,
                customer_note: note
            })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('loading-overlay').style.display = 'none';
            
            if(data.snap_token) {
                snap.pay(data.snap_token, {
                    onSuccess: function(result){
                        alert("Pembayaran Berhasil!");
                        window.location.href = "{{ route('track.order') }}";
                    },
                    onPending: function(result){
                        alert("Menunggu Pembayaran!");
                        window.location.href = "{{ route('track.order') }}";
                    },
                    onError: function(result){
                        alert("Pembayaran Gagal!");
                    },
                    onClose: function(){
                        alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                    }
                });
            } else {
                alert("Gagal memproses pembayaran.");
            }
        })
        .catch(error => {
            console.error(error);
            document.getElementById('loading-overlay').style.display = 'none';
            alert("Terjadi kesalahan sistem.");
        });
    });
</script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
     <link href="{{ asset('frontend/style.css') }}" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Track Order - JIPPY</title>
<header class="bg-white shadow">
    <div class="max-w-7xl  mx-auto flex items-center justify-between p-4">
      <img src="/frontend/assets/LOGO.png" alt="Jippy" class="w-[64px] h-[64px]">
      <nav class="flex gap-10 items-center">
        <a href="http://127.0.0.1:8001/" class="text-black font-medium cursor-pointer hover:bg-[#fff2c9] hover:text-black rounded-lg transition duration-300 px-4 py-1">Dashboard</a>
        <a href="http://127.0.0.1:8000/preorder.html" class="text-black font-medium cursor-pointer hover:bg-[#fff2c9] hover:text-black rounded-lg transition duration-300 px-4 py-1">Pre-Order</a>
        <a href="http://127.0.0.1:8000/tracking" class="bg-[#FDE7A1] px-4 py-1 rounded-lg font-medium border border-black">My Order</a>
        <a href="/frontend/LiveChat.html" class="text-black font-medium cursor-pointer hover:bg-[#fff2c9] hover:text-black rounded-lg transition duration-300 px-4 py-1">Live Chat</a>
      </nav>
      <div class="flex gap-4 items-center">
        <button><img src="/frontend/assets/notif.png" alt="Notifikasi" class="w-[22px]"></button>
        <button><img src="/frontend/assets/profil.png" alt="Akun" class="w-[24px]"></button>
      </div>
    </div>
  </header>
    <style>
        body {
            margin: 0;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex-grow: 1;
            padding: 40px 80px;
            padding-bottom: 350px;
        }

        .main-content h1 {
            text-align: center;
            margin-bottom: 40px;
            color: #333;
            font-size: 32px;
            font-weight: bold;
        }

        .order-tabs {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 40px;
        }

        .order-tabs button {
            background-color: #FFE8EF;
            border: 1px solid #000000;
            color: #000000;
            padding: 10px 30px;
            border-radius: 12px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            font-weight: 700;
        }

        .order-tabs button.active,
        .order-tabs button:hover {
            background-color: #FF96B5;
            color: #fff;
        }

        .order-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .order-card .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .order-card .product-details {
            flex-grow: 1;
        }

        .order-card .product-details .category {
            font-size: 14px;
            font-weight: 500;
            color: #1E1E1E;
            margin-bottom: 5px;
        }

        .order-card .product-details .name {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .order-card .product-details .description {
            font-size: 14px;
            font-weight: 500;
            color: #1E1E1E;
            margin-bottom: 10px;
        }

        .order-card .product-details .delivery-info {
            font-size: 14px;
            color: #5ABFEF;
            font-weight: 700;
        }

        .order-card .product-details .delivery-info .delivery-status-detail { 
        display: flex; 
        align-items: center; 
        gap: 8px; 
        }

        .order-card .product-details .delivery-info .delivery-truck-icon { 
        height: 24px; 
        width: 28px;
        object-fit: contain; 
        }

        .order-card .status-and-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 10px;
        }

        .order-card .status-and-actions .status {
            font-weight: bold;
            color: #ff69b4;
            font-size: 15px;
            font-weight: 700;
        }
        .order-card .status-and-actions .status.dikirim {
            color: #ff69b4; 
            font-weight: 700;
        }
        .order-card .status-and-actions .status.proses {
            color: #ff69b4; 
            font-weight: 700;
        }
        .order-card .status-and-actions .status.selesai {
            color: #ff69b4; 
            font-weight: 700;
        }

        .order-card .status-and-actions .total-product {
            font-size: 14px;
            font-weight: 700;
            color: #000000;
            margin-top: -5px;
        }

        .order-card .status-and-actions .buttons {
            display: flex;
            gap: 10px;
        }

        .order-card .status-and-actions button {
            background-color: #FF96B5;
            color: #FFE8EF;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            font-size: 15px;
            font-weight:700;
            transition: background-color 0.3s;
            border-radius: 4px;
        }

        .order-card .status-and-actions button.secondary {
            background-color: #FF96B5;
            color: #FFE8EF;
            font-weight:700;
            font-size: 15px;
            border-radius: 4px;
        }

        .order-card .status-and-actions button:hover {
            opacity: 0.9;
        }

        .order-card .status-and-actions button.buy-again {
        background-color: #fff; 
        color: #000000; 
        border: 1px solid #E2DBFF; 
        font-weight:700;
        font-size: 15px;
        border-radius: 4px;
        }

        .footer {
            background-color: #ffe0ee; 
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            color: #ff69b4;
            margin-top: auto;
        }

        .footer .logo {
            display: flex;
            align-items: center;
        }

        .footer .logo img {
            height: 25px;
            margin-right: 8px;
        }

        .footer .footer-links {
            display: flex;
            gap: 20px;
        }

        .footer .footer-links a {
            text-decoration: none;
            color: #ff69b4;
        }
    </style>
</head>
<body>
     

    <div class="main-content">
        <h1>My Order</h1>

        <div class="order-tabs">
    <button onclick="window.location.href='{{ route('track.order', ['status' => 'all']) }}'" 
            class="{{ request('status') == 'all' || !request('status') ? 'active' : '' }}">
        Semua Pesanan
    </button>

    <button onclick="window.location.href='{{ route('track.order', ['status' => 'processing']) }}'"
            class="{{ request('status') == 'processing' ? 'active' : '' }}">
        Dalam Proses
    </button>

    <button onclick="window.location.href='{{ route('track.order', ['status' => 'shipped']) }}'"
            class="{{ request('status') == 'shipped' ? 'active' : '' }}">
        Dalam Pengiriman
    </button>

    <button onclick="window.location.href='{{ route('track.order', ['status' => 'completed']) }}'"
            class="{{ request('status') == 'completed' ? 'active' : '' }}">
        Selesai
    </button>
</div>
<div class="order-list">
    @forelse($orders as $order)
        <div class="order-card">
            <img src="{{ asset('uploads/products/' . $order->product->image) }}" 
                 alt="{{ $order->product->name }}" 
                 class="product-image"
                 onerror="this.src='{{ asset('frontend/assets/logo.png') }}'"> 

            <div class="product-details">
                <div class="category">Product</div>
                <div class="name">{{ $order->product->name }}</div>
                <div class="description">Order ID: {{ $order->order_id }}</div>
                
                <div class="delivery-info">
                    @if($order->order_status == 'processing')
                        <span>Pesanan sedang diproses penjual</span>
                    @elseif($order->order_status == 'shipped')
                        <div class="delivery-status-detail">
                            <img src="{{ asset('frontend/assets/Truck.svg') }}" class="delivery-truck-icon"> 
                            <span>Paket sedang dikirim kurir</span> 
                        </div>
                    @elseif($order->order_status == 'completed')
                        <div class="delivery-status-detail">
                            <img src="{{ asset('frontend/assets/Truck.svg') }}" class="delivery-truck-icon"> 
                            <span>Paket telah diterima</span> 
                        </div>
                    @endif
                </div>
            </div>

            <div class="status-and-actions">
                <div class="status {{ $order->order_status == 'processing' ? 'proses' : ($order->order_status == 'shipped' ? 'dikirim' : 'selesai') }}">
                    @if($order->order_status == 'processing') Dalam Proses
                    @elseif($order->order_status == 'shipped') Dalam Pengiriman
                    @elseif($order->order_status == 'completed') Selesai
                    @endif
                </div>

                <div class="total-product">x{{ $order->quantity }}</div>
                <div class="total-product">Total: IDR {{ number_format($order->total_price, 0, ',', '.') }}</div>

                <div class="buttons">
                    @if($order->order_status == 'processing')
                        <button onclick="window.location.href='/frontend/LiveChat.html'">Hubungi Admin</button>
                    @elseif($order->order_status == 'shipped')
                        <button class="secondary">Lacak</button>
                        <button class="secondary">Terima</button>
                    @elseif($order->order_status == 'completed')
                        <button class="buy-again">Beli Lagi</button>
                        <button class="secondary"
    onclick="window.location.href='/frontend/nilai.html?transaction_id={{ $order->id }}'">
    Nilai
</button>

                    @endif
                </div>
            </div>
        </div>
    @empty
        <div style="text-align: center; padding: 50px;">
            <h3>Belum ada pesanan di kategori ini.</h3>
            <br>
            <a href="/frontend/menu.html" style="color: #ff69b4; text-decoration: underline; font-weight: bold;">Belanja Sekarang</a>
        </div>
    @endforelse
</div>

        
    </div>

    <style>
 
    footer {
      background-color: #FF96B5;
      padding: 2 rem 1 rem;
      font-size: 0.875rem;
      color: white;
    }

    footer .container {
      max-width: 1200px;
      margin: 0 auto;
    }

    footer .footer-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    footer .footer-left img {
      width: 32px;
      height: 32px;
    }

    footer .footer-left p {
      margin-top: 1rem;
      font-size: 0.75rem;
    }

    footer .footer-right {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      gap: 0.75rem;
    }

    footer .footer-links {
      display: flex;
      gap: 1.75rem;
      text-align: right;
      font-size: 1rem;
    }

    footer .footer-sub-links {
      display: flex;
      gap: 1rem;
      font-size: 0.75rem;
    }
  </style>

  <footer class="bg-[#FF96B5] py-4">
    <div class="max-w-6xl container mx-auto text-sm text-white">
      <div class="flex justify-between items-center">
        <div class="flex item-center py-4 space-x-4">
            <img src="{{ asset('frontend/assets/') }}/LOGO.png" alt="Jippy" class="w-[35px] h-[35px]">
            <p class="mt-4 text-xs">© Jippy 2025 - All Rights Reserved</p>
        </div>
        <div class="flex flex-col items-end space-y-3">
            <span class="flex gap-7 text-right text-md">
                <a href="#" class="hover:underline cursor-pointer">Home</a>
                <a href="#" class="hover:underline cursor-pointer">About Us</a>
                <a href="#" class="hover:underline cursor-pointer">Contact Person</a>
            </span>
            <span class="flex gap-4 text-xs">
                <p>Terms of Use</p>
                <p>Privacy Policy</p>
                <p>Agreement</p>
            </span>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>

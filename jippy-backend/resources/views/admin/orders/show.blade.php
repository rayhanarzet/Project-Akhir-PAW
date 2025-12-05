@extends('admin.layout')

@section('content')

<h1 class="text-2xl font-bold mb-4">Detail Pesanan</h1>

@if(session('success'))
<div class="p-3 bg-green-200 text-green-800 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="bg-white p-5 rounded shadow mb-6">

    <p><strong>Order ID:</strong> {{ $order->order_id }}</p>
    <p><strong>Produk:</strong> {{ $order->product->name }}</p>
    <p><strong>Jumlah:</strong> {{ $order->quantity }}</p>
    <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_price,0,',','.') }}</p>
    <p><strong>Nama Pembeli:</strong> {{ $order->customer_name }}</p>
    <p><strong>Nomor Telepon:</strong> {{ $order->customer_phone }}</p>
    <p><strong>Alamat:</strong> {{ $order->customer_address }}</p>

    <p><strong>Status Saat Ini:</strong> 
        <span class="capitalize text-pink-600 font-bold">{{ $order->order_status }}</span>
    </p>
</div>

<h2 class="text-lg font-bold mb-2">Ubah Status Pesanan</h2>

<form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
    @csrf

    <select name="order_status" class="border p-2 rounded">
        <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Dalam Proses</option>
        <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Dalam Pengiriman</option>
        <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Selesai</option>
    </select>

    <button 
        class="ml-3 bg-pink-500 text-white px-5 py-2 rounded hover:bg-pink-600">
        Update Status
    </button>
</form>

@endsection

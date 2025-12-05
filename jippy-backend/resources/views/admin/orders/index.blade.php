@extends('admin.layout')

@section('content')

<h1 class="text-2xl font-bold mb-6">Semua Pesanan</h1>

<table class="w-full border rounded-lg overflow-hidden">
    <tr class="bg-gray-100 border-b">
        <th class="p-3 text-left">Order ID</th>
        <th class="p-3 text-left">Produk</th>
        <th class="p-3 text-left">Nama Pembeli</th>
        <th class="p-3 text-left">Status</th>
        <th class="p-3 text-left">Aksi</th>
    </tr>

    @foreach($orders as $order)
    <tr class="border-b">
        <td class="p-3">{{ $order->order_id }}</td>
        <td class="p-3">{{ $order->product->name }}</td>
        <td class="p-3">{{ $order->customer_name }}</td>
        <td class="p-3 capitalize">{{ $order->order_status }}</td>
        <td class="p-3">
            <a 
                href="{{ route('admin.orders.show', $order->id) }}" 
                class="bg-pink-500 text-white px-3 py-1 rounded text-sm">
                Detail
            </a>
        </td>
    </tr>
    @endforeach

</table>

@endsection

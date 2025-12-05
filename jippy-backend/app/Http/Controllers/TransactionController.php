<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil status dari URL (default: all)
        $status = $request->query('status', 'all');

        // 2. Siapkan Query
        $query = Transaction::with('product');

        // Filter Data jika status bukan 'all'
        if ($status !== 'all') {
            $query->where('order_status', $status);
        }
        
        // Ambil data urut terbaru
        $orders = $query->latest()->get();

        // 3. LOGIKA PEMILIHAN FILE VIEW (Ini yang penting!)
        
        // Jika statusnya 'processing', buka file track_process.blade.php
        if ($status == 'processing') {
            return view('frontend.track_process', compact('orders'));
        }
        
        // Jika statusnya 'shipped', buka file track_shipped.blade.php
        if ($status == 'shipped') {
            return view('frontend.track_shipped', compact('orders'));
        }
        
        // Jika statusnya 'completed', buka file track_completed.blade.php
        if ($status == 'completed') {
            return view('frontend.track_completed', compact('orders'));
        }

        // DEFAULT (Jika status 'all' atau kosong)
        // PERBAIKAN DI SINI: Arahkan ke 'track_all', BUKAN 'track_order'
        return view('frontend.track_index', compact('orders'));
    }

    public function checkout(Request $request)
    {
        // 1. Tangkap data yang dikirim dari Halaman Detail
        $productId = $request->query('product_id');
        $quantity = $request->query('quantity', 1); // Default 1 jika kosong

        // 2. Ambil Data Produk Lengkap dari Database
        $product = \App\Models\Product::find($productId);

        // Cek jika produk tidak valid
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // 3. Hitung Total Awal
        $subtotal = $product->price * $quantity;

        // 4. Tampilkan Halaman Checkout dengan membawa data produk
        return view('frontend.checkout', compact('product', 'quantity', 'subtotal'));
    }

    public function store(Request $request)
    {
        // 1. Simpan Transaksi ke Database (Status Pending)
        $transaction = Transaction::create([
            'order_id'       => 'ORD-' . strtoupper(uniqid()),
            'product_id'     => $request->product_id,
            'customer_name'  => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => 'guest@jippy.com', // Default email dummy dulu
            'quantity'       => $request->quantity,
            'total_price'    => $request->total_price,
            'payment_status' => 'pending',
            'order_status'   => 'processing', // Langsung masuk 'Dalam Proses'
        ]);

        // 2. Konfigurasi Midtrans (Ganti Server Key Anda)
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $transaction->order_id,
                'gross_amount' => $transaction->total_price,
            ],
            'customer_details' => [
                'first_name' => $request->customer_name,
                'phone' => $request->customer_phone,
            ],
        ];

        // 3. Minta Snap Token dari Midtrans
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // 4. Kirim Token ke Frontend (JavaScript)
        return response()->json(['snap_token' => $snapToken]);
    }
}
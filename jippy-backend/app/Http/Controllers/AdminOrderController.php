<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // Halaman daftar semua pesanan
    public function index()
    {
        $orders = Transaction::with('product')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Halaman detail 1 pesanan
    public function show($id)
    {
        $order = Transaction::with('product')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Update status pesanan
    public function updateStatus(Request $request, $id)
    {
        $order = Transaction::findOrFail($id);
        $order->order_status = $request->order_status;
        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}

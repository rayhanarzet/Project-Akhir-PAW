<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');

        $query = Transaction::with('product');

        if ($status !== 'all') {
            $query->where('order_status', $status);
        }
        
        $orders = $query->latest()->get();

        if ($status == 'processing') {
            return view('frontend.track_process', compact('orders'));
        }
        
        if ($status == 'shipped') {
            return view('frontend.track_shipped', compact('orders'));
        }
        
        if ($status == 'completed') {
            return view('frontend.track_completed', compact('orders'));
        }

        return view('frontend.track_index', compact('orders'));
    }

    public function checkout(Request $request)
    {
        $productId = $request->query('product_id');
        $quantity = $request->query('quantity', 1); 

        $product = \App\Models\Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $subtotal = $product->price * $quantity;

        return view('frontend.checkout', compact('product', 'quantity', 'subtotal'));
    }

    public function store(Request $request)
    {
        $transaction = Transaction::create([
            'order_id'       => 'ORD-' . strtoupper(uniqid()),
            'product_id'     => $request->product_id,
            'customer_name'  => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => 'guest@jippy.com', 
            'quantity'       => $request->quantity,
            'total_price'    => $request->total_price,
            'payment_status' => 'pending',
            'order_status'   => 'processing', 
        ]);

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

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json(['snap_token' => $snapToken]);
    }
}

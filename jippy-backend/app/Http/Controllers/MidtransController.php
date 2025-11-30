<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;  

use Midtrans\Config;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function __construct()
    {
        Config::$serverKey    = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'product_id'      => 'required',
            'quantity'        => 'required|integer|min:1',
            'customer_name'   => 'required|string',
            'customer_phone'  => 'required|string',
            'customer_address'=> 'required|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        $productPrice = (int) $product->price;
        $qty = (int) $request->quantity;

        $admin = 5000;
        $shipping = 25000;
        $subtotal = $productPrice * $qty;
        $grossAmount = $subtotal + $admin + $shipping;

        $transaction_details = [
            'order_id'     => 'ORDER-' . time(),
            'gross_amount' => $grossAmount,
        ];

        $item_details = [
            [
                'id'       => $product->id,
                'price'    => $productPrice,
                'quantity' => $qty,
                'name'     => $product->name
            ],
            [
                'id'       => 'ADMIN',
                'price'    => $admin,
                'quantity' => 1,
                'name'     => "Biaya Admin"
            ],
            [
                'id'       => 'ONGKIR',
                'price'    => $shipping,
                'quantity' => 1,
                'name'     => "Biaya Pengiriman"
            ]
        ];

        $customer_details = [
            'first_name' => $request->customer_name,
            'phone'      => $request->customer_phone,
            'billing_address' => [
                'address' => $request->customer_address,
            ],
            'shipping_address' => [
                'address' => $request->customer_address,
            ],
        ];

        $params = [
            'transaction_details' => $transaction_details,
            'item_details'        => $item_details,
            'customer_details'    => $customer_details,
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'success' => true,
            'token'   => $snapToken
        ]);
    }
}

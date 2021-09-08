<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('products')->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();

        return view('admin.orders.create', compact('products'));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->all());

        $products = $request->input('products', []);
        $quantities = $request->input('quantities', []);
        for ($product=0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $order->products()->attach($products[$product], ['quantity' => $quantities[$product]]);
            }
        }

        return redirect()->route('admin.orders.index');
    }

    public function edit(Order $order)
    {
        $products = Product::all();

        $order->load('products');

        return view('admin.orders.edit', compact('products', 'order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());

        $order->products()->detach();
        $products = $request->input('products', []);
        $quantities = $request->input('quantities', []);
        for ($product=0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $order->products()->attach($products[$product], ['quantity' => $quantities[$product]]);
            }
        }

        return redirect()->route('admin.orders.index');
    }

    public function show(Order $order)
    {
        $order->load('products');

        return view('admin.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return back();
    }

}

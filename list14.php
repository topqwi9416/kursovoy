<?php
// OrderController.php — метод store()
public function store(Request $request)
{
    $order = Order::create([
        'customer_name'    => $request->customer_name,
        'customer_phone'   => $request->customer_phone,
        'delivery_address' => $request->delivery_address,
        'delivery_time'    => $request->delivery_time,
        'status'           => 'new',
        'total_amount'     => 0,
    ]);

    $total = 0;

    // 1. Заказ из корзины
    if ($request->from_cart) {
        $cart = session()->get('cart', []);
        foreach ($cart as $bouquet_id => $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'bouquet_id'   => $bouquet_id,
                'bouquet_name' => $item['name'],
                'quantity'     => $item['quantity'],
                'price'        => $item['price'],
            ]);
            $total += $item['price'] * $item['quantity'];
        }
    }

    // 2. Заказ одного букета из каталога
    if ($request->bouquet_id) {
        $bouquet = Bouquet::findOrFail($request->bouquet_id);
        OrderItem::create([...]);
        $total += $bouquet->price * ($request->quantity ?? 1);
    }

    // 3. Заказ из конструктора (JSON-строка)
    if ($request->constructor_items) {
        $items = json_decode($request->constructor_items, true);
        foreach ($items as $flower_id => $quantity) {
            $flower = Flower::find($flower_id);
            if ($flower && $quantity > 0) {
                $total += $flower->price * $quantity;
            }
        }
        OrderItem::create([
            'bouquet_name' => 'Свой букет: ...',
            'price'        => $total,
        ]);
    }

    $order->update(['total_amount' => $total]);
    return redirect()->route('order.success', $order->id);
}
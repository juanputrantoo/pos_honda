<?php

namespace App\Http\Controllers;

use App\Item;
use App\Item_Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ItemOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order_id = Crypt::decrypt($request->order_id);
        $request->validate([
            'items' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'unit' => 'required',
            'discount' => 'required'
        ]);

        $price = $request->price;
        $quantity = $request->quantity;
        $unit = $request->unit;
        $discount = $request->discount;

        $temp_discount = ($discount / 100);
        $temp_sub_total = $price * $temp_discount;
        $sub_total = ($price - $temp_sub_total) * $quantity;

        $item = Item::find($request->items);

        if($item->stock < $quantity){
            return redirect()->back()->with('error', 'Stock not enough!');
        }

        $old_stock_item = $item->stock;
        $new_stock_item = $old_stock_item - $quantity;
        $item->stock = $new_stock_item;
        $item->save();

        Item_Order::create([
            'order_id' => $order_id,
            'item_id' => $request->items,
            'quantity' => $quantity,
            'unit' => $unit,
            'discount' => $discount,
            'sub_total' => $sub_total,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $item_order = Item_Order::find($id);
        $item = Item::find($item_order->item_id);
        $old_stock_item = $item->stock;
        $new_stock_item = $old_stock_item + $item_order->quantity;
        $item->stock = $new_stock_item;
        $item->save();
        
        Item_Order::destroy($id);
        return redirect()->back();
    }
}

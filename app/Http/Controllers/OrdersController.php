<?php

namespace App\Http\Controllers;

use App\Order;
use App\Item;
use App\Item_Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latest_order = Order::orderBy('id', 'DESC')->first();
        if ($latest_order == null) {
            $new_order = 0;
        } else {
            $new_order = $latest_order->id;
        }

        $curr_date = date('dmy');
        $order_number = 'ON/' . ($new_order + 1) . '/' . $curr_date;

        $order = Order::latest()->first();
        if($order == null || $order->status == 1){
            $order = [];
            return view('orders/index', compact('order_number', 'curr_date', 'order'));
        }
        else if(($order->status == 0) && ($order->created_at < date('Y-m-d'))){
            Order::destroy($order->id);
            $order = [];
            return view('orders/index', compact('order_number', 'curr_date', 'order'));
        }
        else{
            return view('orders/index', compact('order_number', 'curr_date', 'order'));
        }
        

        // $curr_date = date('Y-m-d H:i:s');
        // $orders = Order::whereDate('created_at', today())->get();
        // $grand_total = 0;
        // foreach ($orders as $order) {
        //     $grand_total += $order->total;
        // }
        // return view('orders/index', compact('orders', 'grand_total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        Order::create([
            'order_number' => $request->order_number,
            'user_id' => $user_id,
            'created_at' => $request->created_at
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $items = Item::all();
        // $order = $order->load('user');
        return view('orders/show', compact('order', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('orders/edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'total' => 'required',
            'payment_method' => 'required'
        ]);

        Order::where('id', $order->id)->update([
            'total' => $request->total,
            'payment_method' => $request->payment_method,
            'status' => 1
        ]);

        return redirect()->route('history/orders/all/detail', $order->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        Order::destroy($order->id);
        return redirect('/orders');
    }

    public function generateOrder($id)
    {
        $order = Order::find($id);
        $pdf = PDF::loadView('orders/print', compact('order'))->setPaper('a5', 'landscape');
        return $pdf->stream();
    }

    public function historyAll(){
        $orders = Order::where('status', 1)->paginate(10);
        return view('history/orders/all', compact('orders'));
    }

    public function historyDetail($id){
        $order = Order::find($id);
        return view('history/orders/detail', compact('order'));
    }

    public function historyToday(){
        $orders = Order::where([
            ['status', '=', '1'],
            ['created_at', '>=', date('Y-m-d')]
        ])->orderBy('id', 'DESC')->get();

        $temp_total = 0;
        foreach ($orders as $order) {
            $temp_total += $order->total;
        }
        return view('history/orders/today', compact('orders', 'temp_total'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $search = $request->get('search_orders');
            $orders = Order::where('order_number', 'like', '%' . $search . '%')
                ->orderBy('order_number')
                ->paginate(10);

            if ($orders->count() > 0) {
                $i = 1;
                foreach ($orders as $order) {
                    $output .=
                        '<tr>' .
                        '<td class="align-middle">' . $i . '</td>' .
                        '<td class="align-middle">' . $order->order_number . '</td>' .
                        '<td class="align-middle">' . $order->total . '</td>' .
                        '<td class="align-middle">' . $order->payment_method . '</td>' .
                        '<td class="align-middle">' . $order->updated_at . '</td>' .
                        '<td class="align-middle"><a href="'.  route('orders/print', $order->id) .'" class="btn btn-primary btn-sm" target="_blank"><i
                            class="fas fa-print"></i></a></td>' .
                        '</tr>';
                    $i++;
                }
            } else {
                $output = '
                <tr>
                <td align="center" colspan="8">No result match <i>"' . $search . '"</i></td>
                </tr>
                ';
            }
            return response()->json($output);
        }
    }

    public function dateRange(Request $request){
        $request->validate([
            'from_date' => 'required',
            'to_date' => 'required'
        ]);

        $from_date = $request->from_date;
        $from_date_replace = str_replace('/', '-', $from_date);
        $new_from_date = date('Y-m-d', strtotime($from_date_replace));

        $to_date = $request->to_date;
        $to_date_replace = str_replace('/', '-', $to_date);
        $new_to_date = date('Y-m-d' . ' 23:59:59', strtotime($to_date_replace));

        $orders = Order::where([
            ['created_at', '>=', $new_from_date],
            ['created_at', '<=', $new_to_date]
        ])->orderBy('created_at', 'ASC')->paginate(10);

        return view('history/orders/dateRange', compact('orders', 'new_from_date', 'new_to_date'));
    }
}

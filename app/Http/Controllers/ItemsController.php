<?php

namespace App\Http\Controllers;

use App\Item;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Queue\Events\Looping;

class ItemsController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('name')->paginate(10);
        return view('items/index', compact('items'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $search = $request->get('search_items');
            $items = Item::where('part_number', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%')
                ->orderBy('name')
                ->get();

            if ($items->count() > 0) {
                $i = 1;
                foreach ($items as $item) {
                    $output .=
                        '<tr align="center">' .
                        '<td class="align-middle">' . $i . '</td>' .
                        '<td class="align-middle">' . $item->part_number . '</td>' .
                        '<td class="align-middle">' . $item->name . '</td>' .
                        '<td class="align-middle">' . $item->description . '</td>' .
                        '<td class="align-middle">' . $item->stock . '</td>' .
                        '<td class="align-middle">' . $item->price . '</td>' .
                        '<td class="pr-0 pl-0"><a class="btn btn-warning btn-sm" href="/items/' . $item->id . '/edit"><i
                            class="fa fa-pen-alt"></i></a></td>' .
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'part_number' => 'required|unique:items',
            'name' => 'required',
            'stock' => 'required',
            'price' => 'required'
        ]);


        Item::create([
            'part_number' => strtoupper($request->part_number),
            'name' => ucfirst($request->name),
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => str_replace('.', '', $request->price)
        ]);
        return redirect('/items');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items/show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('items/edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'part_number' => 'required',
            'name' => 'required',
            'price' => 'required'
        ]);

        Item::where('id', $item->id)->update([
            'part_number' => strtoupper($request->part_number),
            'name' => ucfirst($request->name),
            'description' => $request->description,
            'price' => str_replace('.', '', $request->price)
        ]);
        return redirect('/items');
    }

    public function addStock(Request $request, Item $item){
        $request->validate([
            'stock' => 'required'
        ]);

        $old_stock = $item->stock;
        $add = $request->stock;
        $new_stock = $old_stock + $add;
        Item::where('id', $item->id)->update([
            'stock' => $new_stock
        ]);
        return redirect()->route('items/edit', $item->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        Item::destroy($item->id);
        return redirect('/items');
    }

    public function getPrice(Request $request)
    {
        $item = Item::where('id', $request->id)->first();
        return response()->json($item->price);
    }

    public function deleted(){
        $items = Item::onlyTrashed()->paginate(10);
        return view('history/items/deleted', compact('items'));
    }

    public function restore($id){
        $item = Item::onlyTrashed()->where('id', $id);
        $item->restore();
        return redirect()->back();
    }
}

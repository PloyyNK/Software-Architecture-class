<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleLineItem;
use App\Models\Items;
use Illuminate\Http\Request;

class SaleController extends Controller
{

    public function openSale(Request $request)
    {
        $sale = new Sale();
        $sale->payment = false;
        $sale->timestamp = now();
        $sale->save();

        return redirect()->route('sale.view', ['id' => $sale->id]);
    }

    public function closeSale(Request $request, $id)
    {
        $request->validate([
            'pay' => 'required',
        ]);

        $sale = Sale::findOrFail($id);
        $sale->payment = true;
        $sale->save();

        return redirect("/");
    }

    public function addSaleLineItem(Request $request, Sale $sale)
    {
        $item = Items::findOrFail($request->input('itemId'));
        $price = ($item->price * $request->quantity);

        $saleLineItem = new SaleLineItem();
        $saleLineItem->saleId = $sale->id;
        $saleLineItem->itemId = $item->id;
        $saleLineItem->quantity = $request->input('quantity');
        $saleLineItem->subtotal = $price;
        $saleLineItem->save();

        return redirect()->route('sale.view', ['id' => $sale->id])->with('success', 'Item added to sale successfully.');
    }

    public function removeSaleLineItem(Request $request, int $id)
    {
        $saleLineitem = SaleLineItem::find($id);
        $saleLineitem->delete();

        return redirect()->back()->with('success', 'Item removed from sale successfully.');
    }

    public function view($id)
    {
        $sale = Sale::findOrFail($id);
        $items = Items::all();
        $saleLineItems = SaleLineItem::where('saleId', $id)->get();
        $total = array_sum(SaleLineItem::where('saleId', $id)->pluck('subtotal')->all());
        
        return view('sale.index', compact('sale', 'items', 'saleLineItems', 'total'));
    }

}

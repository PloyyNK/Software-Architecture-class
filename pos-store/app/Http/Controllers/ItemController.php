<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    protected $items;
    public function __construct(Items $items)
    {
        $this->items = $items;
    }
    public function index(Request $request)
    {
        $items = Items::all();
        return view("items.index", [
            "items" => $items,
        ]);
    }

    public function create(Request $request)
    {
        return view("items.create");
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
        ]);

        $item = new Items();
        $item->name = $validatedData['name'];
        $item->price = $validatedData['price'];
        $item->save();

        return redirect("/items")->with('success', 'Item created successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $item = Items::find($id);
        $item->delete();
        return redirect('/items');
    }

    public function show($id)
    {
        $item = Items::find($id);
        return view('items.update', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
        ]);

        $item = Items::findOrFail($id);
        $item->name = $validatedData['name'];
        $item->price = $validatedData['price'];
        $item->save();

        return redirect('/items')->with('success', 'Item updated successfully.');
    }


}

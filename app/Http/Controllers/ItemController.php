<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Models\Item;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //Customer side
    public function index(){
        $items = Item::with('user:id,name')
                ->latest()
                ->get();

        return view('customer.view', compact('items'));
    }

    //Owner Side
    public function create(){
        return view('owner.create');
    }

    //Owner side
    public function store(StoreItemRequest $request){
        //Validations done in custom Sytroe Item request obvi
        $user = Auth::user() ? Auth::id() : 1;
        $validated = $request->validated();

        $file = $request->file('image');
        try {
            [$width, $height] = getimagesize($file->getRealPath());
        }
        catch(Exception){
            $width = 0;
            $height = 0;

        }
        $path = $file->store('image', 'public');

        Item::create([
            'description' => $validated['description'],
            'item_name' => $validated['item_name'],
            'image_path' => $path,
            'image_height' => $height,
            'image_width' => $width,
            'user_id' => $user
        ]);

        return redirect()->route('launch')->with('message', 'Posted!');
    }

    //Customer side
    public function show(Item $item){
        return view('customer.show', compact('item'));
    }

    //Owner side
    public function edit(Item $item){
        #$u_id == auth()->user();
        return view('owner.edit', compact('item'));
    }


    //Owner side
    public function update(Request $request, Item $item){
        $user = $item->user;

        $file = $request->file('image');
        [$width, $height] = getimagesize($file->getRealPath());
        $path = $file->store('image', 'public');

        $validated = $request->validate([
            'description' => ['max:600']
        ]);

        Item::update($validated);

        return redirect()->route('customer.view')->with('message', 'Updated Post!');
    }

    //Owner side
    public function destroy(Item $item){
        //Autheticate user

        Item::destroy($item);
        return redirect()->route('customer.view')->with('message', 'Deleted Post!');
    }
}

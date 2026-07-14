<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //Customer side
    public function index(){
        $posts = Item::with('user:id,name')
                ->get();

        return view('customer.view', compact('posts'));
    }

    //Owner Side
    public function create(){
        return view('owner.create');
    }

    //Owner side
    public function store(StoreItemRequest $request){
        $file = $request->file('image');
        [$width, $height] = getimagesize($file->getRealPath());
        $path = $file->store('image', 'public');

        $validated = $request->validate([
            'description' => ['max:600']
        ]);

        Item::create($validated);

        return redirect()->route('customer.view')->with('message', 'Posted!');
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
    public function update(Request $request, $id){
        $user = User::findOrFail($id);

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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(){
        $posts = Item::with('user:id,name')
                ->get();

        return view('customer.view', compact('posts'));
    }

    public function create(){
        return view('owner.create');
    }

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

    public function show(Item $item){
        return view('customer.show', compact('item'));
    }

    public function edit(Item $item){
        #$u_id == auth()->user();
        return view('owner.edit', compact('item'));
    }


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

    public function destroy(Item $item){
        //Autheticate user

        Item::destroy($item);
        return redirect()->route('customer.view')->with('message', 'Deleted Post!');
    }
}

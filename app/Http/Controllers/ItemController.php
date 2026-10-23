<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Models\category;
use App\Models\color_item;
use App\Models\Item;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ItemController extends Controller
{
    //Customer side
    public function index(){
        $items = Item::with('user:id,name,role')
                ->latest()
                ->paginate(14);

        return view('customer.view', compact('items'));
    }

    //Owner Side
    public function create(){
        $colours = color_item::all()->where('is_active', '=', true);
        $categories = category::all()->where('is_active','=', true);
        return view('owner.create', compact('colours', 'categories'));
    }

    //Owner side
    public function store(StoreItemRequest $request){
        //Validations done in custom Sytroe Item request obvi
        
        $user = Auth::user() ? Auth::id() : 1;
        $validated = $request->validate([
            'item_name'=>'required',
            'colours' => 'required|array|min:1|max:10|',
            'colours.*' => 'integer',
            'category' => 'required|integer',
            'image'=>'required|image',
            'description'=>'required|min:3|max:300'
        ]);

        
        $file = $request->file('image');
        DB::transaction(function () use ($validated, $file, $user) {
            try {
                [$width, $height] = getimagesize($file->getRealPath());
            }
            catch(Exception){
                $width = 0;
                $height = 0;

            }
            $filename = Storage::disk('public')->put('/posts', $file);
        
            Item::create([
                'description' => $validated['description'],
                'item_name' => $validated['item_name'],
                'image_path' => $filename,
                'category_id' => $validated['category'],
                'image_height' => $height,
                'price' => 30000,
                'waist' => 20,
                'length' => 20,
                'chest' => 20,
                'image_width' => $width,
                'user_id' => $user
            ]);

        });
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

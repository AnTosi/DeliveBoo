<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        // $user = Auth::user();

        // ddd($user->dishes);

        $dishes = $user->dishes()->orderByDesc('id')->paginate(12);
        return view('admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        //
        $val_data = $request->validate([
            'name' => ['required', 'unique'],
            'ingredients' => ['nullable', 'max:255'],
            'description' => ['nullable', 'max:1000'],
            'image' => ['nullable', 'image', 'max:500'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'visibility' => ['nullable']
        ]);

       
        
        if ($request->file('image')) {
            $image_path = $request->file('image')->store('dish_image');
            $val_data['image'] = $image_path;
        }

        if($request->input('visibility') == null) {
            $val_data['visibility'] = 0;

        }
        else {
            $val_data['visibility'] = 1;

        }

        $val_data['slug'] = Str::slug($val_data['name']);
        $val_data['user_id'] = Auth::id();

        Dish::create($val_data);
        
        return redirect()->route('admin.dishes.index')->with('message', 'Dish succesfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        //
    }
}
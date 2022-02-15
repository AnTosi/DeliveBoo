<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::orderByDesc('id')->paginate(9);
        $tags = Tag::get();
        return view('guest.welcome', compact('users', 'tags'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('guest.restaurant.show', compact('user'));
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'image' => ['required', 'image', 'max:500'],
            'name' => ['required', 'unique:users', 'string', 'max:255'],
            'email' => ['unique:users', 'required', 'string', 'email', 'max:255'],
            'logo' => ['required', 'image', 'max:500'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string', 'max:255'],
            'piva' => ['unique:users', 'required', 'integer', 'digits:11'],
            'tags' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'piva' => $data['piva'],
        ]);

        if (request()->hasFile('image')) {
            $image = request()->file('image')->getClientOriginalName();
            request()->file('image')->storeAs('restaurant_image', $user->id . '/' . $image);
            $user->update(['image' => $image]);
        }

        if (request()->hasFile('logo')) {
            $logo = request()->file('logo')->getClientOriginalName();
            request()->file('logo')->storeAs('restaurant_logo', $user->id . '/' . $logo);
            $user->update(['logo' => $logo]);
        }

        $user->tags()->attach($data['tags']);

        return $user;
    }
}
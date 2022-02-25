<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return UserResource::collection(User::with(['tags', 'dishes'])->paginate(3));
    }

    public function show($name)
    {
        //
        $prova = DB::select(DB::raw("SELECT * FROM `users` WHERE `name` LIKE '%$name%'"));

        $users = [];

        foreach ($prova as $user) {

            $provaUser = new UserResource(User::find($user->id));

            if (!in_array($provaUser, $users)) {

                array_push($users, $provaUser);
            }
        }
        return $users;
    }
}
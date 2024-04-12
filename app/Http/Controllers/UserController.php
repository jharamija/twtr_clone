<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET - /users - users.index
     */
    public function index()
    {
        $users = DB::table('users')->get();
        return response([
            $users,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     * GET - /users/create - users.create
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST - /users - users.store
     */
    public function store(Request $request)     // register/sign up
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:1',
        ]);

        // User::create($request);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->followers = 0;
        $user->following = 0;
        $user->save();

        Auth::login($user);

        return response([
            'redirect' => '/posts/create',
        ], 200);
    }

    /**
     * Display the specified resource.
     * GET - /users/{user} - users.show
     */
    public function show(string $id)
    {
        $user = User::find($id);

        // if($user){
        //     return response()->json($user);
        // }

        // return response([
        //     'error' => 'User not found',
        // ] ,404);

        return $user ? response()->json($user)
            : response([
                'error' => 'User not found',
            ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     * GET - /users/{user}/edit - photos.edit
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT/PATCH - /photos/{photo} - photos.update
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE - /photos/{photo} - photos.destroy
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $email = $user->email;

        if($user){
            $user->delete();

            return response([
                'message' => 'User '.$email.' successfuly deleted.',
            ]);
        }

        return response([
            'error' => 'User not found',
        ], 404);
    }
}

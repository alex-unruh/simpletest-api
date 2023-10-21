<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $user = new User($data);
        $user->save();
        return response(['message' => __('Record added successfully')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->id == 1 && !empty($request['profile']) && $request['profile'] != 1) {
            return response(['errors' => ['profile' => [__("You can't change the profile of the master admin user")]]], 422);
        }
        $data = $request->validated();
        $user->fill($data);
        $user->save();

        return response(['message' => __('Record updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($id == 1) return response(['message' => __("You can't remove the Master Admin user")], 403);
        if (auth()->id() === $user->id) return response(['message' => __("You can't remove your own user")], 403);
        $user->delete();

        return response(['message' => __('Record deleted successfully')]);
    }
}

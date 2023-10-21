<?php

namespace App\Http\Controllers;

use App\Models\Release;
use App\Http\Requests\ReleaseRequest;

class ReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $releases = Release::with('product:id,title,slug')->get();
        return response($releases);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReleaseRequest $request)
    {
        $data = $request->validated();
        $release = new Release($data);
        $release->save();

        return response(['message' => __('messages.created'), 'id' => $release->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $release = Release::with('product:id,title,slug')->findOrFail($id);
        return response($release);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReleaseRequest $request, string $id)
    {
        $data = $request->safe()->except('version', 'product_id');

        $release = Release::findOrFail($id);
        $release->fill($data);
        $release->save();

        return response(['message' => __('messages.updated'), 'id' => $release->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $release = Release::findOrFail($id);
        $release->delete();

        return response(['message' => __('messages.deleted'), 'id' => $release->id]);
    }
}

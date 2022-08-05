<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Include middleware
     */
    public function __construct()
    {
//        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $items = Item::paginate(20);

        return response()->json([
            'success' => true,
            'message' => 'OK!',
            'data' => $items,
            'errors' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $item = new Item();
        $item->title = $request->get('title');
        $item->description = $request->get('description');
        $item->user_id = $request->get('user_id'); // TODO :: Change to Auth::user->uuid (When implemented authorization)
        $item->category_id = $request->get('category_id');
        $item->type_id = $request->get('type_id');
        $item->save();

        return response()->json([
            'success' => true,
            'message' => 'Item successfully stored!',
            'data' => $item,
            'errors' => []
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $item = Item::where('uuid', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'User successfully show!',
            'data' => $item,
            'errors' => []
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $item = Item::where('uuid', $id)->first();
        $item->title = $request->get('title');
        $item->description = $request->get('description');
        $item->user_id = $request->get('user_id'); // TODO :: Change to Auth::user->uuid (When implemented authorization)
        $item->category_id = $request->get('category_id');
        $item->type_id = $request->get('type_id');
        $item->save();

        return response()->json([
            'success' => true,
            'message' => 'Item successfully updated!',
            'data' => $item,
            'errors' => []
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $item = Item::where('uuid', $id)->first();
        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item successfully deleted!',
            'data' => [],
            'errors' => []
        ]);
    }
}

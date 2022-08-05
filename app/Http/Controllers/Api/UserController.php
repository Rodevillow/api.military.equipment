<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Include middleware
     */
    public function __construct()
    {
//        $this->middleware('jwt.auth');
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::paginate(20);

        return response()->json([
            'success' => true,
            'message' => 'OK!',
            'data' => $users,
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
        $user = new User();
        $user->nickname = $request->get('nickname');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User successfully stored!',
            'data' => $user,
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
        $user = User::where('uuid', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'User successfully show!',
            'data' => $user,
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
        $user = User::where('uuid', $id)->first();
        $user->nickname = $request->get('nickname');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User successfully updated!',
            'data' => $user,
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
        $user = User::where('uuid', $id)->first();
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User successfully deleted!',
            'data' => [],
            'errors' => []
        ]);
    }
}

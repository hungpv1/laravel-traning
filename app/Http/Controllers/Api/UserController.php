<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCurrentUser()
    {
        return response()->json([
            'user_info' => Auth::user(),
        ], 200);
    }

    public function updateCurrentUser(UserUpdateRequest $request)
    {
        $data = $request->validated();
        $id = Auth::user()->id;
        $user = User::find($id)->update($data);
        return response()->json([
            'user_info' => $user,
        ], 200);
    }

    public function updateCurrentUserSocial(Request $request)
    {
        $data = $request->all();
        $id = Auth::user()->id;
        $user = User::find($id)->update(['social_info' => json_encode($data)]);
        return response()->json([
            'user_info' => $user,
        ], 200);
    }
}

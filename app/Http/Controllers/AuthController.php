<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'Email' => 'required|string|unique:users,Email',
            'Password' => 'required|string|confirmed',
            'Username' => 'required|string',
            'IsAdmin' => 'required|string',
            'IdNhanVien' => 'nullable|int',
        ]);

        $user = User::create([
            'Email' => $fields['Email'],
            'Password' => bcrypt($fields['Password']),
            'Username' => $fields['Username'],
            'IsAdmin' => $fields['IsAdmin'],
            'IdNhanVien' => $fields['IdNhanVien'],
        ]);

        $token = $user->createToken('flight_with_us')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'Email' => 'required|string',
            'Password' => 'required|string'
        ]);

        // Check email
        $user = User::where('Email', $fields['Email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['Password'], $user->Password)) {
            return response([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('flight_with_us')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::select()->latest()->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::where('id', '=', $id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', '=', $id)->update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::where('id', '=', $id)->delete();
    }

    public function search(Request $request)
    {
        if ($request["id"] == '') $request["id"] = -1;
        if ($request["IsAdmin"] == '') $request["IsAdmin"] = -1;
        // if ($request["KhungGioBay"] == '') $request["KhungGioBay"] = '-1, -1';
            
        // $kgb = array_map('intval', explode(', ', $request["KhungGioBay"]));
        
        
        return DB::select(DB::raw('declare @param1 int = '.$request["id"].', @param2 int = '.$request["IsAdmin"].'; select * from users where ((@param1 = -1) or (id = @param1)) and ((@param2 = -1) or (IsAdmin = @param2)) order by created_at desc;'));
    }
}
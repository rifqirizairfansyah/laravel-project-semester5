<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|confirmed',
            'nama_lengkap' => 'required|string',
            'umur' => 'required|integer',
            'status_pernikahan' => 'required|string',
            'perkerjaan' => 'required|string',
            'pendapatan_pertahun' => 'required|integer',
            'alamat_ktp' => 'required|string'
        ]);
        $input = $request->all();

        $validationRules = [
            'username' => 'required|string',
            'password' => 'required|confirmed',
            'nama_lengkap' => 'required|string',
            'umur' => 'required|integer',
            'status_pernikahan' => 'required|string',
            'perkerjaan' => 'required|string',
            'pendapatan_pertahun' => 'required|integer',
            'alamat_ktp' => 'required|string'
        ];

        $validator = \Validator::make($input, $validationRules);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $user = new Users;
        $user->username = $request->input('username');
        $plainPassword = $request->input('password');
        $user->password = app('hash')->make($plainPassword);
        $user->nama_lengkap = $request->input('nama_lengkap');
        $user->umur = $request->input('umur');
        $user->status_pernikahan = $request->input('status_pernikahan');
        $user->perkerjaan = $request->input('perkerjaan');
        $user->pendapatan_pertahun = $request->input('pendapatan_pertahun');
        $user->alamat_ktp = $request->input('alamat_ktp');
        $user->save();

        return response()->json($user, 200);
    }

    public function login (Request $request){
        $input = $request->all();

        $validationRules = [
            'username' => 'required|string',
            'password' => 'required|string'
        ];

        $validator = \Validator::make($input, $validationRules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $credentials = $request->only(['username', 'password']);

        if(! $token = Auth::attempt($credentials)){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);
    }
    //
}

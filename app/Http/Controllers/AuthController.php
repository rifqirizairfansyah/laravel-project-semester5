<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Banks;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
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
            'email' => 'required|string',
            'password' => 'required|confirmed',
            'nama_lengkap' => 'required|string',
            'umur' => 'required|integer',
            'status_pernikahan' => 'required|string',
            'perkerjaan' => 'required|string',
            'pendapatan_pertahun' => 'required|integer',
            'alamat_ktp' => 'required|string',
            'nama_bank' => 'required|string',
            'jenis_bank' => 'required|string',
            'no_rekening' => 'required|string'
        ]);
        $input = $request->all();

        $validationRules = [
            'username' => 'required|string',
            'password' => 'required|confirmed',
            'email' => 'required|string',
            'nama_lengkap' => 'required|string',
            'umur' => 'required|integer',
            'status_pernikahan' => 'required|string',
            'perkerjaan' => 'required|string',
            'pendapatan_pertahun' => 'required|integer',
            'alamat_ktp' => 'required|string',
            'nama_bank' => 'required|string',
            'jenis_bank' => 'required|string',
            'no_rekening' => 'required|string',
        ];

        $validator = \Validator::make($input, $validationRules);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $username = $request->input('username');
        $nama_lengkap = $request->input('nama_lengkap');
        $email = $request->input('email');

        $user = new Users;
        $user->username = $username;
        $plainPassword = $request->input('password');
        $user->password = app('hash')->make($plainPassword);
        $user->nama_lengkap = $nama_lengkap;
        $user->email = $email;
        $user->umur = $request->input('umur');
        $user->status_pernikahan = $request->input('status_pernikahan');
        $user->perkerjaan = $request->input('perkerjaan');
        $user->pendapatan_pertahun = $request->input('pendapatan_pertahun');
        $user->alamat_ktp = $request->input('alamat_ktp');
        $user->save();

        // Adding Bank
        $bank = new Banks;
        $bank->nama_bank = $request->input('nama_bank');
        $bank->nama_lengkap_pengguna = $nama_lengkap;
        $bank->jenis_bank = $request->input('jenis_bank');
        $bank->no_rekening = $request->input('no_rekening');
        $bank->save();

        // Mail::to($email)->send(new SendMail($username, $nama_lengkap));

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

        $username = $request->input('username');

        $customClaims = ['username' => $username ];

        if(! $token = Auth::attempt($credentials, $customClaims)){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 120
        ], 200);
    }
    //
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    public function getById($id)
    {
        $post = Users::find($id);

        if(!$post){
            abort(404);
        }

        return response()->json($post, 200);
    }

    public function updateById(Request $request, $id)
    {

        $input = $request->all();

        $post = Users::find($id);

        if(!$post){
            abort(404);
        }

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

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $post->fill($input);
        $post->save();

        return response()->json($post, 200);

    }

    //
}

<?php

namespace App\Http\Controllers;
use App\Mail\SendMail;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    public function mail(Request $request) {
        $this->validate($request, [
            'username' => 'required|string'
        ]);
        $input = $request->all();

        $validationRules = [
            'username' => 'required|string'
        ];

        $validator = \Validator::make($input, $validationRules);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $username = $request->input('username');
        Mail::to($username)->send(new SendMail($username));
        
        return response()->json($username, 200);
    }
}

?>
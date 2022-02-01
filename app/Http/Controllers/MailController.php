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
        $data = array('username' => 'rifqi');
        $to_name = "rifq riza irfansyah";
        $to_email = "rizairfansyahrifqi@gmail.com";
        Mail::to($to_email)->send(new SendMail($to_name));

        return response()->json(200);
    }
}

?>

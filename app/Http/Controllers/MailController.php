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
        $response =  Mail::send('mail', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Test Mail');
            $message->from('rifqibatch@gmail.com', 'RIfqi Batch');
        });

        return response($response)->json(200);
    }
}

?>

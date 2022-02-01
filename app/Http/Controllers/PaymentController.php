<?php

namespace App\Http\Controllers;

use App\Models\Topups;
use App\Models\ListReksadana;
use App\Models\Users;
use App\Models\UserReksadana;
use App\Models\Transakses;
use App\Models\Banks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        if($acceptHeader === 'application/json' || $acceptHeader === 'application/xml')
        {

            $contentTypeHeader = $request->header('Content-Type');
            if($contentTypeHeader === 'application/json')
            {
                $input = $request->all();
                $validationRules = [
                    'jumlah_topup' => 'required|min:3',
                    'tanggal' => 'required|min:1',
                    'id_reksadana' => 'required|min:1',
                    'bank' => 'required|min:1',
                    'nama_lengkap' => 'required|min:1',
                ];
                $validator = \Validator::make($input, $validationRules);

                if($validator->fails())
                {
                    return response()->json($validator->errors(), 400);
                }

                $nama_lengkap = $request->input('nama_lengkap');
                $id_reksadana = $request->input('id_reksadana');
                $tanggal = $request->input('tanggal');
                $jumlah_topup = $request->input('jumlah_topup');
                $id_reksadana = $request->input('id_reksadana');
                $bank = $request->input('bank');

                $getListReksadana = ListReksadana::find($id_reksadana);
                $getUser = Users::where('nama_lengkap', $nama_lengkap)->first();


                $post = Topups::create([
                    'nama_lengkap' => $nama_lengkap,
                    'jumlah_topup' => $jumlah_topup,
                    'tanggal' => $tanggal,
                    'id_reksadana' => $id_reksadana,
                    'bank' => $bank
                ]);

                $Transakses = Transakses::create([
                    'no_order' => substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 5),
                    'nilai_jual' => $getListReksadana->biaya_penjualan,
                    'jenis_transaksi' => 'Pembelian',
                    'reksadana_id' => $id_reksadana,
                    'jumlah_unit' => 100,
                    'rekening_id' => $bank,
                    'status' => 'Berhasil'
                ]);

                $UserReksadana = UserReksadana::create([
                    'user_id' => $getUser->id,
                    'reksadana_id' => $id_reksadana,
                    'jumlah_unit' => 100,
                    'nilai_portofolio' =>  $getListReksadana->biaya_penjualan,
                    'keuntungan' => $getListReksadana->biaya_penjualan,
                    'imba_hasil' => 500
                ]);

                return response()->json($UserReksadana, 200);
            } else {
                return response('Unsupported Media', 415);
            }
        } else {
            return response('Not Acceptable', 406);
        }
    }


}

?>

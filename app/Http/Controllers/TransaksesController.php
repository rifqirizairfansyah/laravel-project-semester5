<?php

namespace App\Http\Controllers;

use App\Models\Transakses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksesController extends Controller
{
    public function index(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        if($acceptHeader === 'application/json' || $acceptHeader === 'application/xml')
        {
            $post = Transakses::OrderBy("id", "DESC")->paginate(2)->toArray();

            if ($acceptHeader === 'application/json') {
               $response = [
                   "total_count" => $post["total"],
                   "limit" => $post["per_page"],
                   "pagination" => [
                       "next_page" => $post['next_page_url'],
                       "current_page" => $post['current_page']
                   ],
                   "data" => $post["data"],
                ];
               return response()->json($response, 200);
            }
        }
        else
        {
            return response('Not Acceptable', 406);
        }
    }

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
                    'no_order' => 'required|min:5',
                    'nilai_jual' => 'required|min:1',
                    'jenis_transaksi' => 'required|min:3',
                    'reksadana_id' => 'required|min:1',
                    'jumlah_unit' => 'required|min:1',
                    'rekening_id' => 'required|min:1',
                    'status' => 'required|min:1',
                ];
                $validator = \Validator::make($input, $validationRules);

                if($validator->fails())
                {
                    return response()->json($validator->errors(), 400);
                }

                $post = Transakses::create($input);
                return response()->json($post, 200);
            } else {
                return response('Unsupported Media', 415);
            }
        } else {
            return response('Not Acceptable', 406);
        }
    }

    public function getById($id)
    {

        $post = Transakses::find($id);
        if(!$post){
            abort(404);
        }

        return response()->json($post, 200);
    }


    public function updateById(Request $request, $id)
    {

        $input = $request->all();

        $post = Portofolios::find($id);

        if(!$post){
            abort(404);
        }

        $validationRules = [
            'nama_portofolio' => 'required|min:5',
            'target_dana' => 'required|min:1',
            'tanggal_tercapai' => 'required|min:3',
            'nilai_portofolio' => 'required|min:1',
            'keuntungan' => 'required|min:1',
            'imba_hasil' => 'required|min:1',
            'reksadana_id' => 'required|min:1',

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

    public function deleteById($id){
        $post = Portofolios::find($id);

        if(!$post){
            abort(404);
        }
        $post->delete();
        $message = ['message' => 'Berhasil Dihapus', 'id' => $id];


        return response()->json($message, 200);
    }
}

?>

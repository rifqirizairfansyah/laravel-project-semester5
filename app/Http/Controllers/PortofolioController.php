<?php

namespace App\Http\Controllers;

use App\Models\Portofolios;
use App\Models\Performas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortofolioController extends Controller
{
    public function index(Request $request)
    {
        $acceptHeader = $request->header('Accept');
        if($acceptHeader === 'application/json' || $acceptHeader === 'application/xml')
        {
            $post = Portofolios::OrderBy("id", "DESC")->paginate(2)->toArray();

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
                    'nama_portofolio' => 'required|min:5',
                    'target_dana' => 'required|min:1',
                    'tanggal_tercapai' => 'required|min:3',
                    'nilai_portofolio' => 'required|min:1',
                    'keuntungan' => 'required|min:1',
                    'imba_hasil' => 'required|min:1',
                    'modal_investasi' => 'required|min:1',
                    'keuntungan_terealisasi' => 'required|min:1',
                    'total_pembelian' => 'required|min:1',
                    'total_penjualan' => 'required|min:1'

                ];
                $validator = \Validator::make($input, $validationRules);

                if($validator->fails())
                {
                    return response()->json($validator->errors(), 400);
                }

                $post = Portofolios::create([
                    'nama_portofolio' => $request->input('nama_portofolio'),
                    'target_dana' => $request->input('target_dana'),
                    'tanggal_tercapai' => $request->input('tantanggal_tercapaiggal'),
                    'nilai_portofolio' => $request->input('nilai_portofolio'),
                    'keuntungan' => $request->input('keuntungan'),
                    'imba_hasil' => $request->input('imba_hasil'),
                    'reksadana_id' => $request->input('reksadana_id')
                ]);

                $getPortofolio = Portofolios::where('nama_portofolio', $request->input('nama_portofolio'))->first();

                $performa = Performas::create([
                    'portofolio_id' => $getPortofolio->id,
                    'modal_investasi' => $request->input('modal_investasi'),
                    'keuntungan_terealisasi' => $request->input('keuntungan_terealisasi'),
                    'total_pembelian' => $request->input('total_pembelian'),
                    'total_penjualan' => $request->input('total_penjualan')
                ]);

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
        $post = Portofolios::join('list_reksadanas', 'list_reksadanas.id', '=', 'portofolios.reksadana_id')
        ->where('portofolios.id', $id)
        ->get();

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

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
}

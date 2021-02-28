<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrlController extends Controller
{
    public function index(){
        $urls = Url::paginate(10)->toJson();
        return response()->json([
            'urls' => $urls
        ]);
    }
    public function show(Request $request, $code){
        $url = DB::table('urls')->where('code', $code)->first;
        if ($url) {
            // aqui todos los procesos
            return redirect()->away($url->url);
        }else{
            abort(404);
        }
    }
    public function store(Request $request, Url $url){
        $code = $url->short_url($request->long_url);
        return response()->json([
            'shot_url' => url('/').'/'.$code
        ]);
    }
}

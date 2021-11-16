<?php

namespace App\Http\Controllers;
use Laravel\Lumen\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Models\{
    Link,
    LinkOut
};

class LinkOutController extends BaseController
{
    public function store(Request $request){
        /** Validação de Parâmetros */
        $this->validate($request, [
            'link_id' => 'numeric|exists:links,id',
            'url' => 'required|string|url|min:10|max:255',
            'redirect_limit' => 'required|numeric|gte:1'
        ]);
        
        $link_out = LinkOut::create($request->all());

        return response()->json($link_out);
    }

    public function update($id, Request $request){
        /** Validação de Parâmetros */
        $this->validate($request, [
            'url' => 'required|string|url|min:10|max:255',
            'redirect_limit' => 'required|numeric|gte:1',
            'expiration_date' => 'date|after_or_equal:today'
        ]);
        
        $link_out = LinkOut::findOrFail($id);

        $link_out->url = $request->url;
        $link_out->redirect_limit = $request->redirect_limit;
        $link_out->expiration_date = $request->expiration_date;
        $link_out->save();

        return response()->json($link_out);
    }
}

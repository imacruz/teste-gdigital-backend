<?php

namespace App\Http\Controllers;
use Laravel\Lumen\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Models\{
    Link,
    LinkOut
};

class LinkController extends BaseController
{
    /**
     * Cadastro de Link de entrada 
     * com 0 ou N links de saídas.
     * 
     *  Parâmetros no Body:
     *  @param name string
     *  @param uri string
     *  @param default_url strig
     *  @param link_outs array 
     *
     */
    public function store(Request $request){
        /** Validação de Parâmetros */
        $this->validate($request, [
            'name' => 'required|string|min:3|max:255',
            'uri' => 'required|string|unique:links|min:3|max:255',
            'default_url' => 'required|url',
            'expiration_date' => 'date|after_or_equal:today',
            'link_outs' => 'array',
            'link_outs.*.url' => 'required|url|string|min:10|max:255',
            'link_outs.*.redirect_limit' => 'required|numeric|gte:1'
        ]);
        
        $link = Link::create($request->all());

        /** Adiciona links de saída, caso informados **/
        if(isset($request->link_outs) && count($request->link_outs) > 0)
            $link->linkOuts()->createMany($request->link_outs);

        return response()->json($link);
    }

    public function update($id, Request $request){

        $this->validate($request, [
            'name' => 'string|min:3|max:255',
            'uri' => 'string|unique:links,id,'.$id.'|min:3|max:255',
            'default_url' => 'url',
            'expiration_date' => 'date|after_or_equal:today'
        ]);

        $link = Link::findOrfail($id);

        $link->name = $request->name;
        $link->uri = $request->uri;
        $link->default_url = $request->default_url;
        $link->expiration_date = $request->expiration_date;
        $link->status = $request->status;
        $link->save();

        return response()->json($link);
    }
}

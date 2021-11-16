<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\{
    Link,
    LinkOut
};

class RedirectController extends BaseController
{
    /**
     * Busca o link desejado para redirecionamento
     * através do @param uri informado.
     */
    public function index($uri){

        $link = Link::where('uri', $uri)
            ->with(['linkOuts' => function($query){
                $query->whereColumn('redirect_count', '<', 'redirect_limit')
                    ->first();
            }])->first();
        
        if(empty($link)){
            return abort(404);
        }

        if((isset($link->expiration_date) && $link->expiration_date < date('Y-m-d')) || $link->status == false || empty($link->linkOuts[0])){
            return redirect($link->default_url);
        }

        $link->linkOuts[0]->redirect_count += 1;
        $link->push();

        return redirect($link->linkOuts[0]->url);
        
    }
}

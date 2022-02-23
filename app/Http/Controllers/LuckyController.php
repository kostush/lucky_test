<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Lucky;
use Illuminate\Http\Request;

class LuckyController extends Controller
{
    //

    public function go(Request $request, $uniqLink = null)
    {
        //**  автризция по куке
        // $cookieHash = $request->cookie('hash');
        ////$Link = Link::where('client_hash',$cookieHash)->latest()->first();

        $Link = (new Link())->getByShort($uniqLink); //авторизация по уникальной короткой ссылке
        if (! $Link) abort(404);

        return view('home.process',['link'=> $Link->short]);
    }

    public function checkLucky($link = null)
    {
        $Link = (new Link())->getByShort($link);
        $client = $Link->client;
        $Lucky = new Lucky();
        $result = $Lucky->generateLucky($client);
        return response()->json($result);

    }

    public function generateNewLink($link)
    {
        $Link = Link::where('short', $link)->first();
        $client = $Link->client;
        $currentLink = $Link->generateLink($client->getHash(), $client->getId());
        if (! $currentLink) abort(404);
        return redirect()->route('lucky',['link'=> $currentLink->short]) -> with(['link' => $currentLink->short] );
    }

    public function deactivateLink($link)
    {
        $Link = Link::where('short', $link)->delete();
        return redirect()->route('init');
    }

    public function history($link)
    {
        $Link = Link::where('short', $link)->first();
        $client = $Link->client;
        $history = $client->luckies->reverse()->take(3);

        return response()->json($history);
    }
}

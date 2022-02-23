<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Link;
use App\Models\Lucky;
use App\Models\ShortLink;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

/**
 * Class InitController
 * @package App\Http\Controllers
 * @param  Client
 */
class InitController extends Controller
{
    //
    protected   $rules = [
        'name ' => 'required|string',
        'phone' => 'required|string',
    ];
    protected $cookiePeriod = 7;
    protected $cookieName = 'hash';


    public function init(Request $request)
    {
        return view('home.login');
    }

    public function process(Request $request)
    {
        $validationData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string'
        ]);

        $hash = hash("md5",$request->input('name') . $request->input('phone'));
        $Client = Client::firstOrNew([
            'hash' => $hash
            ]
        );
        $Client->setName( $request->input('name'));
        $Client->setPhone( $request->input('phone'));
        $Client->setHash($hash);
        $Client->save();


        /**
         * @param  Link
         */
        if($Client){
           $currentLink =  (new Link())->generateLink($Client->getHash(),  $Client->getId());
        }

        if (! $currentLink) abort(404);
        $cookie = Cookie::make($this->cookieName, $Client->getHash(),$this->cookiePeriod);

        return redirect()->route('lucky',['link'=> $currentLink->short])
            -> with(['link' => $currentLink->short] )
            ->withCookie($cookie);

    }



}


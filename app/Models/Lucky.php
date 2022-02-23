<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class Lucky extends Model
{
    use HasFactory;


    /**
     *  * Class Lucky
     * @package App\Models
     *
     * @property int $id
     * @property int $user_id
     * @property int $random
     * @property float $ammount
     * @property boolean $win
     * @property string $hash
     */

    private $rate =[
        '300' => 10,
        '600' => 30,
        '900' => 50,
        '1000' => 70,
    ];

    /********************Relations****************************/

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class)->withDefault();
    }

    /*********************************************************/

    public function generateLucky($Client):array
    {
        $random = rand(1, 1000);
        if ($random % 2 === 0){
            $ammount = $this->calculateWinSumm($random);
            $status = true;
        }
        else{
            $ammount = 0;
            $status = false;
        }
        $this->client_id = $Client->getId();
        $this->random = $random;
        $this->ammount = $ammount;
        $this->win = $status;
        $this->hash = $Client->getHash();
        $this->save();

        return [
            'random'   =>$random,
            'status'   => $status,
            'ammount' => $ammount,
            'hash' =>$this->hash,
        ];
    }

    private function calculateWinSumm($random):float
    {
        foreach($this->rate as $key => $value){
            if ($random < intval($key)){
                $ammount = $random * $value /100;
                break;
            }
        }
        return $ammount;
    }
}

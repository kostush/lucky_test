<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Link extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'short',
        'client_id',
        'full',
        'client_hash',
        'expiration'
    ];

    public $shortFieldName      = "short";
    public $fullFieldName       = "full";
    public $paramsFieldName     = "params";
    public $expirationFieldName = "expiration";
    public $clientHashFieldName   = "client_hash";
    public $clientIdFieldName     = "client_id";

    public function __construct(array $attributes = [])
    {
        $this->connection = env('LUCKY_CONNECTION');
        parent::__construct($attributes);
    }

    /********************Relations****************************/

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class)->withDefault();
    }

    /*********************************************************/


    public function getShortFieldName():string
    {
        return $this->shortFieldName;
    }

    public function getFullFieldName():string
    {
        return $this->fullFieldName;
    }

    public function getParamsFieldName():string
    {
        return $this->paramsFieldName;
    }

    public  function getExpirationFieldName()
    {
        return $this->expirationFieldName;
    }

    public  function getClientHashFieldName()
    {
        return $this->clientHashFieldName;
    }

    public function getClientIdFieldName()
    {
        return $this->clientIdFieldName;
    }

    public  function getByShort($short)
    {
        $date = Carbon::now();
        return $this->where($this->getShortFieldName(),$short)->where($this->expirationFieldName,">", $date)->first();
    }


    private function generateShort():string
    {
        $string = Str::random(16);
        if ($this->where($this->getShortFieldName(), $string)->select('id')->first()){
            $string = $this->generateShort();
        }
        return $string;
    }


    public function generateLink($hash, $clientId, $link = 'sd.ua',$expirationPeriod = 7)
    {
        return self::create( [
            $this->getClientIdFieldName() => $clientId,
            $this->getShortFieldName() => $this->generateShort(),
            $this->getFullFieldName()  => $link,
            $this->getClientHashFieldName()  => $hash,
            $this->getExpirationFieldName() => Carbon::now()->addDays($expirationPeriod)
        ]);
    }
}

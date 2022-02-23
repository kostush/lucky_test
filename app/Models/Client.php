<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Link;
use App\Models\Lucky;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'hash',
    ];

    /********************************Relations***************************/

    public function links(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Link::class);
    }

    public function luckies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Lucky::class);
    }
    /********************************Relations***************************/

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function setHash($hash)
    {
        $this->hash = $hash;
    }


    public function getId()
    {
        return $this->id;
    }
}

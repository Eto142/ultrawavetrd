<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NftCollection extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function nfts()
    {
        return $this->hasMany(Nft::class);
    }
}

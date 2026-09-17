<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NftLike extends Model
{
    protected $fillable = [
        'user_id',
        'nft_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nft()
    {
        return $this->belongsTo(Nft::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nft extends Model
{
    public const CATEGORIES = [
        'digital_art' => 'Digital Art',
        'photography' => 'Photography',
        'music' => 'Music',
        'collectibles' => 'Collectibles',
        'virtual_worlds' => 'Virtual Worlds',
    ];

    protected $fillable = [
        'user_id',
        'nft_collection_id',
        'name',
        'description',
        'category',
        'price',
        'image_path',
        'properties',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:8',
            'properties' => 'array',
            'is_featured' => 'boolean',
        ];
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function collection()
    {
        return $this->belongsTo(NftCollection::class, 'nft_collection_id');
    }

    public function likes()
    {
        return $this->hasMany(NftLike::class);
    }

    public function isLikedBy(?User $user): bool
    {
        if (! $user) {
            return false;
        }

        return $this->likes->contains('user_id', $user->id);
    }
}

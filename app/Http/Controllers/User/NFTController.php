<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Nft;
use App\Models\NftCollection;
use Illuminate\Http\Request;

class NFTController extends Controller
{
    public function index()
    {
        return redirect()->route('user.nft-gallery');
    }

    public function NftGallery(Request $request)
    {
        $collections = NftCollection::withCount('nfts')->orderBy('name')->get();

        $nfts = Nft::query()
            ->with(['collection', 'likes'])
            ->when($request->filled('category_id'), fn ($query) => $query->where('category', $request->string('category_id')))
            ->when($request->filled('collection_id'), fn ($query) => $query->where('nft_collection_id', $request->integer('collection_id')))
            ->when($request->filled('min_price'), fn ($query) => $query->where('price', '>=', $request->float('min_price')))
            ->when($request->filled('max_price'), fn ($query) => $query->where('price', '<=', $request->float('max_price')))
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search');
                $query->where(fn ($q) => $q->where('name', 'like', "%{$search}%")->orWhere('description', 'like', "%{$search}%"));
            })
            ->when($request->string('sort')->toString(), function ($query, $sort) {
                match ($sort) {
                    'price_asc' => $query->orderBy('price'),
                    'price_desc' => $query->orderByDesc('price'),
                    'popular' => $query->orderByDesc('views_count'),
                    'liked' => $query->withCount('likes')->orderByDesc('likes_count'),
                    default => $query->latest(),
                };
            }, fn ($query) => $query->latest())
            ->get();

        $featured = Nft::where('is_featured', true)->latest()->take(10)->get();

        return view('user.nft-gallery', compact('nfts', 'featured', 'collections'));
    }

    public function show(Nft $nft)
    {
        $nft->increment('views_count');
        $nft->load(['collection', 'owner', 'likes']);

        return view('user.nft-show', compact('nft'));
    }

    public function like(Request $request, Nft $nft)
    {
        $like = $nft->likes()->where('user_id', $request->user()->id)->first();

        if ($like) {
            $like->delete();
        } else {
            $nft->likes()->create(['user_id' => $request->user()->id]);
        }

        return back();
    }

    public function MyCollection(Request $request)
    {
        $user = $request->user();
        $tab = $request->string('tab')->toString() ?: 'owned';

        $owned = $user->nfts()->with('collection')->latest()->get();
        $favorites = Nft::whereHas('likes', fn ($query) => $query->where('user_id', $user->id))
            ->with('collection')
            ->latest()
            ->get();

        $nfts = $tab === 'favorites' ? $favorites : $owned;

        $stats = [
            'owned' => $owned->count(),
            'favorites' => $favorites->count(),
            'total_value' => $owned->sum('price'),
        ];

        return view('user.my-collection', compact('nfts', 'tab', 'stats'));
    }

    public function MintNft()
    {
        $collections = NftCollection::orderBy('name')->get();

        return view('user.mint-nft', compact('collections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'in:' . implode(',', array_keys(Nft::CATEGORIES))],
            'nft_collection_id' => ['nullable', 'exists:nft_collections,id'],
            'properties' => ['nullable', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
        ]);

        $properties = null;
        if (! empty($validated['properties'])) {
            $decoded = json_decode($validated['properties'], true);
            $properties = json_last_error() === JSON_ERROR_NONE ? $decoded : null;
        }

        $imagePath = $request->file('image')->store('nfts', 'public');

        $nft = $request->user()->nfts()->create([
            'nft_collection_id' => $validated['nft_collection_id'] ?? null,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'],
            'price' => $validated['price'],
            'image_path' => $imagePath,
            'properties' => $properties,
        ]);

        return redirect()->route('user.my-collection')->with('success', "\"{$nft->name}\" has been minted successfully.");
    }
}

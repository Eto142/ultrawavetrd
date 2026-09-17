<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nft;
use Illuminate\Http\Request;

class NftController extends Controller
{
    public function index(Request $request)
    {
        $nfts = Nft::with(['owner', 'collection'])
            ->when($request->filled('search'), fn ($q) => $q->where('name', 'like', '%' . $request->string('search') . '%'))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.nfts.index', compact('nfts'));
    }

    public function toggleFeature(Nft $nft)
    {
        $nft->update(['is_featured' => ! $nft->is_featured]);

        return back()->with('success', $nft->is_featured ? 'NFT featured.' : 'NFT unfeatured.');
    }

    public function destroy(Nft $nft)
    {
        $nft->delete();

        return back()->with('success', 'NFT removed.');
    }
}

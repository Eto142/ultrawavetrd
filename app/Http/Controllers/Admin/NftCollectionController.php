<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NftCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NftCollectionController extends Controller
{
    public function index()
    {
        $collections = NftCollection::withCount('nfts')->latest()->paginate(20);

        return view('admin.nft-collections.index', compact('collections'));
    }

    public function create()
    {
        return view('admin.nft-collections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        NftCollection::create($validated);

        return redirect()->route('admin.nft-collections')->with('success', 'Collection created.');
    }

    public function edit(NftCollection $nftCollection)
    {
        return view('admin.nft-collections.edit', ['collection' => $nftCollection]);
    }

    public function update(Request $request, NftCollection $nftCollection)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $nftCollection->update($validated);

        return redirect()->route('admin.nft-collections')->with('success', 'Collection updated.');
    }

    public function destroy(NftCollection $nftCollection)
    {
        $nftCollection->delete();

        return back()->with('success', 'Collection removed.');
    }
}

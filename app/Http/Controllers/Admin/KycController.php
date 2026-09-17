<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KycSubmission;
use Illuminate\Http\Request;

class KycController extends Controller
{
    public function index(Request $request)
    {
        $submissions = KycSubmission::with('user')
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->integer('status')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.kyc.index', compact('submissions'));
    }

    public function show(KycSubmission $kyc)
    {
        $kyc->load('user');

        return view('admin.kyc.show', ['submission' => $kyc]);
    }

    public function approve(KycSubmission $kyc)
    {
        $kyc->update([
            'status' => KycSubmission::STATUS_APPROVED,
            'rejection_reason' => null,
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'KYC submission approved.');
    }

    public function reject(Request $request, KycSubmission $kyc)
    {
        $validated = $request->validate([
            'rejection_reason' => ['required', 'string', 'max:500'],
        ]);

        $kyc->update([
            'status' => KycSubmission::STATUS_REJECTED,
            'rejection_reason' => $validated['rejection_reason'],
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'KYC submission rejected.');
    }
}

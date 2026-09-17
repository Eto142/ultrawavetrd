<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\KycSubmission;
use Illuminate\Http\Request;

class KYCController extends Controller
{
    public function index(Request $request)
    {
        $submission = $request->user()->latestKycSubmission;

        return view('user.kyc', compact('submission'));
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $submission = $user->latestKycSubmission;

        if ($submission && ($submission->isPending() || $submission->isApproved())) {
            return redirect()->route('user.kyc');
        }

        return view('user.kyc-apply', compact('user', 'submission'));
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $existing = $user->latestKycSubmission;

        if ($existing && ($existing->isPending() || $existing->isApproved())) {
            return redirect()->route('user.kyc')->with('error', $existing->isApproved()
                ? 'Your identity has already been verified.'
                : 'Your KYC submission is already under review.');
        }

        $validated = $request->validate([
            'document_type' => ['required', 'in:' . implode(',', array_keys(KycSubmission::DOCUMENT_TYPES))],
            'document_number' => ['required', 'string', 'max:100'],
            'date_of_birth' => ['required', 'date', 'before:-18 years'],
            'country' => ['required', 'string', 'max:255'],
            'front_document' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'back_document' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'selfie' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ]);

        $frontPath = $request->file('front_document')->store('kyc/' . $user->id, 'local');
        $backPath = $request->hasFile('back_document') ? $request->file('back_document')->store('kyc/' . $user->id, 'local') : null;
        $selfiePath = $request->file('selfie')->store('kyc/' . $user->id, 'local');

        $user->kycSubmissions()->create([
            'document_type' => $validated['document_type'],
            'document_number' => $validated['document_number'],
            'date_of_birth' => $validated['date_of_birth'],
            'country' => $validated['country'],
            'front_document_path' => $frontPath,
            'back_document_path' => $backPath,
            'selfie_path' => $selfiePath,
            'status' => KycSubmission::STATUS_PENDING,
        ]);

        return redirect()->route('user.kyc')->with('success', 'Your KYC documents have been submitted and are pending review.');
    }
}

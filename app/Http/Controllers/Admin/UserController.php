<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminMessageMail;
use App\Models\Balance;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search');
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load([
            'deposits' => fn ($q) => $q->latest(),
            'withdrawals' => fn ($q) => $q->latest(),
            'profits' => fn ($q) => $q->latest(),
            'bonuses' => fn ($q) => $q->latest(),
            'loans' => fn ($q) => $q->latest(),
            'investments' => fn ($q) => $q->latest(),
            'kycSubmissions' => fn ($q) => $q->latest(),
        ]);

        $balance = Balance::for($user);

        return view('admin.users.show', compact('user', 'balance'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:255'],
        ]);

        $user->update($validated);

        return back()->with('success', 'User profile updated.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User account deleted.');
    }

    public function sendMail(Request $request, User $user)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Mail::to($user->email)->send(new AdminMessageMail($user->name, $validated['subject'], $validated['message']));

        return back()->with('success', "Email sent to {$user->name}.");
    }

    public function credit(Request $request, User $user)
    {
        $validated = $request->validate([
            'method' => ['required', 'string', 'max:50'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'date' => ['required', 'date'],
        ]);

        $occurredAt = \Illuminate\Support\Carbon::parse($validated['date']);

        $deposit = $user->deposits()->create([
            'method' => $validated['method'],
            'amount' => $validated['amount'],
            'status' => Deposit::STATUS_APPROVED,
        ]);
        $deposit->forceFill(['created_at' => $occurredAt])->save();

        $transaction = Transaction::record(
            user: $user,
            type: Transaction::TYPE_CREDIT,
            category: 'deposit',
            amount: (float) $validated['amount'],
            reference: $deposit,
            description: $validated['method'],
        );
        $transaction->forceFill(['created_at' => $occurredAt])->save();

        return back()->with('success', 'Deposit of $' . number_format($validated['amount'], 2) . " added to {$user->name}'s account.");
    }
}

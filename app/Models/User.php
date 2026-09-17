<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'gender',
        'country',
        'currency_code',
        'account_types',
        'password',
        'avatar_path',
        'address',
        'state',
        'zipcode',
        'referral_code',
        'referred_by',
    ];

    protected static function booted(): void
    {
        static::creating(function (User $user) {
            if (empty($user->referral_code)) {
                do {
                    $code = strtoupper(Str::random(8));
                } while (static::where('referral_code', $code)->exists());

                $user->referral_code = $code;
            }
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp_code',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'otp_expires_at' => 'datetime',
            'account_types' => 'array',
            'password' => 'hashed',
        ];
    }

    /**
     * Determine if the user has verified their email via OTP.
     */
    public function hasVerifiedEmail(): bool
    {
        return ! is_null($this->email_verified_at);
    }

    public function avatarUrl(): string
    {
        return $this->avatar_path
            ? asset('storage/' . $this->avatar_path)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=EFB90B&color=0D0F14';
    }

    public function referredBy()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function profits()
    {
        return $this->hasMany(Profit::class);
    }

    public function bonuses()
    {
        return $this->hasMany(Bonus::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    public function signalSubscriptions()
    {
        return $this->hasMany(SignalSubscription::class);
    }

    public function preIpoHoldings()
    {
        return $this->hasMany(PreIpoHolding::class);
    }

    public function stockOrders()
    {
        return $this->hasMany(StockOrder::class);
    }

    public function nfts()
    {
        return $this->hasMany(Nft::class);
    }

    public function nftLikes()
    {
        return $this->hasMany(NftLike::class);
    }

    public function trades()
    {
        return $this->hasMany(Trade::class);
    }

    public function copyTradingSubscriptions()
    {
        return $this->hasMany(CopyTradingSubscription::class);
    }

    public function courseEnrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function kycSubmissions()
    {
        return $this->hasMany(KycSubmission::class);
    }

    public function latestKycSubmission()
    {
        return $this->hasOne(KycSubmission::class)->latestOfMany();
    }

    public function isKycApproved(): bool
    {
        return $this->latestKycSubmission?->isApproved() ?? false;
    }

    public function isKycPending(): bool
    {
        return $this->latestKycSubmission?->isPending() ?? false;
    }

    public function kycStatusLabel(): string
    {
        return $this->latestKycSubmission?->statusLabel() ?? 'Not Verified';
    }
}

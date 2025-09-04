<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'otp',
        'type',
        'expires_at',
        'used'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used' => 'boolean',
    ];

    const TYPE_EMAIL_VERIFICATION = 'email_verification';
    const TYPE_PASSWORD_RESET = 'password_reset';

    public static function generateOtp($email, $type, $expiryMinutes = 15)
    {
        // Delete old OTPs for this email and type
        self::where('email', $email)
            ->where('type', $type)
            ->delete();

        // Generate new OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        return self::create([
            'email' => $email,
            'otp' => $otp,
            'type' => $type,
            'expires_at' => Carbon::now()->addMinutes($expiryMinutes),
        ]);
    }

    public function isValid()
    {
        return !$this->used && $this->expires_at > Carbon::now();
    }

    public function markAsUsed()
    {
        $this->update(['used' => true]);
    }

    public static function verifyOtp($email, $otp, $type)
    {
        $otpRecord = self::where('email', $email)
            ->where('otp', $otp)
            ->where('type', $type)
            ->where('used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($otpRecord) {
            $otpRecord->markAsUsed();
            return true;
        }

        return false;
    }
}

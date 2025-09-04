<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EmailVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token',
        'created_at',
        'expires_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public $timestamps = false;

    /**
     * Generate a new verification token
     */
    public static function generateToken(string $email): string
    {
        // Delete any existing tokens for this email
        self::where('email', $email)->delete();

        $token = Str::random(64);

        self::create([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now(),
            'expires_at' => Carbon::now()->addHours(24), // Token expires in 24 hours
        ]);

        return $token;
    }

    /**
     * Verify the token
     */
    public static function verifyToken(string $email, string $token): bool
    {
        $verification = self::where('email', $email)
            ->where('token', $token)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($verification) {
            // Delete the token after successful verification
            $verification->delete();
            return true;
        }

        return false;
    }

    /**
     * Clean up expired tokens
     */
    public static function cleanupExpiredTokens(): void
    {
        self::where('expires_at', '<', Carbon::now())->delete();
    }
}

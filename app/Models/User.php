<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ─── Role Helpers ────────────────────────────────────────────────────────

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isProfissional(): bool
    {
        return $this->role === 'profissional';
    }

    public function isUtilizador(): bool
    {
        return $this->role === 'utilizador';
    }

    /** Pode criar/editar posts (admin ou profissional) */
    public function canPost(): bool
    {
        return in_array($this->role, ['admin', 'profissional']);
    }

    // ─── Relationships ───────────────────────────────────────────────────────

    public function weeklyPurchases()
    {
        return $this->hasMany(UserWeeklyPurchase::class);
    }

    public function scores()
    {
        return $this->hasMany(UserScore::class);
    }

    public function monthlyScores()
    {
        return $this->hasMany(UserMonthlyScore::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function latestScore()
    {
        return $this->hasOne(UserScore::class)->latestOfMany();
    }

    public function currentMonthScore()
    {
        $mesAtual = now()->format('Y-m');
        return $this->hasOne(UserMonthlyScore::class)->where('mes_ano', $mesAtual)->latestOfMany();
    }
}

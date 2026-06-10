<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'life', 'energy', 'money', 'nerve', 'strength', 'level', 'xp'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const MAX_LEVEL = 100;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_action_at' => 'datetime',
            'energy' => 'integer',
            'money' => 'integer',
            'nerve' => 'integer',
            'strength' => 'integer',
            'life' => 'integer',
            'level' => 'integer',
            'xp' => 'integer',
        ];
    }

    /**
     * Regenerate energy and nerve for offline time passed.
     *
     * Energy gains +5 every 5 minutes, nerve gains +1 every 5 minutes.
     * Values are capped at their maximum thresholds.
     */
    public function regenerateEnergyAndNerve(?Carbon $now = null): void
    {
        $now = $now ?: now();

        if ($this->last_action_at === null) {
            $this->last_action_at = $now;
            $this->save();
            return;
        }

        $minutesPassed = $this->last_action_at->diffInMinutes($now);

        if ($minutesPassed < 5) {
            return;
        }

        $ticks = intdiv($minutesPassed, 5);
        $this->energy = min(100, $this->energy + 5 * $ticks);
        $this->nerve = min(10, $this->nerve + 1 * $ticks);
        $this->last_action_at = $now;
        $this->save();
    }

    public function xpToNextLevel(): int
    {
        if ($this->level >= self::MAX_LEVEL) {
            return 0;
        }

        return (int) max(
            150,
            100 + $this->level * 12 + ($this->level ** 2) * 10
        );
    }

    public function gainXp(int $amount): void
    {
        if ($this->level >= self::MAX_LEVEL || $amount <= 0) {
            return;
        }

        $this->xp += $amount;

        while ($this->level < self::MAX_LEVEL && $this->xp >= $threshold = $this->xpToNextLevel()) {
            $this->xp -= $threshold;
            $this->level++;
        }

        if ($this->level >= self::MAX_LEVEL) {
            $this->xp = 0;
        }

        $this->save();
    }

    public function takeDamage(int $amount): void
    {
        $this->life = max(0, $this->life - $amount);
        $this->save();
    }

    public function healLife(int $amount): void
    {
        $this->life = min(100, $this->life + $amount);
        $this->save();
    }
}

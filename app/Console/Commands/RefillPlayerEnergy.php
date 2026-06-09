<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class RefillPlayerEnergy extends Command
{
    // The command you type into the terminal manually
    protected $signature = 'players:refill-energy';

    // Description of what the command does
    protected $description = 'Increments all player energy (+5), nerve (+2), and life (+15) up to their maximum thresholds.';

    public function handle()
    {
        // 1. REFILL ENERGY (+5 increments up to a max threshold of 100)
        User::where('energy', '<', 100)->increment('energy', 5);
        User::where('energy', '>', 100)->update(['energy' => 100]);

        // 2. REFILL NERVE (+2 increments up to a max threshold of 10)
        User::where('nerve', '<', 10)->increment('nerve', 2);
        User::where('nerve', '>', 10)->update(['nerve' => 10]);

        // 3. REFILL LIFE (+15 increments up to a max threshold of 100)
        User::where('life', '<', 100)->increment('life', 15);
        User::where('life', '>', 100)->update(['life' => 100]);

        $this->info('Game tick cycle: Energy (+5), Nerve (+2), and Life (+15) successfully restored.');
    }
}

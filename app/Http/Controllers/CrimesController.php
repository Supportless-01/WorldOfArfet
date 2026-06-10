<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrimesController extends Controller
{
    // 1. Render the Crimes Screen
    public function index()
    {
        return view('crimes');
    }

    // 2. Process the Shoplifting Crime Loop
    public function shoplift(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $nerveCost = 2;

        if ($user->life <= 0) {
            return redirect()->back()->with('error', 'You are too injured to commit any crimes. Recover your life before trying again.');
        }

        // Security Validation Check
        if ($user->nerve < $nerveCost) {
            return redirect()->back()->with('error', 'You do not have enough Nerve to execute this crime operation!');
        }

        // Spend the Nerve variable
        $user->nerve = $user->nerve - $nerveCost;

        // The Random Dice Roll (65% Success Chance)
        $diceRoll = rand(1, 100);

        if ($diceRoll <= 65) {
            // Success! Generate a random cash payout value
            $cashReward = rand(45, 120);
            $xpGain = rand(8, 16);

            $user->money = $user->money + $cashReward;
            $user->gainXp($xpGain);

            return redirect()->back()->with('success', "SUCCESSFUL HEIST: You slipped a gilded purse from a distracted merchant in the Thieves' Quarter. Gained +$" . number_format($cashReward) . " gold and +{$xpGain} XP toward your next level!");
        } else {
            // Failure logic
            $damage = rand(5, 15);
            $user->takeDamage($damage);

            return redirect()->back()->with('error', "HEIST UNCOVERED: A patrol caught your hand in the lane. You escaped with wounds, losing {$damage} Life!");
        }
    }
}

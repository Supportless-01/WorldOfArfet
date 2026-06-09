<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GymController extends Controller
{
    // 1. Show the Gym Webpage
    public function index()
    {
        return view('gym');
    }

    public function train(Request $request)
    {

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $energyCost = 10;
        $strengthGain = 5;

        if ($user->energy < $energyCost) {
            return redirect()->back()->with('error', 'You do not have enough energy to train!');
        }

        $user->energy = $user->energy - $energyCost;
        $user->strength = $user->strength + $strengthGain;

        $user->save();
        return redirect()->back()->with('success', "You hit the gym weights! Spent {$energyCost} Energy and gained +{$strengthGain} Strength.");
    }
}
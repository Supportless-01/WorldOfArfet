<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CrimesController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\ProfileController;
use App\Models\User;

// Dynamic Activity Tracking Engine
if (Auth::check()) {
    $user = User::find(Auth::id());

    if ($user) {
        $user->regenerateEnergyAndNerve();
        DB::table('users')->where('id', $user->id)->update(['last_action_at' => now()]);
    }
} else {
    // If logged out on the welcome screen, seed a temporary action timestamp into your first user 
    // so the query always reads at least 1 active operator on your local test server
    DB::table('users')->limit(1)->update(['last_action_at' => now()]);
}


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/gym', [GymController::class, 'index'])->middleware(['auth'])->name('gym');
    Route::get('/crimes', [CrimesController::class, 'index'])->middleware(['auth'])->name('crimes');
    Route::post('/crimes/shoplift', [CrimesController::class, 'shoplift'])->middleware(['auth'])->name('crimes.shoplift');
    Route::get('/inventory', [InventoryController::class, 'index'])->middleware(['auth'])->name('inventory');
    Route::get('/market', [MarketController::class, 'index'])->middleware(['auth'])->name('market');
    Route::post('/market/buy/{id}', [MarketController::class, 'buy'])->middleware(['auth'])->name('market.buy');
    Route::post('/inventory/equip/{id}', [InventoryController::class, 'toggleEquip'])->middleware(['auth'])->name('inventory.equip');
    Route::post('/inventory/consume/{id}', [InventoryController::class, 'consume'])->middleware(['auth'])->name('inventory.consume');
    Route::post('/gym/train', [GymController::class, 'train'])->middleware(['auth'])->name('gym.train');
});

require __DIR__ . '/auth.php';

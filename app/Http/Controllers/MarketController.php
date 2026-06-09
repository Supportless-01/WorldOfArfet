<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\ItemDefinitions; // Connect to our new item array lists

class MarketController extends Controller
{
    public function index()
    {
        $items = array_filter(ItemDefinitions::$list, function ($item) {
            return $item['available'] ?? true;
        });

        return view('market', compact('items'));
    }

    public function buy(Request $request, $itemKey)
    {
        $masterList = ItemDefinitions::$list;

        if (!array_key_exists($itemKey, $masterList) || !($masterList[$itemKey]['available'] ?? true)) {
            return redirect()->back()->with('error', 'Item is not available for purchase in this market.');
        }

        $targetItem = $masterList[$itemKey];
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->money < $targetItem['price']) {
            return redirect()->back()->with('error', 'Inadequate financial allocations! You need $' . number_format($targetItem['price']) . ' to purchase this.');
        }

        // Deduct money row loop
        $user->money = $user->money - $targetItem['price'];
        $user->save();

        // Look up item key instead of plain text names
        $existingItem = DB::table('inventories')
            ->where('user_id', $user->id)
            ->where('item_key', $itemKey)
            ->first();

        if ($existingItem) {
            DB::table('inventories')->where('id', $existingItem->id)->increment('qty', 1);
        } else {
            DB::table('inventories')->insert([
                'user_id'    => $user->id,
                'item_key'   => $itemKey, // Store item key tracking parameter
                'item_name'  => $targetItem['name'],
                'item_type'  => $targetItem['type'],
                'qty'        => 1,
                'equipped'   => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', "PURCHASE COMPLETE: Bought 1x {$targetItem['name']} for $" . number_format($targetItem['price']) . "!");
    }
}

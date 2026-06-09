<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\ItemDefinitions;
use App\Models\User;

class InventoryController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Query the database to retrieve all item entries belonging to this player profile
        $items = DB::table('inventories')->where('user_id', $userId)->get();

        // Enrich items with their definitions (description and stat info)
        $masterList = ItemDefinitions::$list;
        $enrichedItems = $items->map(function ($item) use ($masterList) {
            $definition = null;

            if (!empty($item->item_key) && array_key_exists($item->item_key, $masterList)) {
                $definition = $masterList[$item->item_key];
            } else {
                foreach ($masterList as $key => $def) {
                    if ($def['name'] === $item->item_name && $def['type'] === $item->item_type) {
                        $definition = $def;
                        break;
                    }
                }
            }

            if ($definition) {
                $item->item_description = $definition['description'];
                $item->item_stat_name = $definition['stat_name'];
                $item->item_stat_value = $definition['stat_value'];
            }

            return $item;
        });

        return view('inventory', ['items' => $enrichedItems]);
    }

    // Process Equipping and Unequipping Items
    public function toggleEquip($itemId)
    {
        $userId = Auth::id();

        // Find the targeted locker item row entry belonging to this specific user profile
        $item = DB::table('inventories')
            ->where('id', $itemId)
            ->where('user_id', $userId)
            ->first();

        if (!$item) {
            return redirect()->back()->with('error', 'Item record designation not found in your locker framework.');
        }

        // Determine the current state logic to invert it
        $newState = !$item->equipped;

        // Rule: If equipping a weapon, unequip any other currently active weapons first
        if ($newState == true) {
            DB::table('inventories')
                ->where('user_id', $userId)
                ->where('item_type', $item->item_type)
                ->update(['equipped' => false]);
        }

        // Update the target database flag field matrix parameter
        DB::table('inventories')
            ->where('id', $itemId)
            ->update(['equipped' => $newState, 'updated_at' => now()]);

        $actionText = $newState ? "EQUIPPED" : "UNEQUIPPED";
        return redirect()->back()->with('success', "LOCKER MATRIX MODIFIED: Successfully {$actionText} 1x {$item->item_name}.");
    }

    public function consume($itemId)
    {
        $userId = Auth::id();

        $item = DB::table('inventories')
            ->where('id', $itemId)
            ->where('user_id', $userId)
            ->first();

        if (!$item || $item->item_type !== 'consumable') {
            return redirect()->back()->with('error', 'Consumable item not found in your inventory.');
        }

        $masterList = ItemDefinitions::$list;
        $targetItem = null;

        if (!empty($item->item_key) && array_key_exists($item->item_key, $masterList)) {
            $targetItem = $masterList[$item->item_key];
        } else {
            foreach ($masterList as $definition) {
                if ($definition['name'] === $item->item_name && $definition['type'] === $item->item_type) {
                    $targetItem = $definition;
                    break;
                }
            }
        }

        if (!$targetItem) {
            return redirect()->back()->with('error', 'Unable to resolve consumable metadata for this item.');
        }

        $user = User::find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'Player account not found.');
        }

        if (str_contains($targetItem['stat_name'], 'Nerve') || str_contains($targetItem['stat_name'], 'Resolve')) {
            $user->nerve = min(10, $user->nerve + $targetItem['stat_value']);
        } elseif (str_contains($targetItem['stat_name'], 'Energy')) {
            $user->energy = min(100, $user->energy + $targetItem['stat_value']);
        }

        $user->save();

        if ($item->qty <= 1) {
            DB::table('inventories')->where('id', $itemId)->delete();
        } else {
            DB::table('inventories')->where('id', $itemId)->decrement('qty', 1);
        }

        return redirect()->back()->with('success', "CONSUMED 1x {$item->item_name}: {$targetItem['stat_name']} +{$targetItem['stat_value']}.");
    }
}

@extends('layouts.game')

@section('title', 'Adventurer\'s Satchel - The World of Arfet')

@section('styles')
<style>
    .inv-table {
        width: 100%;
        border: 1px solid #4b3725;
        margin-top: 15px;
        background-color: rgba(34, 24, 18, 0.95);
        border-radius: 10px;
        overflow: hidden;
    }

    .inv-th {
        background-color: #4a3729;
        color: #f2d49e;
        font-weight: bold;
        padding: 10px;
        text-align: left;
        text-transform: uppercase;
        border-bottom: 1px solid #644e3b;
        letter-spacing: 0.5px;
    }

    .inv-tr:nth-child(even) {
        background-color: rgba(45, 34, 25, 0.9);
    }

    .inv-td {
        padding: 10px;
        border-bottom: 1px dashed #3f2e1f;
        font-family: "Palatino Linotype", Georgia, serif;
        font-size: 12px;
        color: #e7d3b0;
    }

    .item-weapon {
        color: #e59c7d;
        font-weight: bold;
    }

    .item-armor {
        color: #9ec7cb;
        font-weight: bold;
    }

    .item-admin {
        color: #f6e4a4;
        font-weight: bold;
    }

    .item-name {
        cursor: help;
        position: relative;
        border-bottom: 1px dashed currentColor;
    }

    .item-name:hover::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 125%;
        left: 0;
        background-color: rgba(20, 14, 8, 0.98);
        color: #f5d68f;
        padding: 8px 12px;
        border: 1px solid #7a5b33;
        border-radius: 6px;
        white-space: nowrap;
        font-size: 11px;
        z-index: 1000;
        font-family: "Lucida Console", Monaco, monospace;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        font-weight: normal;
    }

    .item-name:hover::before {
        content: '';
        position: absolute;
        bottom: 118%;
        left: 10px;
        border: 5px solid transparent;
        border-top-color: rgba(20, 14, 8, 0.98);
        z-index: 1000;
    }

    .btn-action {
        background-color: #6c5139;
        color: #f7e8c1;
        font-weight: bold;
        border: 1px solid #a18161;
        padding: 4px 10px;
        cursor: pointer;
        font-size: 11px;
        font-family: "Palatino Linotype", Georgia, serif;
        text-transform: uppercase;
        border-radius: 5px;
    }

    .btn-action:hover {
        background-color: #93715a;
        color: #fff7d8;
    }

    .btn-consume {
        background-color: #7b4f2d;
        color: #f7e4c3;
        font-weight: bold;
        border: 1px solid #a48053;
        padding: 4px 10px;
        cursor: pointer;
        font-size: 11px;
        font-family: "Palatino Linotype", Georgia, serif;
        text-transform: uppercase;
        border-radius: 5px;
    }

    .btn-consume:hover {
        background-color: #a0724b;
        color: #fff8d8;
    }

    .empty-notice {
        background-color: #2f2319;
        border: 1px dashed #5f4b3c;
        padding: 22px;
        text-align: center;
        color: #d9c7a5;
        margin-top: 15px;
        font-weight: bold;
        border-radius: 8px;
    }

    .msg {
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid;
        font-weight: bold;
        font-family: "Lucida Console", Monaco, monospace;
        border-radius: 6px;
    }

    .msg-success {
        background-color: #233323;
        border-color: #a8eaaa;
        color: #dff8d6;
    }

    .msg-error {
        background-color: #4d1f1f;
        border-color: #f0a6a6;
        color: #ffdfdf;
    }
</style>
@endsection

@section('content')
<h2 class="panel-header">Adventurer's Satchel</h2>
<p>Your gear is packed and ready. Use this page to manage weapons, armor, and potions for your next expedition.</p>

<!-- Operational Feedback Log Banners -->
@if (session('success'))
<div class="msg msg-success">{{ session('success') }}</div>
@endif
@if (session('error'))
<div class="msg msg-error">{{ session('error') }}</div>
@endif

@if($items->isEmpty())
<div class="empty-notice">
    [ YOUR INVENTORY IS EMPTY ]<br>
    <span style="font-size: 10px; font-weight: normal; color: #444;">Visit the local market to purchase gear.</span>
</div>
@else
<table class="inv-table" cellpadding="0" cellspacing="0">
    <tr>
        <th class="inv-th">Item Name</th>
        <th class="inv-th" width="100">Classification</th>
        <th class="inv-th" width="80" style="text-align: center;">Quantity</th>
        <th class="inv-th" width="120" style="text-align: center;">Equip/Unequip</th>
        <th class="inv-th" width="100" style="text-align: center;">Action</th>
    </tr>
    @foreach($items as $item)
    <tr class="inv-tr">
        <td class="inv-td">
            <span class="item-{{ $item->item_type }} item-name"
                data-tooltip="{{ isset($item->item_description) ? $item->item_stat_name . ' +' . $item->item_stat_value : 'No description' }}">
                {{ $item->item_name }}
            </span>
        </td>
        <td class="inv-td" style="text-transform: uppercase; color: #c9b79d;">
            {{ $item->item_type === 'consumable' ? 'Potion' : ucfirst($item->item_type) }}
        </td>
        <td class="inv-td" style="text-align: center; font-weight: bold; color: #f6e4a4;">
            x{{ $item->qty }}
        </td>
        <td class="inv-td" style="text-align: center;">
            @if($item->equipped)
            <span style="color:#a8eaaa; font-weight:bold;">[ STOWED AWAY ]</span>
            @else
            <span style="color:#bdb1a0;">[ UNEQUIPPED ]</span>
            @endif
        </td>
        <td class="inv-td" style="text-align: center;">
            @if($item->item_type === 'consumable')
            <form method="POST" action="{{ route('inventory.consume', $item->id) }}">
                @csrf
                <input type="submit" value="USE TONIC" class="btn-consume">
            </form>
            @else
            <form method="POST" action="{{ route('inventory.equip', $item->id) }}">
                @csrf
                <input type="submit" value="{{ $item->equipped ? 'UNSLING' : 'WIELD' }}" class="btn-action">
            </form>
            @endif
        </td>
    </tr>
    @endforeach
</table>
@endif
@endsection
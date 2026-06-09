@extends('layouts.game')

@section('title', 'Market Square - The World of Arfet')

@section('styles')
<style>
    .shop-table {
        width: 100%;
        border: 1px solid #4b3725;
        margin-top: 15px;
        background-color: rgba(33, 24, 17, 0.95);
        border-radius: 10px;
        overflow: hidden;
    }

    .shop-th {
        background-color: #4a3729;
        color: #f2d49e;
        font-weight: bold;
        padding: 10px;
        text-align: left;
        text-transform: uppercase;
        border-bottom: 1px solid #644e3b;
        letter-spacing: 0.5px;
    }

    .shop-tr:nth-child(even) {
        background-color: rgba(44, 34, 24, 0.9);
    }

    .shop-td {
        padding: 10px;
        border-bottom: 1px dashed #3f2e1f;
        font-family: "Palatino Linotype", Georgia, serif;
        font-size: 12px;
        color: #e7d3b0;
    }

    .price-tag {
        color: #f6e4a4;
        font-weight: bold;
    }

    .btn-buy {
        background-color: #7e5b32;
        color: #f7e8c1;
        font-weight: bold;
        border: 1px solid #a68155;
        padding: 6px 12px;
        cursor: pointer;
        font-size: 11px;
        font-family: "Palatino Linotype", Georgia, serif;
        text-transform: uppercase;
        border-radius: 5px;
    }

    .btn-buy:hover {
        background-color: #9a7247;
        color: #fff8d8;
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
<h2 class="panel-header">Location: Bazaar of Shadows</h2>
<p>Secret traders peddle rare gear and forbidden tinctures. Spend your coin to arm yourself with enchanted blades, stout
    armor, and useful provisions.</p>

<!-- Feedback Alerts -->
@if (session('success'))
<div class="msg msg-success">{{ session('success') }}</div>
@endif
@if (session('error'))
<div class="msg msg-error">{{ session('error') }}</div>
@endif

<table class="shop-table" cellpadding="0" cellspacing="0">
    <tr>
        <th class="shop-th">Available Wares</th>
        <th class="shop-th" width="120">Type</th>
        <th class="shop-th" width="100">Tribute</th>
        <th class="shop-th" width="90" style="text-align: center;">Purchase</th>
    </tr>
    @foreach($items as $id => $item)
    <tr class="shop-tr">
        <td class="shop-td"><b>{{ $item['name'] }}</b></td>
        <td class="shop-td" style="text-transform: uppercase; color: #c9b79d;">{{ ucfirst($item['type']) }}</td>
        <td class="shop-td"><span class="price-tag">${{ number_format($item['price']) }}</span></td>
        <td class="shop-td" style="text-align: center;">
            <form method="POST" action="{{ route('market.buy', $id) }}">
                @csrf
                <input type="submit" value="PROCURE" class="btn-buy">
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
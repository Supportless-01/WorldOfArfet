@extends('layouts.game')

@section('title', 'Bandits Den — World of Arfet')

@section('styles')
<style>
    .crime-box {
        background-color: #342718;
        border: 1px solid #5e402d;
        padding: 16px;
        margin-top: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 8px;
        box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.25);
    }

    .btn-commit {
        background-color: #7c4c24;
        color: #f7dfb8;
        font-weight: bold;
        border: 1px solid #a9784e;
        padding: 10px 16px;
        cursor: pointer;
        text-transform: uppercase;
        font-family: "Palatino Linotype", Georgia, serif;
        font-size: 12px;
        border-radius: 5px;
    }

    .btn-commit:hover {
        background-color: #926239;
        color: #fff7d9;
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
        background-color: #22331c;
        border-color: #8ee28e;
        color: #c6f5b4;
    }

    .msg-error {
        background-color: #3e1a1a;
        border-color: #f27a7a;
        color: #ffd6d6;
    }
</style>
@endsection

@section('content')
<h2 class="panel-header">Location: Thieves' Quarter</h2>
<p>The alleyways are shadowed and ripe with unwary merchants. Spend your Resolve here to pilfer coin and strengthen your
    standing among the guild.</p>

<!-- Feedback Alerts -->
@if (session('success'))
<div class="msg msg-success"><strong>Guild Whisper:</strong> {{ session('success') }}</div>
@endif
@if (session('error'))
<div class="msg msg-error"><strong>City Watch:</strong> {{ session('error') }}</div>
@endif

<!-- Crime Action Component -->
<div class="crime-box">
    <div>
        <b style="color: #f5c97b; font-size: 13px;">Lift a Merchant's Pouch</b><br>
        <span style="color:#d2c0a7;">Consumes 2 Resolve. A quick grab for coin that keeps you hidden from the city
            watch.</span>
    </div>
    <form method="POST" action="{{ route('crimes.shoplift') }}">
        @csrf
        <input type="submit" value="PILFER POUCH" class="btn-commit">
    </form>
</div>
@endsection
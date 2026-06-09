@extends('layouts.game')

@section('title', 'Training Yard — World of Arfet')

@section('styles')
<style>
    .gym-box {
        background-color: rgba(46, 34, 20, 0.95);
        border: 1px solid #8b6f4f;
        padding: 18px;
        margin-top: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 12px;
        box-shadow: inset 0 0 18px rgba(0, 0, 0, 0.28);
        background-image: linear-gradient(135deg, rgba(60, 42, 24, 0.9), rgba(34, 24, 14, 0.95));
    }

    .btn-train {
        background-color: #8e5b34;
        color: #fff1c4;
        font-weight: bold;
        border: 1px solid #c39b6b;
        padding: 12px 18px;
        cursor: pointer;
        text-transform: uppercase;
        border-radius: 8px;
        font-family: "Palatino Linotype", Georgia, serif;
        box-shadow: 0 3px 0 rgba(0, 0, 0, 0.2);
    }

    .btn-train:hover {
        background-color: #b17b4f;
        color: #fff8d9;
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
        border-color: #8fe190;
        color: #ccf3b8;
    }

    .msg-error {
        background-color: #4b1f1f;
        border-color: #f38686;
        color: #ffd9d9;
    }
</style>
@endsection

@section('content')
<h2 class="panel-header">Location: Oakwood Training Grounds</h2>
<p>The field is lined with timber logs and old iron anchors. Spend your Stamina here to temper your body for battle and
    sharpen your combat prowess.</p>

@if (session('success'))
<div class="msg msg-success"><strong>Trainer's Notice:</strong> {{ session('success') }}</div>
@endif
@if (session('error'))
<div class="msg msg-error"><strong>Training Hall:</strong> {{ session('error') }}</div>
@endif

<div class="gym-box">
    <div>
        <b style="color: #f5c97b; font-size: 13px;">Hammer & Anvil Drills</b><br>
        <span style="color:#d2c0a7;">Spend 10 Stamina to harden your limbs, brace your guard, and steady your breath for
            the coming fight.</span>
    </div>
    <form method="POST" action="{{ route('gym.train') }}">
        @csrf
        <input type="submit" value="STEEL YOURSELF" class="btn-train">
    </form>
</div>
@endsection
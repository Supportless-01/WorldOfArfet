@extends('layouts.game')

@section('title', 'City Ledger - Underworld City')

@section('content')
<h2 class="panel-header">Location: The Gilded Hall</h2>
<p>Hail, <b>{{ auth()->user()->name }}</b>. Your presence is noted among the denizens of the Quarter.</p>

<table width="100%" bgcolor="#111111"
    style="border: 1px solid #493926; padding: 14px; margin-top: 20px; border-radius: 8px; background: rgba(16, 11, 6, 0.95);">
    <tr>
        <td>
            <span style="color:#d9b871; font-weight:bold;">Guild Notice:</span> The city ledger is still being scribed.
            Some passages may be unfinished, and the watchmen are still tuning the quarters. Stay vigilant and share any
            rumors you uncover.
        </td>
    </tr>
</table>
@endsection
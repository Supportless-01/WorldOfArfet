@extends('layouts.game')

@section('title', 'Gilded Hall — World of Arfet')

@section('content')
<h2 class="panel-header">Location: The Gilded Hall</h2>
<p>Hail, <b>{{ auth()->user()->name }}</b>. Your presence is noted among the denizens of the Quarter.</p>

<table width="100%" bgcolor="#111111"
    style="border: 1px solid #493926; padding: 14px; margin-top: 20px; border-radius: 8px; background: rgba(16, 11, 6, 0.95);">
    <tr>
        <td>
            <span style="color:#d9b871; font-weight:bold;">System Notice:</span> The game is still in development.
            Expect regular updates, new features, and exciting content as we build the world of Arfet together. Your
            feedback is invaluable in shaping the future of the game.
        </td>
    </tr>
</table>
@endsection
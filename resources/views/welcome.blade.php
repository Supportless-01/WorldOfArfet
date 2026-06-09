<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Underworld City — Step Into the Shadows</title>
    <style>
        body {
            background-color: #130f08;
            background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 100% 4px;
            color: #f1dcc0;
            font-family: "Palatino Linotype", "Book Antiqua", Georgia, serif;
            font-size: 13px;
            margin: 0;
            padding: 20px;
        }

        .main-table {
            width: 780px;
            margin: 0 auto;
            background-color: #2f2519;
            border: 4px solid #5d422a;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
        }

        .banner {
            background: linear-gradient(180deg, #392510 0%, #1f150a 100%);
            border-bottom: 3px solid #5f4226;
            padding: 18px;
            text-align: center;
            color: #f7d9a4;
            font-family: "Goudy Old Style", Georgia, serif;
        }

        .banner h1 {
            color: #e5b95b;
            font-family: "Goudy Old Style", Georgia, serif;
            font-size: 40px;
            letter-spacing: 2px;
            margin: 0;
            text-transform: uppercase;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
        }

        .banner p {
            color: #e3d1a1;
            font-weight: bold;
            font-size: 12px;
            margin: 6px 0 0 0;
            letter-spacing: 1px;
        }

        .sidebar {
            width: 180px;
            background-color: #2a1f14;
            vertical-align: top;
            padding: 12px;
            border-right: 3px solid #4e3927;
        }

        .sidebar-right {
            border-right: none;
            border-left: 3px solid #4e3927;
            width: 180px;
            background-color: #2a1f14;
        }

        .box-title {
            background: linear-gradient(180deg, #5b3d23 0%, #351e0f 100%);
            color: #f1ddb7;
            font-weight: bold;
            font-size: 12px;
            padding: 7px 8px;
            border: 1px solid #7a5c3e;
            text-align: center;
            margin-bottom: 10px;
            text-transform: uppercase;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08);
        }

        .menu-link {
            display: block;
            background-color: #342617;
            color: #e7d1a6;
            text-decoration: none;
            font-weight: bold;
            padding: 7px 10px;
            margin-bottom: 5px;
            border: 1px solid #4e3827;
            border-radius: 4px;
            transition: background-color 0.2s ease;
            text-align: center;
        }

        .menu-link:hover {
            background-color: #463522;
            color: #fff1cb;
            border-color: #6a5238;
        }

        .content-area {
            padding: 18px;
            vertical-align: top;
            background-color: #291f14;
            color: #f3e4cd;
            border-left: 3px solid #4e3927;
            border-right: 3px solid #4e3927;
        }

        .welcome-header {
            color: #f0d88e;
            font-size: 18px;
            border-bottom: 1px solid #5c472f;
            padding-bottom: 6px;
            margin-top: 0;
        }

        .news-item {
            background-color: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 10px;
            margin-bottom: 12px;
            border-radius: 4px;
        }

        .news-date {
            font-size: 11px;
            color: #c6b396;
            margin-bottom: 5px;
        }

        .footer {
            background-color: #21180f;
            color: #b7a37d;
            font-size: 10px;
            text-align: center;
            padding: 10px;
            border-top: 2px solid #4c3826;
        }
    </style>
</head>

<body>

    <!-- Main Table Layout Grid Engine -->
    <table class="main-table" cellpadding="0" cellspacing="0">

        <!-- ROW 1: Banner Block Section -->
        <tr>
            <td colspan="3" class="banner">
                <h1>The World of Arfet</h1>
                <p>--- A DARK FANTASY REALM OF ROGUES AND ROGUERY ---</p>

                <!-- ROW 2: Core Three-Column Split Configuration -->
        <tr>

            <!-- COLUMN 1: LEFT NAVIGATION SIDEBAR -->
            <td class="sidebar">
                <div class="box-title">Game Terminal</div>

                @if (Route::has('login'))
                @auth
                <a href="{{ url('/dashboard') }}" class="menu-link"
                    style="color: #d9b871; border-color: #8b6f4f;">ENTER THE REALM</a>
                @else
                <a href="/login" class="menu-link">ENTER THE COURT</a>
                @if (Route::has('register'))
                <a href="/register" class="menu-link" style="color: #ff3333; border-color: #660000;">RAISE YOUR
                    BANNER</a>
                @endif
                @endauth
                @endif

                <div class="box-title" style="margin-top:15px;">Community</div>
                <a href="#" class="menu-link">Game Forums</a>
                <a href="#" class="menu-link">Player Rankings</a>
                <a href="#" class="menu-link">IRC Chatroom</a>
            </td>

            <!-- COLUMN 2: CENTRAL GAME INTRODUCTION CANVAS -->
            <td class="content-area">
                <h2 class="welcome-header">Welcome to your new life adventurer!</h2>
                <p>Hey adventurer! Welcome to the world of Arfet! Get ready for an epic journey in this dark fantasy
                    realm.</p>

                <div class="box-title" style="text-align: left; padding-left: 8px;">Latest Game Updates</div>

                <div class="news-item">
                    <div class="news-date">Posted on: June 08, 2026 - 04:00 PM</div>
                    <strong>V0.01 Server Test And Deployment</strong><br>
                    The initial server test has been successfully completed. We are now live with version 0.01, which
                    includes the core game engine, basic crime mechanics, and the initial user interface. We are
                    actively monitoring server performance and player feedback to ensure a stable and enjoyable
                    experience.
                </div>
            </td>

            <!-- COLUMN 3: RIGHT STATUS METRICS PANEL -->
            <!-- RIGHT STATUS SIDEBAR -->
            <td class="sidebar sidebar-right">
                <div class="box-title">Realm Status</div>
                <div style="font-size:11px; line-height:16px; padding: 4px; font-family: monospace;">
                    @php
                    // Fetch accurate live row calculations
                    $totalAccounts = \Illuminate\Support\Facades\DB::table('users')->count();

                    $realOnline = \Illuminate\Support\Facades\DB::table('users')
                    ->where('last_action_at', '>=', now()->subMinutes(5))
                    ->count();
                    @endphp
                    • Players Online: <font color="#00ff00"><b>{{ $realOnline }}</b></font><br>
                    • Accounts Total: <span style="color:#fff;">{{ number_format($totalAccounts) }}</span><br>
                    • Next Tick: <font color="#ffff00"><b id="tick-clock">05:00</b></font><br>
                    • Server Status: <b style="color: #00ff00;">ONLINE</b>
                </div>

                <div class="box-title" style="margin-top:15px;">Game Screenshots</div>
                <div
                    style="border: 1px dashed #555; background:#000; height:80px; text-align:center; line-height:80px; color:#444; font-size:10px;">
                    [No Image Loaded]
                </div>
            </td>

        </tr>

        <!-- ROW 3: Page Footnotes Disclaimer Section -->
        <tr>
            <td colspan="3" class="footer">
                Copyright &copy; 2026 The World of Arfet Net. All Rights Reserved.
            </td>
        </tr>

    </table>

    <!-- JavaScript Countdown Chrono Tick Runner Loop -->
    <script type="text/javascript">
        (function() {
            var displayElement = document.getElementById('tick-clock');
            if (!displayElement) return;

            function updateClock() {
                var now = new Date();
                var minutes = now.getMinutes();
                var seconds = now.getSeconds();

                var remMin = 4 - (minutes % 5);
                var remSec = 59 - seconds;

                var padMinutes = remMin < 10 ? "0" + remMin : remMin;
                var padSeconds = remSec < 10 ? "0" + remSec : remSec;

                displayElement.innerHTML = padMinutes + ":" + padSeconds;

                if (remMin === 0 && remSec === 0) {
                    setTimeout(function() {
                        window.location.reload(true);
                    }, 1000);
                }
            }

            updateClock();
            setInterval(updateClock, 1000);
        })();
    </script>

</body>

</html>
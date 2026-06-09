<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'World of Arfet')</title>
    <style>
        body {
            background-color: #120f08;
            background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 100% 4px;
            color: #efd9b9;
            font-family: "Palatino Linotype", "Book Antiqua", Georgia, serif;
            font-size: 13px;
            margin: 0;
            padding: 18px;
        }

        .main-table {
            width: 960px;
            margin: 0 auto;
            background-color: #2f2417;
            border: 4px solid #5a3e23;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.6);
        }

        .sidebar,
        .stats-sidebar {
            background-color: #2b1f13;
            padding: 12px;
            vertical-align: top;
            border: 2px solid #4d371f;
        }

        .sidebar {
            width: 170px;
            border-right-width: 4px;
            border-right-color: #392a17;
        }

        .stats-sidebar {
            width: 230px;
            border-left-width: 4px;
            border-left-color: #392a17;
        }

        .box-title {
            background: linear-gradient(180deg, #5b3c1d 0%, #371f0d 100%);
            color: #f5d68f;
            font-weight: bold;
            font-size: 11px;
            letter-spacing: 1px;
            padding: 6px 8px;
            border: 1px solid #7a5b33;
            text-align: center;
            margin-bottom: 10px;
            text-transform: uppercase;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08);
        }

        .menu-link {
            display: block;
            background-color: #302318;
            color: #e7d1a6;
            text-decoration: none;
            padding: 8px 10px;
            margin-bottom: 5px;
            border: 1px solid #4f3b29;
            border-radius: 4px;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .menu-link:hover {
            background-color: #453220;
            color: #ffebc6;
            border-color: #6e5439;
        }

        .content-area {
            padding: 18px;
            vertical-align: top;
            background-color: #291f14;
            border-left: 2px solid #4a3826;
            border-right: 2px solid #4a3826;
            color: #f3e3c7;
            box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.4);
        }

        .panel-header {
            font-size: 18px;
            color: #f2d38e;
            font-weight: bold;
            border-bottom: 1px solid #665232;
            padding-bottom: 5px;
            margin-top: 0;
            letter-spacing: 1px;
        }

        .stat-line {
            padding: 6px 4px;
            border-bottom: 1px dashed rgba(255, 214, 143, 0.24);
            display: flex;
            justify-content: space-between;
            font-size: 12px;
        }

        .stat-val {
            font-family: "Lucida Console", Monaco, monospace;
            color: #f7e8c2;
            font-weight: bold;
        }

        .logout-btn {
            background: none;
            border: 1px solid #7d5f3d;
            color: #e8c99d;
            font-weight: bold;
            text-align: left;
            width: 100%;
            padding: 8px;
            cursor: pointer;
            font-family: "Palatino Linotype", Georgia, serif;
            font-size: 12px;
            text-transform: uppercase;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.06);
        }
    </style>
    @yield('styles')
</head>

<body>

    <table class="main-table" cellpadding="0" cellspacing="0">
        <tr>
            <!-- 🛡️ 1. ACTIONS NAVIGATION SIDEBAR -->
            <td class="sidebar">
                <div class="box-title">Command Keep</div>
                <a href="/" class="menu-link">• Main Gate</a>
                <a href="/dashboard" class="menu-link">• Great Hall</a>
                <a href="/crimes" class="menu-link">• Bandit’s Den</a>
                <a href="/gym" class="menu-link">• Training Yard</a>
                <a href="/market" class="menu-link">• Market Square</a>
                <a href="#" class="menu-link">• Healer’s Infirmary</a>


                <div class="box-title" style="margin-top: 15px;">Hall of Records</div>
                <a href="#" class="menu-link">• Message Scrolls (0)</a>
                <a href="/inventory" class="menu-link">• Personal Satchel</a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit" class="logout-btn">• ABANDON QUEST</button>
                </form>
            </td>

            <!-- 🎯 2. DYNAMIC CANVAS FRAME -->
            <td class="content-area">
                @yield('content')
            </td>

            <!-- 📊 3. VITALS HUD & SERVER METRICS SIDEBAR -->
            <td class="stats-sidebar">
                <div class="box-title">Herald’s Record</div>
                <div class="stat-line"><span>Adventurer:</span> <span class="stat-val"
                        style="color:#fff;">{{ auth()->user()->name }}</span></div>
                <div class="stat-line"><span>Gold:</span> <span class="stat-val"
                        style="color:#ffcc00;">${{ number_format(auth()->user()->money) }}</span></div>
                <div class="stat-line"><span>Vitality:</span> <span class="stat-val">{{ auth()->user()->life }} /
                        100</span></div>
                <div class="stat-line"><span>Stamina:</span> <span class="stat-val">{{ auth()->user()->energy }} /
                        100</span></div>
                <div class="stat-line"><span>Resolve:</span> <span class="stat-val"
                        style="color:#ff33ff;">{{ auth()->user()->nerve }} / 10</span></div>
                <div class="stat-line"><span>Strength:</span> <span class="stat-val"
                        style="color:#33ffff;">{{ auth()->user()->strength }}</span></div>

                <!-- SERVER METRICS FIXED PANEL -->
                <div class="box-title" style="margin-top: 20px;">Realm Status</div>
                <div style="font-size:12px; line-height:18px; padding: 6px; font-family: monospace; color:#ece0c9;">
                    @php
                    $liveAccounts = \Illuminate\Support\Facades\DB::table('users')->count();
                    $realOnline = \Illuminate\Support\Facades\DB::table('users')
                    ->where('last_action_at', '>=', now()->subMinutes(5))
                    ->count();

                    $onlineDisplay = $realOnline > 0 ? $realOnline : 1;
                    @endphp
                    • Warriors Online: <span style="color:#a3f1ae;"><b>{{ $onlineDisplay }}</b></span><br>
                    • Records Total: <span style="color:#fff;">{{ number_format($liveAccounts) }}</span><br>
                    • Next Tick: <span style="color:#f7f16d;"><b id="tick-clock">05:00</b></span><br>
                    • Server Status: <span style="color:#9df2a5; font-weight:bold;">ONLINE</span>
                </div>
            </td>
        </tr>
    </table>

    <!-- JavaScript Countdown Chrono Ticker Engine -->
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
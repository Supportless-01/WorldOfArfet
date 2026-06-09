<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Secure Agent Entry - Underworld City</title>
    <style>
        body {
            background-color: #120f08;
            color: #f1dcc0;
            font-family: "Palatino Linotype", "Book Antiqua", Georgia, serif;
            font-size: 13px;
            margin: 0;
            padding: 40px 0 60px;
            background-image: linear-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px);
            background-size: 100% 4px;
        }

        .page-shell {
            max-width: 520px;
            margin: 0 auto;
            padding: 18px;
        }

        .login-table {
            width: 100%;
            background-color: rgba(48, 35, 25, 0.95);
            border: 4px solid #5b412a;
            box-shadow: 0 0 35px rgba(0, 0, 0, 0.45);
            border-radius: 10px;
            overflow: hidden;
        }

        .header {
            background: linear-gradient(180deg, #5d3e24 0%, #351f0e 100%);
            color: #f7d9a4;
            padding: 16px 18px;
            text-align: center;
            font-weight: bold;
            border-bottom: 3px solid #7a5c3b;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 18px;
        }

        .subheader {
            text-align: center;
            color: #d9c79d;
            font-size: 12px;
            margin-top: 6px;
            margin-bottom: 14px;
        }

        .form-cell {
            padding: 22px;
            background: linear-gradient(180deg, rgba(43, 33, 24, 0.95) 0%, rgba(37, 27, 18, 0.95) 100%);
        }

        .label {
            font-weight: bold;
            color: #e7d1a5;
            display: block;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            background-color: #261d14;
            border: 1px solid #5c4b3d;
            color: #f2e4c8;
            font-family: "Lucida Console", Monaco, monospace;
            padding: 10px;
            margin-bottom: 16px;
            border-radius: 4px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.06);
        }

        .btn-submit {
            background-color: #6a482e;
            color: #fbeac3;
            border: 1px solid #9c7a53;
            font-weight: bold;
            padding: 12px 14px;
            cursor: pointer;
            text-transform: uppercase;
            width: 100%;
            margin-top: 6px;
            border-radius: 6px;
            letter-spacing: 0.6px;
        }

        .btn-submit:hover {
            background-color: #8a5f3e;
            color: #fff6da;
        }

        .links-cell {
            background-color: #2b2118;
            padding: 14px;
            text-align: center;
            border-top: 1px solid #4f3b2a;
        }

        .links-cell a {
            color: #d8c08b;
            text-decoration: none;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .links-cell a:hover {
            color: #f7e7c7;
        }

        .error-list {
            background-color: #3f1f17;
            border: 1px solid #7a4338;
            color: #f1c3b0;
            padding: 10px;
            margin: 0 0 16px;
            border-radius: 6px;
            list-style-type: disc;
        }

        .error-list li {
            margin-bottom: 6px;
        }
    </style>
</head>

<body>

    <div class="page-shell">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <table class="login-table" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="header">Hearthgate Entry</td>
                </tr>
                <tr>
                    <td class="form-cell">
                        <div class="subheader">Speak your name, then speak your secret.</div>

                        @if ($errors->any())
                        <ul class="error-list">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif

                        <label class="label">HERALD NAME:</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus>

                        <label class="label">SECRET WORD:</label>
                        <input type="password" name="password" required>

                        <input type="submit" value="ENTER THE HALL" class="btn-submit">
                    </td>
                </tr>
                <tr>
                    <td class="links-cell">
                        <a href="/register">Forge a New Banner</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>

</body>

</html>
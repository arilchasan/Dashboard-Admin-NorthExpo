<!DOCTYPE html>
<html>

<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            display: flex;
            padding: 20px 0;
            border-radius: 20px;
            background: linear-gradient(180deg, #15abc54e 0%, #ffffff 100%)
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
            color: #000;
            margin-top: 20px;
            background: transparent;
        }

        .logo {
            width: 100px;
            height: auto;
            background: transparent;
        }

        .vektor {
            width: 45%;
            height: auto;
            background: transparent;
        }

        .message {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
            padding: 0 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .link-container {
            padding: 0 30px;
            margin-bottom: 20px;
        }

        .link-container p {
            margin-bottom: 20px;
        }

        .button-container {
            text-align: center;
            margin-bottom: 20px
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #15ACC5;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            border: none
        }

        .button:hover {
            background-color: rgb(16, 136, 157);
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #15ACC5;
            font-size: 14px;
            padding: 20px 0;
            background: linear-gradient(180deg, #ffffff 30%, #15abc54e 100%);
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ URL::to('assets/img/logo-dark.png') }}" alt="Logo" class="logo">
            <img src="{{ URL::to('assets/img/email-verification.png') }}" alt="Logo" class="vektor">
            <h1>Verifikasi Email Kamu</h1>
        </div>
        <div class="message">
            <p>Hai, {{$user->name}} 👋</p>
            <p>Klik tombol di bawah ini untuk verifikasi alamat email Anda.</p>
        </div>
        <div class="button-container">
            <form method="POST" action="{{ url('api/email/verify/' . $user->id . '/' . $user->link    )}}">
                @csrf
                <button class="button" type="submit">Verifikasi Email</button>
            </form>
        </div>
        
        {{-- <p>{{ $url }}</p> --}}
        <p class="footer">Terima kasih - 4ranger Team</p>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Tiket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 100px;
            height: auto;
        }
        .content {
            margin-top: 20px;
            color: #333333;
        }
        .button {
        display: inline-block;
        padding: 10px 20px;
        margin-top: 20px;
        background-color: #15acc5; /* Ganti warna latar belakang */
        color: #ffffff; /* Ganti warna teks */
        text-decoration: none;
        border-radius: 5px;
    }
        .button:hover {
            background-color: #0056b3;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #888888;
        }
        .qr-code {
            display: block;
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ URL::to('assets/img/logo-dark.png') }}" alt="Logo">
        </div>
        <div class="content">
            <p style="color: #ff6600;">Dear Customer,</p>
            <p>Terima kasih telah membeli tiket! Kami sangat menghargai dukungan Anda. Tiket Anda telah dicantumkan dalam email yang kami kirimkan. Semoga Anda menikmati acara tersebut dan memiliki pengalaman yang tak terlupakan. Jangan ragu untuk menghubungi kami jika ada pertanyaan atau bantuan lebih lanjut. Terima kasih lagi atas kepercayaan Anda kepada kami!</p>
            <h3 style="color: #007bff;">Detail Tiket</h3>
            <table>
                <tr>
                    <td style="color: #555555;">Order ID</td>
                    <td>:</td>
                    <td>{{ $payment->order_id }}</td>
                </tr>
                <tr>
                    <td style="color: #555555;">Jumlah Orang</td>
                    <td>:</td>
                    <td>{{ $payment->qty }} Orang</td>
                </tr>
                <tr>
                    <td style="color: #555555;">Total</td>
                    <td>:</td>
                    <td>Rp.{{ $payment->total }}</td>
                </tr>
            </table>
            <p>Klik tombol atau scan QR di bawah ini untuk mendapatkan informasi lebih lanjut:</p>
            <a class="button" href="{{asset($qrCode) }}">Info Lengkap</a>
            <img class="qr-code" src="{{ asset($qrCode) }}" alt="QR Code">
        </div>
        <div class="footer">
            © {{ date('Y') }} North Expo Kudus.
        </div>
    </div>
</body>
</html>
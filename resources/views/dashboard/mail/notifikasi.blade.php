<!-- resources/views/notifikasi.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f7f7f7;
        }
        .logo {
            text-align: center;
        }
        .logo img {
            width: 100px;
            height: auto;
        }
        .content {
            margin-top: 30px;
        }
        .button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">

            <p>Dear Customer,</p>
            <p>Terima kasih telah membeli tiket! Kami sangat menghargai dukungan Anda. Tiket Anda telah dicantumkan dalam email yang kami kirimkan. 
                Semoga Anda menikmati acara tersebut dan memiliki pengalaman yang tak terlupakan. 
                Jangan ragu untuk menghubungi kami jika ada pertanyaan atau bantuan lebih lanjut. Terima kasih lagi atas kepercayaan Anda kepada kami!</p>
            {{-- <h2>Detail Tiket</h2> --}}
            <table>
                <tr>
                <tr>
                    <td>No Hp</td>
                    <td>:</td>
                    <td>{{ $payment->no_telp }}</td>
                </tr>
                <tr>
                    <td>Jumlah Orang</td>
                    <td>:</td>
                    <td>{{ $payment->qty }}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>:</td>
                    <td>Rp.{{ $payment->total }}</td>   
                </tr>
            </table>
            </div>
            <p>Scan QR code di bawah ini untuk mendapatkan informasi lebih lanjut:</p>
            {{-- <img src="{{ !! QrCode::size(50)->generate($qrCode) !! }}" alt="">    --}}
            {{ $qrCode }}
            {{-- {!! QrCode::size(50)->generate($qrCode); !!} --}}
        <div class="footer">
            © {{ date('Y') }} North Expo Kudus.
        </div>
    </div>
</body>
</html>

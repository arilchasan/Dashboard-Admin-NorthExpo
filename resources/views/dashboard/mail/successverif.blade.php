<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/logo-light.png') }}">
    <title>Verifikasi Email</title>
    <script src="https://kit.fontawesome.com/76557bdb99.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #15acc5;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
            padding: 10rem;
            margin:  0 5rem;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        section i {
            font-size: 100px;
            color: #15abc5;
        }

        section h1 {
            font-size: 24px;
            font-weight: 600;
            color: #000;
            margin-top: 20px;
        }

        section p {
            font-size: 16px;
            font-weight: 400;
            color: #000;
            margin-top: 10px;
            text-align: center;
        }

        section a {
            font-size: 16px;
            font-weight: 600;
            margin-top: 20px;
            color: #fff;
            background-color: #15abc5;
            padding: 0.5rem 1.5rem;
            text-decoration: none;
            border-radius: 8px;
            border: 1px solid #15abc5;
        }

        section a:hover {
            transition: 0.5s;
            background-color: rgb(255, 255, 255);
            text-decoration-color: #15abc5;
            color: #15abc5;
        }

        @media screen and (max-width: 768px) {
            section {
                padding: 5rem;
                margin: 0 2rem;
            }

            section i {
                font-size: 80px;
            }

            section h1 {
                font-size: 20px;
            }

            section p {
                font-size: 14px;
            }

            section a {
                font-size: 14px;
            }
        }

        @media screen and (max-width: 480px) {
            section {
                padding: 3rem;
                margin: 0 1rem;
            }

            section i {
                font-size: 60px;
            }

            section h1 {
                font-size: 18px;
            }

            section p {
                font-size: 12px;
            }

            section a {
                font-size: 1rem;
            }
        }

        @media screen and (max-width: 320px) {
            section {
                padding: 1rem;
            }

            section i {
                font-size: 40px;
            }

            section h1 {
                font-size: 16px;
            }

            section p {
                font-size: 10px;
            }

            section a {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <main>
        <section>
            <i class="fa-solid fa-circle-check"></i>
            <h1>Verifikasi Berhasil</h1>
            <p>Selamat, akun anda telah terverifikasi. Silahkan login untuk melanjutkan.</p>
            <a href="https://northexpokudus.com/login">Login</a>
        </section>
    </main>
</body>
</html>
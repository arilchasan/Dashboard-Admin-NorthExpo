{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p>
  
                  <form class="mx-1 mx-md-4" method="post" action="{{ route('loginWeb') }}">
                    @csrf
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input name="email" type="email" id="form3Example3c" class="form-control" value="{{ old('email') }}" />
                        <label class="form-label" for="form3Example3c">Email</label>
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input name="password" type="password" id="form3Example4c" class="form-control" value="{{ old('password') }}"/>
                        <label class="form-label" for="form3Example4c">Password</label>
                      </div>
                    </div>
  
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-primary btn-lg">Login</button>
                    </div>
  
                  </form>
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
<!Doctype html>
<html lang="en">
<link rel="stylesheet" href="{{ asset('/css/log.css') }}">
@if (session()->has('succes'))
    <div class="alert alert-success col-md-5 mt-5 mx-auto" role="alert">
        {{ session('succes') }}
    </div>
@endif

<head>
  <title>Login Dashboard Admin NorthExpo </title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        .wrapper {
            margin: 10% auto;
            position: center;
            max-width: 430px;
            /* width: 100%; */
            background: #fff;
            padding: 34px;
            border-radius: 6px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            text-align: center
        }

        .wrapper h2 {
            position: relative;
            font-size: 22px;
            font-weight: 600;
            color: #333;
            padding-bottom: 8px;
            display: inline-block;
        }

        .wrapper h2::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 0;
            margin-top: 10px;
            height: 3px;
            width: 280px;
            border-radius: 12px;
            background: #002c4f;
        }

        .wrapper .logo {
          text-align: center;
        }

        .wrapper .logo .dashboard {
          font-size: 16px;
          font-weight: 600;
          color: #333;
        }

        .wrapper form {
            margin-top: 30px;
        }

        .wrapper form .input-box {
            height: 52px;
            margin: 18px 0;
        }

        form .input-box input {
            height: 100%;
            width: 93%;
            outline: none;
            padding: 0 15px;
            font-size: 17px;
            font-weight: 400;
            color: #333;
            border: 1.5px solid #C7BEBE;
            border-bottom-width: 2.5px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .input-box input:focus,
        .input-box input:valid {
            border-color: #002c4f;
        }

        form .policy {
            display: flex;
            align-items: center;
        }

        form h3 {
            color: #707070;
            font-size: 14px;
            font-weight: 500;
            margin-left: 10px;
        }

        .input-box.button input {
            width: 100%;
            color: #fff;
            letter-spacing: 1px;
            border: none;
            background: black;
            cursor: pointer;
        }

        .input-box.button input:hover {
            background: #002c4f;
        }

        form .text h3 {
            color: #333;
            width: 100%;
            text-align: center;
        }

        form .text h3 a {
            color: #4070f4;
            text-decoration: none;
        }

        form .text h3 a:hover {
            text-decoration: underline;
        }
    </style>



</head>

<body class="text-center">
    <div class="wrapper">
      <div class="logo">
        <img src="{{ asset('assets/img/logo-dark.png') }}" alt="" width="100px" height="100px">
        {{-- <h3 class="dashboard">Dashboard Admin NorthExpo</h3> --}}
      </div>
      <h2>Dashboard Admin NorthExpo</h2>
        <form method="post" action="{{route('loginAdmin')}}">
            @csrf
            <div class="input-box">
                <input type="text" placeholder="Username" name="username" value="{{ old('username') }}" required>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="password" value="{{ old('password') }}"
                    required>
            </div>

            <div class="input-box button">
                <input type="Submit" value="Login">
            </div>
            {{-- <div class="text">
                <h3>Belum punya Akun? <a href="/register/all"> Daftar Sekarang</a></h3>
            </div> --}}
        </form>
    </div>
</body>

</html>

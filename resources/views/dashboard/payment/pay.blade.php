@extends('layouts.master')
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Poppins:wght@400&display=swap"
        rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-3GKYnRbz7jp7ixm_"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <div class="create-container">
        <div class="content container-fluid">
            <div class="content-container">
              <form action="{{ route('checkout', ['id' => $destinasi->id]) }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="harga">Harga</label>
                  <input type="text" value="{{$destinasi->harga}}" name="harga" readonly>       
                </div>
                <div class="form-group">
                  <label for="no_telp">No Hp</label>
                  <input type="text" name="no_telp">       
                </div>
                <div class="form-group">
                  <label for="qty">Berapa Orang </label>
                  <input type="number" name="qty" >       
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email">       
                </div>         
                <div class="form-group">
                  <label for="tanggal">Tanggal</label>
                  <input type="date" name="tanggal">       
                </div>         
                <button type="submit">Pay</button>
              </form>
            </div>

            <script type="text/javascript">
                // For example trigger on button clicked, or any time you need
                var payButton = document.getElementById('pay-button');
                payButton.addEventListener('click', function() {
                    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                    window.snap.pay('{{ $token }}');
                    // customer will be redirected after completing payment pop-up
                });
            </script>
        </div>
    </div>
@endsection

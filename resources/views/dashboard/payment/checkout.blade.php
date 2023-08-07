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
             <div class="card-body">
                <h5 class="card-title">
                    Detail Pesanan
                </h5>
                <table>
                    <tr>
                        <td>Order ID</td>
                        <td>:</td>
                        <td>{{ $payment->order_id }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>{{ $payment->tanggal }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $payment->email }}</td>
                    </tr>
                    <tr>
                        <td>No Telepon</td>
                        <td>:</td>
                        <td>{{ $payment->no_telp }}</td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td>Rp.{{ $destinasi->harga }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td>:</td>
                        <td>{{ $payment->qty }}</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>:</td>
                        <td>Rp.{{ $payment->total }}</td>
                    </tr>
                </table>
                <button id="pay">Pay</button>
                    <script type="text/javascript">
                        // For example trigger on button clicked, or any time you need
                        var payButton = document.getElementById('pay');
                        payButton.addEventListener('click', function () {
                          // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                          window.snap.pay('{{$token}}',{
                            onSuccess: function(result){
                            /* You may add your own implementation here */
                            alert("Pembayaran Sukses!"); console.log(result);
                        },
                        onPending: function(result){
                            /* You may add your own implementation here */
                            alert("Pembayaran Pending!"); console.log(result);
                        },
                        onError: function(result){
                            /* You may add your own implementation here */
                            alert("Pembayaran Gagal!"); console.log(result);
                        },
                        onClose: function(){
                            /* You may add your own implementation here */
                            alert('you closed the popup without finishing the payment'); 
                          }
                        })
                        
                        });
                      </script>
             </div>
        </div>
    </div>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lumon Industries</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>



    <style>
        @font-face {
            font-family: 'severance';
            src: url('{{ asset('fonts/MicroExtendFLF.ttf') }}') format('truetype');
            font-weight: normal;
        }

        @font-face {
            font-family: 'severance';
            src: url('{{ asset('fonts/MicroExtendFLF-Bold.ttf') }}') format('truetype');
            font-weight: bold;
        }

        body {
            background-image: url('{{ asset('images/type_flag_-_manifold.png') }}');
            /* PNG dosyasının yolu */
            background-size: cover;
            /* Sayfa boyutuna sığacak şekilde ayarla */
            background-position: center;
            /* Orta konumda göster */
            background-repeat: no-repeat;
            /* Tekrar etme */
            margin: 0;
            /* Sayfa kenar boşluklarını kaldır */
            padding: 0;
            /* Sayfa içerisindeki boşlukları kaldır */
            height: 100vh;
            /* Sayfa yüksekliğini 100 viewport height (ekran yüksekliği) olarak ayarla */
            /* display: flex; */
            flex-direction: column;
            align-items: center;
            justify-content: center;
            display: grid;
            grid-template-rows: auto 1fr;
        }

        .login {
            text-align: center;
            position: absolute;
            top: 100px;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            grid-area: header;


        }

        .form {
            z-index: 1;

            margin-top: 190px;
            margin-right: 230px;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>

    <style>
        .error-message {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #ff9999;
            color: #990000;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            display: none;
        }
    </style>
</head>


<body>
    <div class="login">
        <h1 style="font-family: 'severance', sans-serif; color:rgb(40, 95, 83)">Lumon Industries</h1>
    </div>
    <div class="form">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="employee_id" class="form-label" style="color:rgb(40, 95, 83)">Employee Code</label>
                <input type="number" class="form-control" id="employee_id" name="employee_id">

            </div>
            <div class="mb-3">
                <label for="password" class="form-label" style="color:rgb(40, 95, 83)">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <button class="btn btn-primary" style="background-color: rgb(40, 95, 83); color: white;">Login</button>
        </form>

    </div>

    <div class="error-message" id="error-message">
        {{ session('error') }}
    </div>

    <script>
        // Sayfa yüklendiğinde
        window.onload = function() {
            // Session'da error varsa
            var errorMessage = '{{ session('error') }}';
            if (errorMessage) {
                // Hata mesajını göster
                var errorDiv = document.getElementById('error-message');
                errorDiv.style.display = 'block';

                // 3 saniye sonra hata mesajını kapat
                setTimeout(function() {
                    errorDiv.style.display = 'none';
                }, 3000);
            }
        };
    </script>
</body>

</html>

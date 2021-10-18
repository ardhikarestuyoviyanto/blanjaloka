<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email From Blanjaloka</title>
    <style>
        .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;

        }
        .judul{
            text-align: center;
        }

        .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        .container {
        padding: 2px 16px;
        }
        a:link, a:visited {
            background-color: rgb(60, 72, 179);
            color: white;
            padding: 14px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        a:hover, a:active {
            background-color: rgb(60, 72, 179);
        }
    </style>
<body>

    <div class="card">
        <div class="container">
            <h1>Aktifasi Akun Blanjaloka</h1>
            <p>Hai, {{$details['nama_user']}}. Terimakasih telah memilih Blanjaloka Sebagai Platform Jual Beli anda, Sebelum Lanjut Belanja Verifikasi Emailmu dulu yuk</p>
            <p><a type="button" href="{{url('verification/'.$details['email'].'/'.$details['token'])}}">Aktifasi Email</a></p>
            <p>Thank You</p>
        </div>
    </div>
</body>
</html>
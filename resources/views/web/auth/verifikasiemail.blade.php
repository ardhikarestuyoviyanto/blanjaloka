<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email From Blanjaloka</title>
</head>
<body>
    <h1>Aktifasi Akun Blanjaloka</h1>
    <p>Hai, {{$details['nama_user']}}. Terimakasih telah memilih Blanjaloka Sebagai Platform Jual Beli anda, Sebelum Lanjut Belanja Verifikasi Emailmu dulu yuk</p>
    <p><a href="{{url('verification/'.$details['email'])}}">Klik disini untuk aktifasi email anda</a></p>
    <p>Thank You</p>
</body>
</html>
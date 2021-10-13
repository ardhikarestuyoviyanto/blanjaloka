<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Admin | Blanjaloka</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('assets/admin/css/login.css')}}">
  <link rel="shortcut icon" href="http://accounting.com.my/wp-content/uploads/2016/08/buy_logo1.png" type="image/x-icon">
</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="{{asset('assets/blanjaloka/img/aktivitas-pasar-2.png')}}" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="{{asset('assets/blanjaloka/img/blanjaloka.png')}}" alt="logo" class="logo">
              </div>
              <p class="login-card-description">Login Administrator</p>
              <form action="{{url('auth/adminlogin')}}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email address" value="{{old('email')}}">
                    @if($errors->has('email'))
                      <div class="text-danger text-small">
                          @foreach($errors->get('email') as $err)
                              {{$err}}
                          @endforeach
                      </div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="***********" >
                    @if($errors->has('password'))
                      <div class="text-danger text-small">
                          @foreach($errors->get('password') as $err)
                              {{$err}}
                          @endforeach
                      </div>
                    @endif
                  </div>
                  <div class="form-group">
                    <span id="captcha">{!! captcha_img() !!}</span>
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Captcha</label>
                    <input type="text" name="captcha" id="captcha" class="form-control" placeholder="Captcha">
                    @if($errors->has('captcha'))
                      <div class="text-danger text-small">
                          @foreach($errors->get('captcha') as $err)
                              {{$err}}
                          @endforeach
                      </div>
                    @endif
                  </div>
                  <button type="submit" class="btn btn-block login-btn mb-4">Login</button>
                </form>
                <nav class="login-card-footer-nav">
                  © 2021 | blanjaloka, All Rights Reserved.
                </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- Notif Jika Gagal Login --}}
    @if($status = Session::get('error'))
    <script>
      swal({
        title: "Error",
        text: "Email atau Password Salah",
        icon: "error",
        button: "OK",
      });
    </script>
  @endif
</body>
</html>

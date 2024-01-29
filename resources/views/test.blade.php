<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <title>Login</title>


</head>
<body>

    <div class="">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-6 col-xs-12 d-none d-lg-block d-md-block">
        <div id="mainBgn"></div>
      </div>
      <div class="col-lg-6 col-md-6 col-xs-12">
        
        <div class="p-4 centerOnMobile" >
            <h3 class="p-1 h3 text-center" id="welcome"><i class="fas fa-lock me-2"></i> ยินดีต้อนรับ</h3>
            <h2 class="p-1 h3 text-center" id="welcome"><i class="fas fa-lock me-"></i> ร้านตัดชุดเปลือกไหม</h2>
            <br>
            <h2 class="p-1 h2 text-center" id="loginn"><i class="fas fa-lock me-2"></i> เข้าสู่ระบบ</h2>
            @if($errors->any())
    <div id="error-alert" class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    <script>
        var errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            // กำหนดค่าเริ่มต้นเป็นความโปร่งใสสูงสุด
            var currentOpacity = 1;
            errorAlert.style.opacity = currentOpacity;

            // ใช้ setInterval เพื่อลดความโปร่งใสทีละน้อย
            var fadeOutInterval = setInterval(function() {
                currentOpacity -= 0.02;
                errorAlert.style.opacity = currentOpacity;

                // เมื่อความโปร่งใสลดถึง 0 ให้หยุด setInterval และซ่อน element
                if (currentOpacity <= 0) {
                    clearInterval(fadeOutInterval);
                    errorAlert.style.display = 'none';
                }
            }, 100); // ลดความโปร่งใสทีละน้อยทุก 100 มิลลิวินาที
        }
    </script>
@endif

        
           
        

                <form method="POST" action="{{ route('login') }}">

              @csrf
                      <div class="form-floating my-4">
                <input id="email" type="email"  class="form-control" @error('email') is-invalid @enderror  name="email"   value="{{old('email')}}" required  autocomplete="email"  autofocus>

                {{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> --}}

                <label for="email">อีเมล</label>


              </div>
              <div class="form-floating">
                <input id="password"  type="password" class="form-control @error('password') is-invalid @enderror" name="password"  required autocomplete="current-password">

                <label for="password">รหัสผ่าน</label>
              </div>

              <div id="btnHolder">
                <button type="submit"   class="btn btn-lg btn mt-3 w-100">เข้าสู่ระบบ</button>
              </div>

            </form>
          </div>
          
        </div>
      </div>
    </div>
    </div>
    </div>
</body>
</html>
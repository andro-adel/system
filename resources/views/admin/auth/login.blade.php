<!DOCTYPE html>
<html lang="en">
<head>
      @include('admin.layout.header')
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                <div class="card-body">
    
        @if ( @session()->has('error') )
            <div class="bg rounded bg-danger bg-sm text-white  alert-message p-2 m-2">
                {{  session()->get('error') }}
            </div>
        @endif

        {{-- Login Form --}}
        <form action="/admin/login" onsubmit="saveDataInLocalStorage()" method="POST">
            @csrf
        

              {{-- Email  --}}
              <div class="form-group">
                <label class="small mb-1" for="inputEmailAddress">Email</label>
                    <input name="email" type="email" placeholder="Enter email address" required class="form-control py-4 @error('email') border-danger @enderror" id="user_email"/>
                        @error('email')
                            @foreach ($errors->get('email') as $error)
                            <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                            @endforeach
                        @enderror
                </div>

                 {{-- Password  --}}
                 <div class="form-group">
                    <label class="small mb-1" for="inputPassword">Password</label>
                    <input name="password" type="password" placeholder="********" required id="user_password" class="form-control py-4 passwordInput @error('password') border-danger @enderror"/>
                    <div class="form-group-append" style="float: right;margin-top: -36px;margin-right: 1rem;cursor: grab;">
                        <span class="form-group-text cursor" id="basic-addon2" onclick="togglePassword()">
                            <i class="fas fa-eye fa-lg"></i>
                        </span>
                    </div>
                        @error('password')
                            @foreach ($errors->get('password') as $error)
                            <span class="text-sm text-danger mb-2"> {{  $error }}</span>
                            @endforeach
                        @enderror
                </div>

                  {{-- Checkbox [ remember me ]  --}}
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" name="check" id="checkbox" type="checkbox" />
                        <label class="custom-control-label" for="checkbox"> Remember Me </label>
                    </div>
                </div>

                <button  class="btn btn-dark btn-block">  Log In</button>

        </form>

        <!-- End of Main Content -->
            </div>
                </div>
                </div>
                </div>
                </div>
                </main>
                </div>
        <div id="layoutAuthentication_footer">

        @include('admin.layout.footer')

</body>
</html>

<script>

    function saveDataInLocalStorage () {
        if (document.getElementById("checkbox").checked) { 
            localStorage.setItem("email" , document.getElementById("user_email").value);
            localStorage.setItem("password" , document.getElementById("user_password").value);  
        }
    }

    function setMyInput () {
        if (localStorage.getItem("email")) {
            document.getElementById("user_email").value = localStorage.getItem("email");
        }
        if (localStorage.getItem("password")) {
            document.getElementById("user_password").value = localStorage.getItem("password");
        }
    }

    function togglePassword () {
        var x = document.getElementsByClassName("passwordInput")[0];
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
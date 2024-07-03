<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>Siaksmanli</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <main class="form-signin w-100 m-auto">
              <div class="text-center mb-4 mt-5"> <!-- Mengatur gambar menjadi tengah -->
                <img class="mb-4" src="\assets\logo.png" alt="" width="150" height="170">
              </div>
              <form method="post" action="/login">
                @csrf
                  <h1 class="h3 mb-3 fw-normal text-center">Please, Login</h1>
              
                  <div class="form-floating mt-2">
                    <input type="email" class="form-control @error('email') is-invalid
                    @enderror" value="{{ old('email') }}" name="email" id="email" required autofocus>
                    @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                    <label for="floatingInput">Email address</label>
                  </div>
                  <div class="form-floating mt-2">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    <label for="floatingPassword">Password</label>
                  </div>
                  
                  <button class="w-100 btn btn-lg btn-primary mt-2" type="submit">Sign in</button>
                  <br>
                  {{-- <div class="d-flex justify-content-center">
                    <a href="/register">Sign Up</a>
                  </div> --}}
                  <p class="mt-5 mb-3 text-muted text-center">&copy; 2024</p>
                </form>
            </main>  
        </div>
    </div>
  </body>
  </html>
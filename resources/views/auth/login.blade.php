<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- CSS -->
    <link rel="stylesheet" href="/css/user.css">
    <title>Home</title>
</head>

<body class="bg-light">
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern shadow rounded">
                        <div class="card-body">
                            <div class="p-3">
                                <h4 class="font-18 text-center">Login Page</h4>
                                <p class="text-muted text-center mb-4">Sign in to admin</p>
                                @if(session('fail'))
                                <div class="alert alert-danger" role="alert">
                                    {{session('fail')}}
                                </div>
                                @endif
                                <form class="form-horizontal" action="{{ route('post.login') }}" method="post">
                                    @csrf
                                    <div class="form-group mt-3">
                                        <label for="username">Email</label>
                                        <input type="text" name="email" class="form-control" id="email" placeholder="Enter email">
                                        @error('email') <span class="text-danger">{{$message}}</span>@enderror
                                    </div>

                                    <div class="form-group mt-4">
                                        <label for="userpassword">Password</label>
                                        <input type="password" name="password" class="form-control" id="userpassword" placeholder="Enter password">
                                        @error('password') <span class="text-danger">{{$message}}</span>@enderror
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-primary col-12" type="submit">Log In</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>

</html>
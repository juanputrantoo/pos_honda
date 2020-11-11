<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>POS</title>

    {{--
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    --}}
    <link href="{{ asset('/fonts/vendor/font-awesome/all.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/sb-admin/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    {{--
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"
        rel="stylesheet"> --}}

    <script src="{{ asset('/js/app.js') }}" defer></script>
    <script src="{{ asset('/fonts/vendor/font-awesome/font-awesome-all.js') }}" data-auto-replace-svg="nest" defer>
    </script>
    <script src="{{ asset('/asset/sb-admin/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('/asset/sb-admin/jquery.easing.min.js') }}" defer></script>
    <script src="{{ asset('/asset/sb-admin/sb-admin-2.min.js') }}" defer></script>
    <script src="{{ asset('/asset/bootstrap-select.min.js') }}" defer></script>
    <script src="{{ asset('/asset/bootstrap-datepicker.min.js') }}" defer></script>
    {{-- <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js" defer>
    </script> --}}
    <script src="{{ asset('/asset/jquery-1.11.1.min.js') }}"></script>
</head>

<body>

    @if (session('error'))
        <div class="alert alert-danger w-50 m-auto text-center">
            {{ session('error') }}
        </div>
    @endif
    <div class="card shadow w-50 mt-5 ml-auto mr-auto">
        <div class="card-header">
            <div class="card-title mb-0">
                <strong>Login</strong>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                            name="username" value="{{ old('username') }}">
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <hr>
                <button class="btn btn-primary pull-right" type="submit">Login</button>
            </form>
        </div>
    </div>

</body>

</html>

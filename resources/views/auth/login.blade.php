<!DOCTYPE html>
<html>

<head>
    <title>{{setting()->site_name}} | Login</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('uploads') }}/{{ setting()->favicon }}" />
    <link href="{{ asset('backend') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/login.css">
</head>

<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="{{ asset('uploads') }}/{{ setting()->logo }}" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="email" class="form-control" value=""
                                placeholder="email">
                        </div>
                        <div class="mb-2 input-group">
                                <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="password" name="password" class="form-control" value=""
                                placeholder="password">
                        </div>
                        <div class="mt-3 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="form-check-input"
                                id="customControlInline">
                                <label class="text-white custom-control-label" for="customControlInline">Remember
                                    me</label>
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-center login_container">
                            <button type="submit" name="button" class="btn login_btn">Login</button>
                        </div>
                    </form>
                </div>

                <div class="mt-4">
                    <div class="text-white d-flex justify-content-center links">
                        Don't have an account? <a href="{{ route('register') }}" class="text-warning">Sign Up</a>
                    </div>
                    <div class="d-flex justify-content-center links">
                        <a href="#" class="text-warning">Forgot your password?</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="{{ asset('backend') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
